
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Réservation</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    	<form class="shadow w-450 p-3" 
    	      action="php/signup.php" 
    	      method="post">

    		<h4 class="display-4  fs-1">Créer votre compte</h4><br>
    		<?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
			</div>
		    <?php } ?>

		    <?php if(isset($_GET['success'])){ ?>
    		<div class="alert alert-success" role="alert">
			  <?php echo $_GET['success']; ?>
			</div>
		    <?php } ?>
		  <div class="mb-3">
		    <label class="form-label">Nom</label>
		    <input type="text" 
		           class="form-control"
		           name="user_nom"
		           value="<?php echo (isset($_GET['user_nom']))?$_GET['user_nom']:"" ?>">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Prénom</label>
		    <input type="text" 
		           class="form-control"
		           name="user_prenom"
		           value="<?php echo (isset($_GET['user_prenom']))?$_GET['user_prenom']:"" ?>">
		  </div>

          <div class="mb-3">
		    <label class="form-label">Email</label>
		    <input type="email" 
		           class="form-control"
		           name="user_email"
		           value="<?php echo (isset($_GET['user_email']))?$_GET['user_email']:"" ?>">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Téléphone</label>
		    <input type="text" 
		           class="form-control"
		           name="user_phone"
		           value="<?php echo (isset($_GET['user_phone']))?$_GET['user_phone']:"" ?>">
		  </div>


		  <div class="mb-3">
		    <label class="form-label">Mot de passe</label>
		    <input type="password" 
		           class="form-control"
		           name="user_password">
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Créer mon compte</button>
		  <a href="login.php" class="link-secondary">Connexion</a>
		</form>
    </div>
</body>
</html>