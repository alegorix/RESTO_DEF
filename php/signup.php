<?php 

if(isset($_POST['user_nom']) && 
   isset($_POST['user_prenom']) && 
   isset($_POST['user_email']) && 
   isset($_POST['user_phone']) && 
   isset($_POST['user_password'])){

    include 'connect.php';

    $user_nom = $_POST['user_nom'];
    $user_prenom = $_POST['user_prenom'];
    $user_email = $_POST['user_email'];
    $user_phone= $_POST['user_phone'];
    $user_password = $_POST['user_password'];

    $data = "user_nom=".$user_nom."&user_prenom=".$user_prenom."&user_email=".$user_email."&user_phone=".$user_phone;
    
    if (empty($user_nom)) {
    	$em = "Le nom est requis";
    	header("Location: ../index.php?error=$em&$data");
	    exit;
    }else if(empty($user_prenom)){
    	$em = "Le prénom est requis";
    	header("Location: ../index.php?error=$em&$data");
	    exit;

    }else if(empty($user_email)){
    	$em = "Le champ email est requis";
    	header("Location: ../index.php?error=$em&$data");
	    exit;
    }else if(empty($user_phone)){
    	$em = "Le téléphone est requis";
    	header("Location: ../index.php?error=$em&$data");
	    exit;

    }else if(empty($user_password)){
    	$em = "Le mot de passe est requis";
    	header("Location: ../index.php?error=$em&$data");
	    exit;
    }else {

    	// hashing the password
    	$user_password = password_hash($user_password, PASSWORD_DEFAULT);

    	$sql = "INSERT INTO tbl_users(user_nom, user_prenom, user_email, user_phone, user_password) 
    	        VALUES(?,?,?,?,?)";
    	$query = $db->prepare($sql);
    	$query ->execute([$user_nom, $user_prenom, $user_email, $user_phone, $user_password]);
    	header('Location: ../login.php?success=Your account has been created successfully');
	    exit;
    }


}else {
	header("Location: ../index.php?error=error");
	exit;
}
