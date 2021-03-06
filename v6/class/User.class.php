<?php
class User
{
    private $db;

    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }

    public function register($lname,$upass)
    {
       try
       {
           $new_password = password_hash($upass, PASSWORD_DEFAULT);

           $stmt = $this->db->prepare("INSERT INTO users(login,password)
                                                       VALUES(:lname, :upass)");

           $stmt->bindparam(":lname", $lname);
           $stmt->bindparam(":upass", $new_password);
           $stmt->execute();

           return $stmt;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
    }

    public function login2($lname,$upass){
     require_once 'db.php';
        $req = $pdo->prepare('SELECT * FROM users WHERE (login = :username OR email = :username) AND confirmed_at IS NOT NULL');
        $req->execute(['username' => $lname]);
        $user = $req->fetch();
        if($user == null){
            $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
        }elseif(password_verify($upass, $user->password)){
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
        header('Location: index.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
    }   
    }
    
    public function login($lname,$upass)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM users WHERE login=:lname LIMIT 1");
          $stmt->execute(array(':lname'=>$lname));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if($upass == $userRow['password'])
             {
                $_SESSION['user_session'] = $userRow['id'];
                $_SESSION['login'] = $lname;
                //$_SESSION['tri'] = '';
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
   public function is_loggedin2()
   {
      if(isset($_SESSION['auth']))
      {
         return true;
      }
   }

   public function redirect($url)
   {
       header("Location: $url");
   }

   public function logout()
   {
        session_start();
        unset($_SESSION['auth']);
        session_destroy();
       
        return true;
   }
   public function getListUser()
   {    
    require 'userl.class.php';
    $userl = array();
    $q = $this->db->query('SELECT * FROM users where confirmed_at IS NOT NULL ORDER BY login');
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $userl = new USERL();
    $userl->hydrate($donnees);
    
    echo '<div><input type="checkbox" name="user[]" value="'.$userl->id().'"/> '.$userl->login().'</div>';
    }
    echo '<div>Possede <input type="checkbox" name="possede" value="oui"/> Fini <input type="checkbox" name="fini" value="oui"/></div>';
    $userl->makeFiltreConsole();
    $userl->makeFiltreUser();
    $userl->makeTri();
    $userl->makeVarTriFiltre();
    return $userl;

    
    }
    public function getListUserselect()
   {    
    require 'userl.class.php';
    $userl = array();
    $q = $this->db->query('SELECT * FROM users ORDER BY login');
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $userl = new USERL();
    $userl->hydrate($donnees);
    echo '<option value="'.$userl->login().'">'.$userl->id();
    }
      
    return $userl;

    
    }
    public function getListUserselectsafari()
   {    
    require 'userl.class.php';
    $userl = array();
    $q = $this->db->query('SELECT * FROM users ORDER BY login');
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $userl = new USERL();
    $userl->hydrate($donnees);
    echo '<option value="'.$userl->login().'">'.$userl->login().'</option>';
    }
     
    return $userl;

    
    }
    
}



