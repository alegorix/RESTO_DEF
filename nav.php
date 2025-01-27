<nav class="navbar fixed-top bg-dark navbar-expand-sm border-bottom border-body" data-bs-theme="dark" style="background-color:pink!important; border-color:pink!important;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Mon restaurant</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-house"></i> Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($page == 'carte') { echo 'active';}?>" href="carte.php"><i class="fa-solid fa-utensils"></i> Carte</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($page == 'contact') { echo 'active';}?>" href="contact.php"><i class="fa-solid fa-envelope"></i> Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>