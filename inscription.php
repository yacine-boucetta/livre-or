<?php
session_start();
$message='';
require 'db.php';
if(isset($_POST['sign_up'])){

    $password=htmlentities($_POST['password'], ENT_QUOTES, "ISO-8859-1"); 
    $password2=htmlentities($_POST['password2'], ENT_QUOTES, "ISO-8859-1"); 
    $login=htmlentities($_POST['login'], ENT_QUOTES, "ISO-8859-1"); 
    
    $connexion=$dbase->prepare("SELECT login FROM utilisateurs WHERE login = :login ");
    $connexion->execute(array(':login' => $login));
    $userExists = $connexion->rowcount();
    $connexionfetch=$connexion->fetchAll(PDO::FETCH_ASSOC);

    var_dump($connexionfetch);
    if($userExists==1){
        $message="ce nom d'utilisateur existe déjà";
    }
    
    elseif(strlen($_POST['password'])>=6){
        if($password==$password2){
            $password=password_hash($password,PASSWORD_DEFAULT);
            $sqlinsert="INSERT INTO utilisateurs(login,password) VALUES(:login,:password)";
            $connexioninsert=$dbase->prepare($sqlinsert);
            $connexioninsert->execute(array(
                ':login' =>$login,
                ':password'=>$password
            ));
                //  if (!$sqlinsert->query($connexioninsert)){
                //      echo("Message d'erreur : %s\n", $sqlinsert->error);
                // }
             header("Location: connexion.php");
        }
        else $message="Les mots de passe ne sont pas identiques";
    }
    else $message= "Le mot de passe est trop court !";       
}
else $message="Veuillez saisir tous les champs !";
?>

<?php require 'header.php'; ?>
<main>
<div class="login-box">
  <h2>Sign up</h2>
  <p style="color:red;font-family:'upheavtt';"><?php echo $message; ?></p>
  <form  method='post'>
    <div class="user-box">
      <input type="text" name="login" required="" placeholder="Username">
      <input type="password" name="password" required="" placeholder="password">
      <input type="password" name="password2" required="" placeholder="veuillez confirmer votre mot de passe">
    </div>
    <div class="myButton">
  <button type="submit" name="sign_up" value="sign_up">Valider</button>
</div>
  </form>
</div>
</main>
<?php require 'footer.php'; ?>