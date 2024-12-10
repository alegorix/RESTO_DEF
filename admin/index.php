<?php
// On démarre une session
session_start();

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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
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
                                <td><img height="20px" alt="photo du plat" src="images/<?= $menu['photo_plat'] ?>"></td>
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
</body>
</html>
