<?php
// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['nom_plat']) && !empty($_POST['nom_plat'])
    && isset($_POST['prix_plat']) && !empty($_POST['prix_plat'])
    && isset($_POST['type_plat']) && !empty($_POST['type_plat'])
    ){



        $currentDirectory = getcwd();
        $uploadDirectory = "/images/";
    
    
        //$fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 
    
        $fileName = $_FILES['image']['name'];
        //$fileSize = $_FILES['image']['size'];
        $fileTmpName  = $_FILES['image']['tmp_name'];
        //$fileType = $_FILES['image']['type'];
        //$fileExtension = strtolower(end(explode('.',$fileName)));
    
        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 
    
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);


        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
        $nom_plat = strip_tags($_POST['nom_plat']);
        $prix_plat = strip_tags($_POST['prix_plat']);
        $type_plat = strip_tags($_POST['type_plat']);
        $image_produit = strip_tags($_POST['image']);
        $imageprod = $fileName;

        $sql = 'INSERT INTO `tbl_menu` (`nom_plat`, `prix_plat`, `type_plat`, `photo_plat` ) VALUES (:nom_plat, :prix_plat, :type_plat, :imageprod);';

        $query = $db->prepare($sql);

        $query->bindValue(':nom_plat', $nom_plat, PDO::PARAM_STR);
        $query->bindValue(':prix_plat', $prix_plat, PDO::PARAM_STR);
        $query->bindValue(':type_plat', $type_plat, PDO::PARAM_STR);
        $query->bindValue(':imageprod', $imageprod, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Plat ajouté";
        require_once('close.php');

        header('Location: index.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>

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
                <h1>Ajouter un plat</h1>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nom_plat">Nom du plat</label>
                        <input type="text" id="nom_plat" name="nom_plat" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="prix_plat">Prix du plat</label>
                        <input type="text" id="prix_plat" name="prix_plat" class="form-control">

                    </div>
                   
                    <?php
        require_once('connect.php');
        $sql = "SELECT * FROM  tbl_type_plat";
  $query = $db->prepare($sql);
$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);

if ($query->rowCount() > 0) { ?>


                    <div class="form-group">
                    <label for="type_plat">Type de plat</label>

                    <select class="custom-select" name="type_plat">
                        <option selected>Choisissez votre type de plat</option>

                        <?php foreach ($results as $row) { ?>
                        <option value="<?php echo $row['id_type_plat']; ?>"><?php echo $row['nom_type_plat']; ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="image">Image du produit</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                   
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
