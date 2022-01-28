<?php
require 'db.php';

if(isset($_SESSION['login'])){
    $oldlogin=$_SESSION['login'];
    $connexion=$dbase->prepare("SELECT id FROM `utilisateurs` WHERE `login`= :login ");
    $connexion->execute(array(':login' => $oldlogin));
    $connexionfetch1=$connexion->fetchall(PDO::FETCH_ASSOC);

    if(isset($_POST['envoyer'])){
        $peudo=$connexionfetch1[0]['id'];
        $comment=htmlspecialchars($_POST['comment'],ENT_QUOTES);
        $connexion=$dbase->prepare("INSERT INTO `commentaires`(`commentaire`, `id_utilisateurs`, `date`) VALUES (:comment,:pseudo,:date)");
        $connexion->execute(array(
            ':comment'=>$comment,
            ':pseudo'=>$connexionfetch1[0]['id'],
            ':date'=>date('Y-m-d H:i:s')
        ));
        header("location:livre-or.php");
    }
    
    }
?>



<form method='post' >

<p>Laissez nous un commentaire !</p>
<p>
    Pseudo :<?php echo $_SESSION['login']; ?><input name='pseudo' value='<?php echo $connexionfetch1[0]['id'] ?>' type='hidden' >  <br />
    Message :<br />
    <textarea name='comment' rows='8' cols='35' style='resize:none'></textarea><br />
    <input type='submit' name='envoyer'value='Envoyer' />
</p>
</form>




 
