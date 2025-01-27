<?php
// On démarre une session
session_start();
$page = 'carte';
$titre = "Carte du 'restaurant";

// On inclut la connexion à la base
require_once('connect.php');

// SELECT de la table tbl_menu avec une jonction de la table tbl_type_plat pour pouvoir afficher les noms des types de plats (entrées, plats, desserts...)
$sql = 'SELECT * FROM `tbl_menu` JOIN `tbl_type_plat` ON tbl_menu.type_plat = tbl_type_plat.id_type_plat';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);


require_once('close.php');


?>
<?php include('head.php'); ?>
<?php include('nav.php'); ?>
    <div class="container">
        <h1>La carte</h1>
        <div class="row">

        <?php
                        // On boucle sur la variable result
                        foreach($result as $menu){
                        ?>


            <div class="col-md-4 mb-3">
            <div class="card" style="">
  <img src="images/<?= $menu['photo_plat'] ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?= $menu['nom_plat'] ?></h5>
    <p class="card-text"><?= $menu['desc_plat'] ?></p>
  </div>
  <div class="card-footer text-body-secondary">
  <?= $menu['prix_plat'] ?>  euros
  </div>
</div>
</div>
<?php //fin de boucle
                        }
                        ?>





        </div>
    </div>
<?php include('footer.php'); ?>   

