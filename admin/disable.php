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

    // On "accroche" les paramètre (id_plat)
    $query->bindValue(':id_plat', $id_plat, PDO::PARAM_INT);
    
    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $produit = $query->fetch();
    // On vérifie si le produit existe
    if(!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
    }

    $menu_active = ($produit['menu_active'] == 0) ? 1 : 0;

    $sql = 'UPDATE `tbl_menu` SET `menu_active`=:menu_active WHERE `id_plat` = :id_plat;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètres
    $query->bindValue(':id_plat', $id_plat, PDO::PARAM_INT);
    $query->bindValue(':menu_active', $menu_active, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    
    header('Location: index.php');

}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}