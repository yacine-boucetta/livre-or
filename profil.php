<?php
session_start();
require 'db.php';
$message='';

if (isset($_SESSION['login']) && $_SESSION['login']=='admin'){
    header('Location: admin.php');
}

if(isset($_SESSION['login']) && $_SESSION['login']!='admin'){
    $oldlogin=$_SESSION['login'];
    $connexion=$dbase->prepare("SELECT * FROM `utilisateurs` WHERE `login`= :login ");
    $connexion->execute(array(':login' => $oldlogin));
    $connexionfetch1=$connexion->fetchall(PDO::FETCH_ASSOC);

    if(isset($_POST['valider'])){
      if(empty($_POST['login'])){
        $_POST['login']=$oldlogin;
      }

      $password2 = $_POST['password2'];
      $password1 = $_POST['password'];
      $login1 = $_POST['login'];
     
      $connexion=$dbase->prepare("SELECT login FROM `utilisateurs`WHERE `login`= :login ");
      $connexion->execute(array(':login' => $login1));
      $userExists = $connexion->rowcount();
      $connexionfetch=$connexion->fetchall(PDO::FETCH_ASSOC);
      
      
    if($userExists>0){
      $message="ce pseudo existe déjà";
    }

    else{
     
      $connexion=$dbase->prepare("UPDATE `utilisateurs` SET `login`=:login1 WHERE `login`= :login");
      $connexion->bindValue(':login',$oldlogin ,PDO::PARAM_STR);
      $connexion->bindValue(':login1',$login1 ,PDO::PARAM_STR);
      $connexion->execute();


      $_SESSION['login']=$login1;

    if(strlen($_POST['password'])>=6){
      if($password1==$password2){
        $password1=password_hash($password1,PASSWORD_DEFAULT);
        $sqlinsert="INSERT INTO utilisateurs(password) VALUES(:password)";
        $connexioninsert=$dbase->prepare($sqlinsert);
        $connexioninsert->execute(array(
        ':password'=>$password1));
      }
    }    
  }
}
}

if(isset($_POST['deconnexion'])){
  session_destroy();
  header('Location: connexion.php');
}
?>
<?php require 'header.php';?>
<main>
<div class="login-box">
  <h2>mon profil</h2>
  <p><?php echo $message; ?></p>
  <form  method='post'>
    <div class="user-box">
    <label for=""><p style="color:rgb(3, 134, 128);font-family:'upheavtt';"><?php echo $_SESSION['login'];?></p></label>
      <input type="text" name="login"  placeholder="nouveau login" >
      <br />
      <label for=""><p style="color:rgb(3, 134, 128);font-family:'upheavtt';">Password:</p></label>
      <input type="password" name="password"  placeholder="le nouveau mdp doit avoir 6 charactere minimum";?>
      <br />
      <label for=""><p style="color:rgb(3, 134, 128);font-family:'upheavtt';">confirmation mdp </p></label>
      <input type="password" name="password2"  placeholder="veuillez confirmer votre mot de passe">
    </div>
    <div class="myButton">
  <button type="submit" name="valider" value="valider">valider</button>
</div>
</main>
<?php require 'footer.php'; ?>