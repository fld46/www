 <?php
class USER
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

   public function redirect($url)
   {
       header("Location: $url");
   }

   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        unset($_SESSION['login']);
        return true;
   }
}
?>
