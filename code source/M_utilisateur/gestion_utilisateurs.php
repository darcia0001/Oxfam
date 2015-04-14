<?php
    require_once(realpath(dirname(__FILE__)) . '/../classes/Manageur/ManageurBD.php');
    $manageur=ManageurUtilisateur::getInstance();//gerer tous rapport objet/base de donneeq
      // ---------------------------- gestion de la securité -------------------------
        session_start();
      if (!isset($_SESSION['user'])){
    
        header('Location:  connexion.php');
        exit();
      }
        //redirection suivant le profil de l utilisateur
        if (isset($_SESSION['utilisateur'])){
         $user =  unserialize($_SESSION['utilisateur']);
           if (($user->getProfil())=='agenprojet'){//si c est un agent projet on le redirige
            header("Location: ..");exit();
           }
           if (($user->getProfil())=='agenprojet'){//si c est un agent oxfam on le redirige
            header("Location: ..");exit();
           }
      }
    // --------------------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>OxFam | Gestion Utilisateurs</title>
        <meta charset="utf-8">
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
        
        <!-- Modal JS Script -->
        <script src="../assets/js/gestion_utilisateurs_modal.js"></script>
        
        <!-- Pour l'internationalisation -->
        <script type="text/javascript"
                src="../assets/js/jquery-1.10.2.js"></script>
        <script type="text/javascript"
                src="../assets/js/jquery.i18n.properties-min-1.0.9.js"></script>
        <script type="text/javascript"
                src="../assets/js/translate_gestionUtilisateur.js"></script>

    </head>
    <body style="padding-left: 60px; padding-right: 60px;">
        <div class="width80">
            <div class="col_12">
                <img class="col_2"
                     src="../assets/img/logo.png"
                     alt="Logo" />
                <p class="col_2">
					OXFAM
                </p>
                <img class="col_2"
                     src="../assets/img/logo.png"
                     alt="Logo" />
                <div class="col_4">
                    <span class="col_12"
                          id="msg_welcome">Bienvenue à 
                    </span>
                    <span class="col_12">
                        <span class="col_6">Prenom </span>
                        <span class="col_6">NOM </span>
                    </span>
                    <span class="col_12">Nom du projet / Pays</span>
                    <span class="col_12">
                        <select id="lang">
                            <option value="browser">-- Choix langue --</option>
                            <option value="fr">Français</option>
                            <option value="en">English</option>
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
                 src="assets/img/separateur.png"
                 alt="Seperator" />
            <div class="col_6">
                <span class="col_6 icon-dashboard fsize45"></span>
                <div class="col_6">
                    <br />
                    <span id="lb_gestUsers">Gestion Utilisateurs</span>
                </div>
            </div>
            <div class="col_6">
                <a href="#"
                   id="btn_add"
                   title="ajouter"
                   onclick="addUser();"
                   type="button"
                   class="btn btn-success btn-circle"
                   data-toggle="modal"
                   data-target="#modifyUser">
                    Ajouter
                    <i class="fa fa-edit"></i>
                </a>
                <a href="#"
                   title="Modifier"
                   id="btn_edit"
                   onclick="modifyUser();"
                   type="button"
                   class="btn btn-success btn-circle"
                   data-toggle="modal"
                   data-target="#modifyUser">
                    Modifier
                    <i class="fa fa-edit"></i>
                </a>
                <a href="#"
                   title="Supprimer"
                   id="btn_del"
                   onclick="deleteUser();"
                   type="button"
                   class="btn btn-success btn-circle"
                   data-toggle="modal"
                   data-target="#modifyUser">
                    Supprimer
                    <i class="fa fa-edit"></i>
                </a>

            </div>
            <table class="sortable striped col_11 "
                   cellpadding="0"
                   cellspacing="0"
                   id="userTable">
                <caption>
                    <h1 class="bloc100  blue_menu"
                        id="lb_lstGroups"> Liste des Groupes d'utilisateurs</h1>
                </caption>
                <thead>
                <tr>
                    <th><input onchange="checkall(this)"
                               type="checkbox" /> </th>
                    <th width="20%"
                        id="hd_fName">Prenom </th>
                    <th width="10%"
                        id="hd_name">Nom </th>
                    <th width="20%"
                        id="hd_mail">eMail </th>
                    <th width="10%"
                        id="hd_profile">Profil </th>
                    <th width="20%"
                        id="hd_struct"> Structure </th>
                    <th width="20%"
                        id="hd_group"> Groupe </th>

                </tr>
                </thead>
                <tbody>
                    <?php
                        
                        
                         $lesutilisateurs=$manageur->getListUtilisateur();
                        
                        //echo var_dump($lesutilisateurs);
                        foreach ($lesutilisateurs as $user){
                    ?>
                <tr class="">
                    <td>
                        <input name="iduser"
                               value="<?php echo $user->getEmail();?>"
                               type="checkbox"
                               onchange="eventCheck(this.value)" />
                    </td>
                    <td><?php  echo $user->getPrenom() ?>
                    </td>
                    <td><?php  echo $user->getNom() ?>
                    </td>
                    <td><?php  echo $user->getEmail() ?>
                    </td>
                    <td><?php  echo $user->getProfil() ?>
                    </td>
                    <td><?php  echo $user->getStructure() ?>
                    </td>
                    <td><?php  echo $user->getGroupeUtilisateur() ?>
                    </td>
                </tr>

                <?php
                    
                    }	
                    
                ?>

                                    </tbody>
            </table>
            <div class="col_12 bar">
                <a href="#"
                   onclick="masquerTab('bq1',document.getElementById('opbq1').value,'opbq1');"> <span class="col_1 icon-arrow-down fsize30 sourismain"></span></a>
                <!-- ok -->
                <br />
                <img class="col_12"
                     src="../assets/img/separateur.png"
                     height="4"
                     alt="Separateur" />
                <br />

                <input type="hidden"
                       name="opbq1"
                       id="opbq1"
                       value="mask" />
                <input type="hidden"
                       name="opbq2"
                       id="opbq2"
                       value="mask" />

            </div>
        </div>
        <footer>
            <hr />
            <div class="frontoffstat_piedpage">
		Infos OXFAM / Phone / Adresse / etc.
            </div>
            <hr class="ligne_rouge" />
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
    <!-- DataTables JavaScript -->
    <script src="../assets/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({	
                language: {
                    processing:     "Traitement en cours...",
                    search:         "Rechercher&nbsp;:",
                    lengthMenu:    "Afficher _MENU_ utilisateurs",
                    info:           "Affichage de l'utilisateur _START_ &agrave; _END_ sur _TOTAL_ utilisateurs",
                    infoEmpty:      "Affichage de l'utilisateur 0 &agrave; 0 sur 0 utilisateurs",
                    infoFiltered:   "(filtr&eacute; de _MAX_ utilisateurs au total)",
                    infoPostFix:    "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    emptyTable:     "Aucune donnée disponible dans le tableau",
                    paginate: {
                        first:      "Premier",
                        previous:   "Pr&eacute;c&eacute;dent",
                        next:       "Suivant",
                        last:       "Dernier"
                    },
                    aria: {
                        sortAscending:  ": activer pour trier la colonne par ordre croissant",
                        sortDescending: ": activer pour trier la colonne par ordre décroissant"
                    }
                },
                });
        } );
    </script>
</html>
