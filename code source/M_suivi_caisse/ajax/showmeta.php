<?php
require("../classes/ManageurBD.php");


	$manageur=ManageurOperation::getInstance();
		if(isset($_REQUEST["id"])){
			$operation=$manageur->getMetadonnee(intval($_REQUEST["id"]));
		echo '
		<div class="modal-content" >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Affichage de  la métadonnée</h4>
          </div>
          <div class="modal-body" >
		             	<div class="panel panel-primary">
	                        <div class="panel-heading">
	                            <i class="fa fa-eye"></i>
	                        </div>
	                        <div class="panel-body" >
	                         <div id="notification" class=" alert-danger alert-dismissable " align="center"></div>
								<form role="form" action="addmeta.php">
                                        <div class="form-group">
                                            <label> Titre </label>  
                                            <abbr class="pull-right"  title="Titre du document, à priori titre principal. Un qualificatif : alternative (autres titres)"> Aide ? </abbr> 
                                            <input disabled="" name="title" id="title" class="form-control" placeholder="" value="'.$meta->getTitle().'">
                                        </div>
                                        <div class="form-group">
                                            <label> Auteur </label> 
                                            <abbr class="pull-right "  title="Nom de la personne, de l"organisation ou du service à l"origine de la rédaction du document"> Aide ? </abbr>
                                            <input disabled="" name="creator" id="creator" class="form-control" placeholder="" value="'.$meta->getCreator().'">
                                        </div>
                                        <div class="form-group">
                                            <label> Sujet </label>
                                             <abbr class="pull-right "  title="Sujet,mots-clés, phrases de résumé, ou codes de classement"> Aide ? </abbr>
                                            <input disabled="" name="subject" id="subject" class="form-control" placeholder="" value="'.$meta->getSubject().'">
                                        </div>
                                        <div class="form-group">
                                            <label> Description </label>
                                            <abbr class="pull-right "  title="Résumé, table des matières, ou texte libre  
Qualificatifs : abstract et tableOfContents"> Aide ? </abbr>
                                            <textarea disabled="" name="description" id="description" class="form-control" placeholder="">  '.$meta->getDescription().'</textarea
                                        </div>
                                        <div class="form-group">
                                            <label> Publieur  </label>
                                            <abbr class="pull-right "  title="Nom de la personne, de l\'organisation ou du service à l\'origine de la publication du document"> Aide ? </abbr>
                                            <input disabled="" name="publisher" id="publisher" class="form-control" placeholder="" value="'.$meta->getPublisher().'">
                                        </div>
                                        <div class="form-group">
                                            <label> Contribueur  </label>
                                            <abbr class="pull-right "  title="Nom d\'une personne, d\'une organisation ou d\'un service qui contribue ou a contribué à l\'élaboration du document"> Aide ? </abbr>
                                            <input disabled=""  name="contributor" id="contributor" class="form-control" placeholder="" value="'.$meta->getContributor().'">
                                        </div>
                                        <div class="form-group">
                                            <label> Date  </label>
                                            <abbr class="pull-right "  title="Date d\'un évènement dans le cycle de vie du document
Huit qualificatifs"> Aide ? </abbr>
                                            <input disabled="" type="date"  name="date" id="date" class="form-control" placeholder="" value="'.$meta->getDate().'">
                                        </div>
                                        <div class="form-group">
                                            <label> Type  </label>
                                            <abbr class="pull-right "  title="Nature ou genre du contenu"> Aide ? </abbr>
                                            <input disabled="" name="type" id="type" class="form-control" placeholder="" value="'.$meta->getType().'">
                                        </div>
                                        <div class="form-group">
                                            <label> Format  </label>
                                            <abbr class="pull-right "  title="Format physique ou électronique du document 
Qualificatifs : extend et medium"> Aide ? </abbr>
                                            <input  disabled="" required="" name="format" id="format" class="form-control" placeholder="" value="'.$meta->getFormat().'">
                                        </div>
                                        <div class="form-group">
                                            <label> Identifiant  </label>
                                            <abbr class="pull-right "  title="Identificateur non ambigu, Système de référencement standardisé (URI, ISBN…)"> Aide ? </abbr>
                                            <input disabled="" required="" name="identifier" id="identifier" class="form-control" placeholder="" value="'.$meta->getIdentifier().'">
                                        </div>
                                        <div class="form-group">
                                            <label> Source  </label>
                                            <abbr class="pull-right "  title="Ressource dont dérive le document en totalité ou en partie"> Aide ? </abbr>
                                            <input disabled="" name="source" id="source" class="form-control" placeholder="" value="'.$meta->getSource().'">
                                        </div>
                                        <div class="form-group">
                                            <label> Langue  </label>
                                            <abbr class="pull-right "  title="Langue du document"> Aide ? </abbr>
                                            <input disabled="" required="" name="language" id="language" class="form-control" placeholder="" value="'.$meta->getLanguage().'">
                                        </div>
                                        <div class="form-group">
                                            <label> Relation  </label>
                                            <abbr class="pull-right "  title="Ressource liée, logiquement ou techniquement 
Dénomination formelle recommandée 
Douze qualificatifs"> Aide ? </abbr>
                                            <input disabled="" name="relation"  id="relation" class="form-control" placeholder="" value="'.$meta->getRelation().'">
                                        </div>
                                        <div class="form-group">
                                            <label> Couverture  </label>
                                            <abbr class="pull-right "  title="Portée du document, couverture temporelle, spatiale ou administrative 
Qualificatifs : spatial et temporal"> Aide ? </abbr>
                                            <input disabled="" name="coverage" id="coverage" class="form-control" placeholder="" value="'.$meta->getCoverage().'">
                                        </div>
                                        <div class="form-group">
                                            <label> Droits  </label>
                                            <abbr class="pull-right "  title="Informations sur le statut des droits de la ressource ou lien vers le détenteur des droits 
Trois qualificatifs (dont 2 récents) "> Aide ? </abbr>
										<input disabled="" name="rights" id="rights" class="form-control" placeholder="" value="'.$meta->getRights().'">
                                            
                                        </div>
                                        
                                            <input name="id" id="id" type="hidden" value="'.$meta->getId().'">

                                    </form>
			      
								    </div>
						          </div>
						          <div class="modal-footer">
						            <button type="button" class="btn btn-primary" data-dismiss="modal">Terminer</button>
						          </div>
			      
		      ';
  
  	}
?>