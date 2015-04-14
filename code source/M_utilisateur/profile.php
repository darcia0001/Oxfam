<?php
    require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurBD.php');
    $manageur=ManageurUtilisateur::getInstance();//gerer tous rapport objet/base de donnees
      // ---------------------------- gestion de la securité -------------------------
        session_start();
    
      if (!isset($_SESSION['utilisateur'])){
    
        header('Location:  connexion.php');
        exit();
      }
    // --------------------------------------------------------------------------------
      $_user=unserialize($_SESSION['utilisateur']);
      if( isset($_REQUEST["modification"])){
    
        $_user=$manageur->getUtilisateur($_REQUEST["email"] );
        //regarde permettre de change l email aussi
        if(isset($_REQUEST["nom"] )){
            $_user->setNom($_REQUEST["nom"]);
        }
        if(isset($_REQUEST["prenom"] )){
            $_user->setPrenom($_REQUEST["prenom"]);
        }
        if(isset($_REQUEST["password"] )){
            $mdp=$_REQUEST["password"];
    
            $_user->setPassword(sha1($mdp));
        }
        if(isset($_REQUEST["profil"] )){
            $_user->setProfil($_REQUEST["profil"]);
        }
        if(isset($_REQUEST["email"] )){
            $_user->setEmail($_REQUEST["email"]);
        }
        if(isset($_REQUEST["tel"] )){
            $_user->setTelephone($_REQUEST["tel"]);
        }
        if(isset($_REQUEST["structure"] )){
            $_user->setStructure($_REQUEST["structure"]);
        }
        if(isset($_REQUEST["groupe"] )){
            $_user->setGroupeUtilisateur($_REQUEST["groupe"]);
        }
        $manageur->update($_user);
        //apres la modification on revien a la page de de gestion des utilisateur
    
      }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>OxFam| Connexion</title>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0" />
        <meta name="description"
              content="" />
        <meta name="copyright"
              content="" />
        <link rel="stylesheet"
              type="text/css"
              href="../assets/css/style.css"
              media="all" />
        <link rel="stylesheet"
              type="text/css"
              href="../assets/style.css"
              media="all" />
        <script type="text/javascript"
                src="../assets/js/jquery.js"></script>
        <script type="text/javascript"
                src="../assets/js/js.js"></script>
        <script type="text/javascript"
                src="../assets/js/tab.js"></script>
        <!-- Bootstrap Core CSS -->
        <link href="../assets/css/bootstrap.min.css"
              rel="stylesheet">
        <!-- Bootstrap Core JavaScript -->
        <script src="../assets/js/bootstrap.min.js"></script>

        <script>
            function controle(){
                mdp = document.getElementById("mdp").value;
                vmdp = document.getElementById("vmdp").value;
                if ( mdp!=""){
                    if ( mdp.length>=5){
                            document.getElementById("saveUserBtn").disabled=false;
                            document.getElementById("notification").className="alert-info alert-dismissable ";
                            document.getElementById("notification").innerHTML="<span id='lb_pwdOK'>Le mot de passe est OK.</span>";
                            if (mdp==vmdp){
                                    document.getElementById("saveUserBtn").disabled=false;
                                    document.getElementById("notification").className="alert-info alert-dismissable";
                                    document.getElementById("notification").innerHTML="<span id='lb_pwdMatch'>Les mots de passe correspondent maintenant.</span>";
                                }else{
                                    document.getElementById("saveUserBtn").disabled=true;
                                    document.getElementById("notification").className="alert-danger alert-dismissable";
                                    document.getElementById("notification").innerHTML="<span id='lb_pwdDiff'>Les mots de passe ne correspondent pas ! Vérifiez encore.</span>";
                                }
                        }else{
                            document.getElementById("saveUserBtn").disabled=true;
                            document.getElementById("notification").className="alert-danger alert-dismissable";
                            document.getElementById("notification").innerHTML="<span id='lb_shortPwd'>Le mot de passe est trop court. Il doit être supérieur ou égal à 5 caractéres.</span>";
                    }
                }
            }
        </script>

        <!-- Pour l'internationalisation -->
        <script type="text/javascript"
                src="../assets/js/jquery-1.10.2.js"></script>
        <script type="text/javascript"
                src="../assets/js/jquery.i18n.properties-min-1.0.9.js"></script>
        <script type="text/javascript"
                src="../assets/js/translate_deletUser.js"></script>

    </head>
    <body style="padding-left: 60px; padding-right: 60px;">
        <div class="width80">
            <div class="col_12">
                <img class="col_2"
                     src="assets/img/logo.png"
                     alt="Logo" />
                <p class="col_2">
					OXFAM
                </p>
                <img class="col_2"
                     src="assets/img/logo.png"
                     alt="Logo" />
                <div class="col_4">
                    <span class="col_12"
                          id="msg_welcome">Bienvenue à </span>
                    <span class="col_12">
                        <span class="col_6">Prenom </span>
                        <span class="col_6">NOM </span>
                    </span>
                    <span class="col_12">Nom du projet / Pays</span>
                    <span class="col_12">
                        <select id="lang">
                            <option value="browser">-- Choix langue --</option>
                            <option value="fr">Français</option>
                            <option value="en">Anglais</option>
                        </select>
                    </span>
                </div>
                <div class="col_2">
                    <button class="small vert pill fright  icon-signout"
                            type="submit"
                            id="btn_quit">
						Quitter
                    </button>
                </div>
            </div>
            <ul class="breadcrumbs col_6">
                <li>
                    <a href=""
                       id="lnk_accueil">Accueil</a>
                </li>
                <li>
                    <a href=""
                       id="lnk_module">Module</a>
                </li>
                <li>
                    <a href=""
                       id="lnk_smodule">Sous-Module</a>
                </li>
            </ul>
            <p class="col_6 fright txtalignright">
				jj/mm/yy hh:mm
            </p>
            <img class="col_12 sparatorh2"
                 src="../assets/img/separateur.png" />
            <div class="row">
                <div class="panel panel-success col-md-6 col-md-offset-3">
                    <div class="panel-heading"
                         align="center"
                         id="lb_editProfile">
	                            Modifier votre profile
                    </div>
                    <div id="notification"
                         class="alert-danger alert-dismissable"
                         align="center"></div>
                    <div class="panel-body">
                        <form role="form">
                            <div class="form-group">
                                <label class="lb_fName"> Prénoms </label>
                                <input name="prenom"
                                       required=""
                                       class="form-control"
                                       placeholder="Entrer les prénoms"
                                       value="<?php echo $_user->getPrenom(); ?>">
                            </div>
                            <div class="form-group">
                                <label class="lb_name"> Nom </label>
                                <input name="nom"
                                       required=""
                                       class="form-control"
                                       placeholder="Entrer le nom"
                                       value="<?php echo $_user->getNom(); ?>">
                            </div>
                            <div class="form-group">
                                <label class="lb_profile"> Profil</label>
                                <select name="profil"
                                        class="form-control"
                                        required="">
                                    <option class="opt_agOxf"
                                            value="agentoxfam"
                                            <?php echo $profil1; ?>>Agent oxfam</option>
                                    <option value="agentprojet"
                                            class="opt_agProj"
                                            <?php echo $profil2; ?>>Agent projet</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="lb_email"> Email </label>
                                <input name="email"
                                       required=""
                                       type="email"
                                       class="form-control"
                                       placeholder="Entrer l'adresse email"
                                       value="<?php echo $_user->getEmail() ?>">
                            </div>
                            <div class="form-group">
                                <label class="lb_pwd"> Mot de passe </label>
                                <input name="password"
                                       id="mdp"
                                       required=""
                                       type="password"
                                       class="form-control"
                                       placeholder="Entrer le mot de passe"
                                       value="<?php echo $_user->getPassword(); ?>">
                            </div>
                            <div class="form-group">
                                <label class="lb_verifPwd"> Vérification du mot de passe </label>
                                <input name="vmdp"
                                       id="vmdp"
                                       required=""
                                       type="password"
                                       class="form-control"
                                       placeholder="Entrer le mot de passe à nouveau"
                                       value="<?php echp $_user->getPassword(); ?>">
                            </div>
                            <!-- id d l utilisateur a modifier -->
                            <div class="form-group"
                                 id="divBtn"
                                 onmouseover="controle()">
                                <button id="modifUserBtn"
                                        type="submit"
                                        class="btn btn-lg btn-success btn_submit"><i class="fa fa-check"></i>
                                    Valider
                                </button>

                            </div>
                        </form>
                        <!-- g -->
                    </div>
                </div>
            </div>
            <!-- FOOTER -->
            <footer class="navbar-fixed-bottom"
                    style="background-color: #DDDDDD">
                <div class="container">
                    <br />
                    <p class="pull-right"><a href="#"
                                             id="lb_backTop"> Retour en haut </a></p>
                    <p>&copy; 2015 Oxfam &middot;
                        <a href="../confidentialites.php"
                           id="lb_confid">Confidentialité</a> &middot;
                        <a href="../conditions.php"
                           id="lb_terms">Conditions d'utilisation</a></p>
                </div>
            </footer>

    </body>
    <!-- MODAL POUR LA MODIFICATION D'UN UTILISATEUR -->
    <div class="modal fade"
         id="modifyUser"
         tabindex="-1"
         role="dialog"
         aria-labelledby="modifyUser"
         aria-hidden="true">
        <div class="modal-dialog modal-lg"
             id="modifUser">

            <!-- Le formulaire a  ajouter ici avec les recnseignements sur l'utilisateur, avec AJAX -->
            <!-- /.panel-body -->
        </div>
    </div>
</html>
    