<?php
session_start();
$message ='';
include 'db.php';
// if(isset($_SESSION['login'] && !='')){
//   header('Location: index.php');
// }
if(isset($_POST['sign_in'])){
    $login = htmlentities($_POST['login'], ENT_QUOTES, "ISO-8859-1"); 
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $connexion = $dbase->prepare("SELECT * FROM utilisateurs WHERE login = :login ");
    $connexion->execute(array(':login' => $login));
    $userExists = $connexion->rowcount();
    $cofetch = $connexion->fetch();
  
  if($cofetch['login']==='admin'){
    $_SESSION['login'] = $login;
    header('Location: admin.php');
  }

  elseif(password_verify($_POST['password'],$cofetch['password'])) {
    if($userExists==1 ) {
      $_SESSION['login'] = $login;
      header("Location: profil.php");
    }   
  }
  else{
    $message='le login ou le mot de passe est incorrect';  
  }

} 
?>

<?php require 'header.php';?>
<main>
<div class="login-box">
  <h2>Login</h2>
 <?php echo "$message";?>
  <form  method='post'>
    <div class="user-box">
      <input type="text" name="login"  placeholder="Username">
      <input type="password" name="password"  placeholder="password">
    </div>
    <div class="myButton">
  <button type="submit" name="sign_in" value="Login">Submit</button>
</div>
  </form>
</div>
</main>
<?php require 'footer.php';?>