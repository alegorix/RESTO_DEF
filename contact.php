<?php
// On démarre une session
session_start();
$page = 'contact';
$titre = 'Contactez le restaurant';
?>
<?php include('head.php'); ?>
<?php include('nav.php'); ?>
    <div class="container">
        <h1>Contactez-nous</h1>
        <div class="row">
            <div class="col-md-6">
            <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <?php
                    if(!empty($_SESSION['merci'])){
                        echo '<div class="alert alert-success" role="alert">
                                '. $_SESSION['merci'].'
                            </div>';
                        $_SESSION['merci'] = "";
                    }
                ?>





                <form method="post" action="traitement_contact.php">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom">
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="nom@exemple.com" required>
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" id="telephone" name="telephone" required>
                                                                            
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Votre message</label>
                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Envoyer votre message</button>
                </div>
                </form>


            </div>
            <div class="col-md-6">
            <div class="card adresse">
                <div class="card-body">
                    Square des Martyrs 1 - 6000 Charleroi<br>Téléphone : 071/123456
                </div>
            </div>
            
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d635.7337391267594!2d4.4392367667664345!3d50.40504977158354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c225e1d795e001%3A0x6d3530d37d3122a7!2sSq.%20des%20Martyrs%201%2C%206000%20Charleroi!5e0!3m2!1sfr!2sbe!4v1736256891893!5m2!1sfr!2sbe" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>   
