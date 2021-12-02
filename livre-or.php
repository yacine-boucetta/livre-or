<?php
session_start();
require 'db.php';

$commentaire=$dbase->prepare("SELECT login,commentaire,date FROM utilisateurs INNER JOIN commentaires WHERE utilisateurs.id = commentaires.id_utilisateurs ORDER BY date DESC LIMIT 5");
$commentaire->execute();
$vucommentaire=$commentaire->fetchAll(PDO::FETCH_ASSOC);


?>

<?php require 'header.php'; ?>
  <?php if(isset($_SESSION['login'])){
      echo"<div class='co'>";
      require 'commentaire.php';
  }
  else{
      echo"<div class='co'>";
  }
  ?>
    <table class="table">
        <thead>
        <?php echo '<tr>';
            foreach ($vucommentaire[0] as $key => $value){
            echo "<th>$key</th>";
            }
            echo '</tr>';
        ?>
        </thead>
        <tbody>
            <tr>
                <?php foreach($vucommentaire as $key => $value){ 
                    echo '<tr>';
                    foreach ($value as $key1 => $value1) 
                        {
                            echo "<td>$value1</td>";
                        }
                    echo '</tr>'; 
                }
                ?>
        </tbody>
    </table>
            </div>
<?php require 'footer.php'; ?>