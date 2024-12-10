<?php 
session_start();

if (isset($_SESSION['id_user']) && isset($_SESSION['user_prenom']) && ($_SESSION['is_admin']==1)) {


// On inclut la connexion à la base
require_once('../php/connect.php');

// SELECT de la table tbl_menu avec une jonction de la table tbl_type_plat pour pouvoir afficher les noms des types de plats (entrées, plats, desserts...)
$sql = 'SELECT * FROM `tbl_menu` JOIN `tbl_type_plat` ON tbl_menu.type_plat = tbl_type_plat.id_type_plat';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);


require_once('../php/close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar bg-dark navbar-expand-lg" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Administration</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Tableau de bord</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../logout.php">Déconnexion</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
     
      </ul>
      
    </div>
  </div>
</nav>
    <main class="container">
        <div class="row">
            <section class="col-12">
            <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <?php
                    if(!empty($_SESSION['message'])){
                        echo '<div class="alert alert-success" role="alert">
                                '. $_SESSION['message'].'
                            </div>';
                        $_SESSION['message'] = "";
                    }
                ?>
                <h1>Liste des menus</h1>
                <table class="table">
                    <thead>
                        <th>id_plat</th>
                        <th>type_plat</th>
                        <th>nom_plat</th>
                        <th>desc_plat</th>
                        <th>prix_plat</th>
                        <th>photo_plat</th>
                        <th>Actif</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        foreach($result as $menu){
                        ?>
                            <tr>
                                <td><?php echo $menu['id_plat'] ?></td>
                                <td><?= $menu['nom_type_plat'] ?></td>
                                <td><?= $menu['nom_plat'] ?></td>
                                <td><?= $menu['desc_plat'] ?></td>
                                <td><?= $menu['prix_plat'] ?> €</td>
                                <td><img height="20px" alt="photo du plat" src="../images/<?= $menu['photo_plat'] ?>"></td>
                                <td><?= $menu['menu_active'] ?></td>
                                <td><a href="disable.php?id=<?= $menu['id_plat'] ?>">A/D</a> <a href="details.php?id=<?= $menu['id_plat'] ?>">Voir</a> <a href="edit.php?id=<?= $menu['id_plat'] ?>">Modifier</a> <a href="delete.php?id=<?= $menu['id_plat'] ?>">Supprimer</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter un produit</a>
            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
<?php }else {
	header("Location: ../login.php");
	exit;
} ?>