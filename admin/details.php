<?php
// On démarre une session
session_start();

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id_plat = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `tbl_menu` WHERE `id_plat` = :id_plat;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id_plat', $id_plat, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $plat = $query->fetch();

    // On vérifie si le produit existe
    if(!$plat){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du plat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container"> 
        <div class="row">
            <section class="col-12">
                <h1>Détails du plat : <?= $plat['nom_plat'] ?></h1>
                <p>ID : <?= $plat['id_plat'] ?></p>
                <p>Type de plat : <?= $plat['type_plat'] ?></p>
                <p>Prix : <?= $plat['prix_plat'] ?> €</p>
                <p>Description : <?= $plat['desc_plat'] ?></p>
                <br>
                <img src="images/<?= $plat['photo_plat'] ?>">
                <br>
                <p><a href="index.php">Retour</a> <a href="edit.php?id=<?= $plat['id_plat'] ?>">Modifier</a></p>
            </section>
        </div>
    </main>
</body>
</html>