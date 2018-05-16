<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author fld
 */
class Auth {
    
    private $options =[
       'restriction_msg'=>"Vous n'avez pas le droit d'accéder à cette page" 
    ];
    private $session;
    
    public function __construct($session, $options =[]){
       $this->options = array_merge($this->options, $options);
       $this->session = $session;
    }
    
    public function register($db,$username, $password, $email){
        $password= password_hash($password, PASSWORD_BCRYPT);
        $token=Str::random(60);
        $db->query('INSERT INTO users SET login = ?, password= ?, email = ?, confirmation_token = ?',[
            $username,
            $password,
            $email,
            $token
                ]);
        $user_id= $this->db->lastInsertId();
        mail($email, 'Confirmation de votre inscription', "Afin de completer votre inscription, merci de cliquer sur ce liens : \n\n http://192.168.0.1/v4/account/confirm.php?id=".$user_id."&token=".$token."");
        
        
    }
    public function confirm($db,$user_id,$token){
        
        $user = $db->query('SELECT * FROM users WHERE id= ?',[$user_id] )->fetch();
        if($user && $user->confirmation_token == $token) {
        $db->query('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?',[$user_id]);
        $this->session->write('auth', $user);
       
        return true;
        
        }
        return false;
    }
    public function restrict(){
        
    if(!$this->session->read('auth')){
        $this->session->setFlash('danger', $this->options['restriction_msg']);
        header('Location: index.php');
        exit();
    } 
    }
    
}
