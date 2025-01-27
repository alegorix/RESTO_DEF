<?php
// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['email']) && !empty($_POST['email'])
    && isset($_POST['telephone']) && !empty($_POST['telephone'])
    && isset($_POST['message']) && !empty($_POST['message'])
    ){
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $email = strip_tags($_POST['email']);
        $telephone = strip_tags($_POST['telephone']);
        $message = strip_tags($_POST['message']);

        $sql = 'INSERT INTO `tbl_contact` (`nom`, `prenom`, `email`, `telephone`, `message` ) VALUES (:nom, :prenom, :email, :telephone, :message);';

        $query = $db->prepare($sql);

        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':telephone', $telephone, PDO::PARAM_STR);
        $query->bindValue(':message', $message, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['merci'] = "Merci de nous avoir contacté.";
        require_once('close.php');

        header('Location: contact.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet.";
        header('Location: contact.php');
    }
}

?>