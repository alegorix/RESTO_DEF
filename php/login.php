<?php 
session_start();

if(isset($_POST['user_email']) && 
   isset($_POST['user_password'])){

    include "connect.php";

    $uemail = $_POST['user_email'];
    $upassword = $_POST['user_password'];

    $data = "user_email=".$uemail;
    
    if(empty($uemail)){
    	$em = "Adresse email requise";
    	header("Location: ../login.php?error=$em&$data");
	    exit;
    }else if(empty($upassword)){
    	$em = "Le mot de passe est requis";
    	header("Location: ../login.php?error=$em&$data");
	    exit;
    }else {

    	$sql = "SELECT * FROM tbl_users WHERE user_email = ?";
    	$query = $db->prepare($sql);
    	$query->execute([$uemail]);

      if($query->rowCount() == 1){
          $user = $query->fetch();

          $user_email =  $user['user_email'];
          $user_password =  $user['user_password'];
          $user_prenom =  $user['user_prenom'];
          $id_user =  $user['id_user'];
          //if is_admin ????
          $is_admin =  $user['is_admin'];



          if($user_email === $uemail){
             if(password_verify($upassword, $user_password)){
                 $_SESSION['id_user'] = $id_user;
                 $_SESSION['user_prenom'] = $user_prenom;
                 $_SESSION['is_admin'] = $is_admin;
                if ($is_admin == 0) {
                 header("Location: ../reservation_form.php");
                }
                else {header("Location: ../admin/index.php");}
                 exit;
             }else {
               $em = "Incorect User name or password";
               header("Location: ../login.php?error=$em&$data");
               exit;
            }

          }else {
            $em = "Incorect User name or password";
            header("Location: ../login.php?error=$em&$data");
            exit;
         }

      }else {
         $em = "Incorect User name or password";
         header("Location: ../login.php?error=$em&$data");
         exit;
      }
    }


}else {
	header("Location: ../login.php?error=error");
	exit;
}
