<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Connexion</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    	<form class="shadow w-450 p-3" 
    	      action="php/login.php" 
    	      method="post">

    		<h4 class="display-4  fs-1">Connexion</h4><br>
    		<?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
			</div>
		    <?php } ?>

		  <div class="mb-3">
		    <label class="form-label">Adresse email</label>
		    <input type="text" 
		           class="form-control"
		           name="user_email"
		           value="<?php echo (isset($_GET['user_email']))?$_GET['user_email']:"" ?>">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Mot de passe</label>
		    <input type="password" 
		           class="form-control"
		           name="user_password">
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Connexion</button>
		  <a href="reservation.php" class="link-secondary">Créer un compte</a>
		</form>
    </div>
</body>
</html>