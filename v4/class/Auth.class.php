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
    public function hashPassword($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }
    
    public function register($db,$username, $password, $email){
        $password= $this->hashPassword($password);
        $token=Str::random(60);
        $db->query('INSERT INTO users SET login = ?, password= ?, email = ?, confirmation_token = ?',[
            $username,
            $password,
            $email,
            $token
                ]);
        $user_id= $db->lastInsertId();
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
        header('Location: ../index.php');
        exit();
    } 
    }
    public function user(){
      if(!$this->session->read('auth')){
          return false;
         }
         return $this->session->read('auth');
    }
    public function connect($user){
      
     $this->session->write('auth', $user);
        
    }
    public function connectFromCookie($db){
          
    if(isset($_COOKIE['remember']) && !$this->user() ){
        
        $remember_token = $_COOKIE['remember'];
        $parts = explode('==', $remember_token);
        $user_id = $parts[0];
        $user = $db->query('SELECT * FROM users WHERE id = ?',[$user_id])->fetch();
               
        if($user){
            $expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'ratonlaveurs');
            if($expected == $remember_token){
                $this->connect($user);
                
                setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
            } else{
                setcookie('remember', null, -1);
            }
        }else{
            setcookie('remember', null, -1);
        }
    }   
    }
    public function login($db, $username, $password, $remember = false) {
    $user = $db->query('SELECT * FROM users WHERE (login = :username OR email = :username) AND confirmed_at IS NOT NULL',['username' => $username])->fetch();
    if(password_verify($password, $user->password)){
        $this->connect($user);
        if($remember){
            
            $this->remember($db, $user->id);
        }
        return $user;
        }else{
        return false;
        }
    }    
     public function remember($db, $user_id){
      
        $remember_token = Str::random(250);
        $db->query('UPDATE users SET remember_token = ? WHERE id = ?', [$remember_token, $user_id]);
        setcookie('remember', $user_id . '==' . $remember_token . sha1($user_id . 'ratonlaveurs'), time() + 60 * 60 * 24 * 7);
           
     }
     public function logout(){
      setcookie('remember', NULL, -1);
      $this->session->delete('auth');
      $this->session->delete('menu');
      $this->session->delete('page');
     }
     
     public function resetPassword($db, $email){
         
        $user = $db->query('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL',['email'])->fetch();
        if($user){
        
        $reset_token = Str::random(60);
        $db->query('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?',[$reset_token, $user->id]);
       
        mail($_POST['email'], 'Réinitiatilisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien\n\nhttp://192.168.0.1/sitev3/reset.php?id={$user->id}&token=$reset_token");
        return $user;
        }
        return false;
     }
     public function checkResetToken($db, $user_id, $token){
      
        
        return $db->query('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)',[$user_id, $token])->fetch();
         
     }
    
    
  }
