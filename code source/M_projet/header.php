    <header class="my_header">
        <div class="container">
            <div class="row">
                <div class="col-md-1"><img src="../ressources/img/logo.png" title="logo"></div> 
                <div class="col-md-1 col-md-offset-2">OXFAM</div>
                <div class="col-md-offset-5 col-md-2"> Bienvenue <br> <?php echo $user->getPrenom()." ".$user->getNom()?><br> <select><option name="francais">Francais</option> <option name="anglais">English</option></select>  </div>
                <div class=" col-md-1">  <a href="../M_utilisateur/deconnexion.php"><img src="../ressources/img/quitter.png"> </a></div>
            </div>
        </div>
    </header>