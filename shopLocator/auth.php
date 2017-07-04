<?php
  class auth
  {

      var $forbiddenPage="forbiddenPage.php";

      function  login($d)
      {
          $bdd = new PDO("mysql:host=127.0.0.1;dbname=shop", 'root', 'root');
          $req=$bdd->prepare("
      SELECT login.nom,login.email,roles.name,roles.slug,roles.lev FROM login LEFT JOIN roles ON login.role_id=roles.id WHERE nom=:nom AND pass=:pass");
        $req->execute($d);
          $data=$req->fetchAll();
          if(count($data)>0){
              $_SESSION['auth']=$data[0];


              return true ;
          }
          else {return false;}
      }

            function allow($rang)
        {
    $bdd = new PDO("mysql:host=127.0.0.1;dbname=shop", 'root', 'root');
    $req = $bdd->prepare("
    SELECT slug,lev FROM roles ");
    $req->execute();
    $roles = array();
    while ($data = $req->fetch())
    {

        $roles[$data['slug']] = $data['lev'];
    }

    if ($this->user('slug'))
     {
        $this->forbidden();
     }
    else if ($roles[$rang] > $this->user('lev'))
     {
        $this->forbidden();
     }
     else { return true ;}
        }
      function user($filed)
      {
          if(isset($_SESSION['auth']->$filed))
          {
              return $_SESSION['auth']->$filed;
          }else {return false;}

      }
      function forbidden()
      {
          header("Location:".$this->forbiddenPage);
      }
    }




  $auth=new auth()
?>