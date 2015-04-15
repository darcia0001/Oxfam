 -- creation de type pour les différentes classes du diagramme de classes proposé par la conception
 -- 1 -- création du type de la classe LigneBudget  et tout ce qui s'y rattache
 CREATE TYPE t_ligneBudget AS object(
 	libelle varchar(30),
 	montantPrevu number,
 	montantExecute number
 	); 
 /
-- la classe ActiviteB est une aggrègation de la clASse LigneBudget
-- donc elle a une vue sur la clASse LigneBudget et contient une liste de la clASse LigneBudget
CREATE TYPE t_refLigneBudget AS object (
	valeur ref t_ligneBudget
	);
/
--création de la colléection de ligne bdget
CREATE TYPE t_listRefLigneBudget AS  TABLE  of t_refLigneBudget;
/

 -- 2 -- création du TYPE de la classe Mois et tout se qui rattache
 CREATE TYPE t_mois AS object(
 	code varchar(30),
 	libelle varchar(30),
 	etat varchar(30)
 	);
/
-- la classe AnneeCompable contient une liste d'instance de la classe Mois
--donc il faut créer les références de la classe 
CREATE TYPE t_refMois AS object(
	valeur ref t_mois
	);
/

CREATE TYPE t_listRefMois AS  TABLE  of t_refMois;
/
-- 3 -- création du type de la classe ElementPlanMensuel et ses dérivées
CREATE TYPE t_elementPlanMensuel AS object(
	code varchar(30),
	libelle varchar(30),
	montant number
 	);
/
-- pour les memes raisons pour la classe Mois nous créons les dérivées suivantes :
 -- création de la référence à la classe ElementPlanMensuel
CREATE TYPE t_refElementPlanMensuel AS object(
	valeur ref t_elementPlanMensuel
	);
/

CREATE TYPE t_listeRefElementPlanMensuel AS  TABLE  of t_refElementPlanMensuel;
/
-- 4 -- classe PlanMensuel qui a une référence de la classe Mois et qui a une liste d'instance de la classe ElementPlanMensuel
CREATE TYPE t_planMensuel AS object (
	code varchar(30),
	libelle varchar(30),
	refMois ref t_mois,
	listeRefElementPlanMensuel t_listeRefElementPlanMensuel
	);
/
-- la classe PlanAnnuel a une liste d'instance de la classe PlanMensuel; nous allons construir cette liste

CREATE TYPE t_refPlanMensuel AS object (
	valeur ref t_planMensuel
	);
/
CREATE TYPE t_listeRefPlanMensuel AS  TABLE  of t_refPlanMensuel;
/
 -- 5 -- création du type de la classe AnneeComptable. Elle doit avoir une liste d'instance de la classe Mois
 CREATE TYPE t_anneeComptable AS object(
 	code varchar(30),
 	libelle varchar(30),
 	etat varchar(30),
 	listeRefMois t_listRefMois
 	);
/

-- 6 -- création de la classe  ActiveB et ses dérivées
CREATE TYPE t_activiteB AS object(
	libelle varchar(30),
	dateDebut date,
	dateFin date,
	montantPrevu number,
 	listRefLigneBudget t_listRefLigneBudget
 	);
/
 --- création de collection d'aciviteB
 CREATE TYPE t_refActiviteB AS object (
 	valeur ref t_activiteB
 	);
 /
 -- 7 -- la clase Themes a un aperçu de la classe ActiveB. Il est représenté par une référence 
 CREATE TYPE t_themes AS object(
 	libelle varchar(30),
 	refActiveB t_refActiviteB
 	);
/
-- la classe BudgetProjet a une liste d'instance de la classe Themes. Donc nous créons une colléction de  TABLE  de t_themes
 CREATE TYPE t_refTheme AS object (
 	valeur ref t_themes
 	);
/

 CREATE TYPE t_listeRefThemes AS  TABLE  of t_refTheme;
/
 -- 8 -- création du type de la classe BudgetProjet 
 CREATE TYPE t_budgetProjet AS object(
 	montantDemande number,
 	montantAttribue number,
 	montantExecute number,
 	montantRestant number,
 	listeTheme t_listeRefThemes
 	);
/
 -- 9 -- création du type de la classe PlanAnnuel qui a un aperçu des classes AnneeComptable, PlanMensuel et BudgetProjet
CREATE TYPE t_planAnnuel AS object (
	libelle varchar(30),
	code varchar(30),
	montamtTotalPrevu number,
	refAnneeComptable ref t_anneeComptable,
	refBudgetProjet ref t_budgetProjet,
	listePlanMensuel t_listeRefPlanMensuel
	);
/

-- creation des tables des différentes classes 

-- 1 -- classe LigneBudget
CREATE  TABLE  LigneBudget of t_ligneBudget;
/
-- 2 -- classe Mois
CREATE  TABLE  Mois of t_mois ;
/
-- 3 -- class ElementPlanMensuel
CREATE  TABLE  ElementPlanMensuel of t_elementPlanMensuel;
/
-- 4 -- classe PlanMensuel
CREATE  TABLE  PlanMensuel of t_planMensuel 
			nested  TABLE  listeRefElementPlanMensuel 
			store as MesElementsPlansMensuels;
/
-- 5 -- classe AnneeComptable
CREATE  TABLE  AnneeComptable of t_anneeComptable 
			nested  TABLE  listeRefMois
			store as MesMois;
/
-- 6 -- classe ActiveB
CREATE  TABLE  ActiveB of t_activiteB
			nested  TABLE  listRefLigneBudget
			store as MesLignesBudgets;
/
-- 7 -- classe Themes 
CREATE  TABLE  Themes of t_themes;
/
-- 8 -- classe BudgetProjet
CREATE  TABLE  BudgetProjet of t_budgetProjet	
			nested  TABLE  listeTheme
			store as MesThemes;
/
-- 9 -- classe PlanAnnuel
CREATE  TABLE  PlanAnnuel of t_planAnnuel
			nested  TABLE  listePlanMensuel 
			store as MesPlanMensuel;

/			