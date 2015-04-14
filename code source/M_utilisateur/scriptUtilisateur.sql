--modelisation de la base de donne d apres le diagramme de conception
-- le type representant un privilege
CREATE or REPLACE TYPE t_privilege AS object(
	nom varchar(50),
	codePriv varchar(50)
 	)final;
--
--le type representant un groupe utilisateur
--		contient un agregation de t_privilege
CREATE or REPLACE TYPE t_ref_t_privilege AS object(
			valeur ref t_privilege
);
CREATE or REPLACE TYPE t_liste_t_ref_t_privilege AS  TABLE  of t_ref_t_privilege;
CREATE   TYPE t_groupe_utilisateur AS object(
	nom varchar(50),
	liste_privileges t_liste_t_ref_t_privilege
); 
--le type representant une structure
CREATE or REPLACE  TYPE t_structure AS object(
	nom varchar(100)
 	); 
--type oxfam under t_structure??concepteurs???
--CREATE or REPLACE TYPE oxfam under t_structure( 	); 

--le type representant un  utilisateur
CREATE or REPLACE TYPE t_utilisateur AS object(
	nom varchar(50),
	prenom varchar(100),
	email varchar(200),
	password varchar(100),
	profil varchar(50),
	groupe_utilisateur REF t_groupe_utilisateur,
	structure REF t_structure

 	); 
--creation des tables des utilisateurs,privileges,structures  et groupes d utilisateur
CREATE  TABLE privilegesApp of t_privilege;
CREATE  TABLE groupes_utilisateur of t_groupe_utilisateur nested  TABLE  liste_privileges store as tab_privileges;
CREATE  TABLE structures of t_structure;
CREATE  TABLE utilisateurs of t_utilisateur;
--ajout des contraintes cle etrangere???
--ALTER TABLE table_name
--ADD CONSTRAINT constraint_name
--   FOREIGN KEY (column1, column2, ... column_n)
--   REFERENCES parent_table (column1, column2, ... column_n);
--agent oxfam
--les privileges
--privileges administrateur
INSERT INTO PRIVILEGESAPP VALUES('gerer_langue','admin');
INSERT INTO PRIVILEGESAPP VALUES('gerer_sauvegarde','admin');
INSERT INTO PRIVILEGESAPP VALUES('importer_budget','admin');
INSERT INTO PRIVILEGESAPP VALUES('gerer_utilisateur','admin');
--privileges agentvalidationoxfam
INSERT INTO PRIVILEGESAPP VALUES('creer_projet','validation');
INSERT INTO PRIVILEGESAPP VALUES('modifier_projet','validation');
INSERT INTO PRIVILEGESAPP VALUES('supprimer_projet','validation');
INSERT INTO PRIVILEGESAPP VALUES('cloturer_ouvrir_plan_mensuel','validation');
INSERT INTO PRIVILEGESAPP VALUES('consulter_etat_financier','validation');
INSERT INTO PRIVILEGESAPP VALUES('gerer_etat_financier','validation');
INSERT INTO PRIVILEGESAPP VALUES('imprimer_etat_financier','validation');
--privileges agentcontroleoxfam
INSERT INTO PRIVILEGESAPP VALUES('consulter_projet','controle');
INSERT INTO PRIVILEGESAPP VALUES('consulter_etat_caisse','controle');
INSERT INTO PRIVILEGESAPP VALUES('consulter_etat_banque','controle');
INSERT INTO PRIVILEGESAPP VALUES('accepter_rejeter_operation','controle');
INSERT INTO PRIVILEGESAPP VALUES('notifier_projet','controle');

insert into "DARCIA"."GROUPES_UTILISATEUR" values('administrateur',t_liste_t_ref_t_privilege());
insert into "DARCIA"."GROUPES_UTILISATEUR" values('agentcontroleoxfam',t_liste_t_ref_t_privilege());
insert into "DARCIA"."GROUPES_UTILISATEUR" values('agentvalidationoxfam',t_liste_t_ref_t_privilege());
insert into "DARCIA"."GROUPES_UTILISATEUR" values('operateurprojet',t_liste_t_ref_t_privilege());
--agent projet
insert into "DARCIA"."GROUPES_UTILISATEUR" values('operateurprojet',t_liste_t_ref_t_privilege());
insert into "DARCIA"."GROUPES_UTILISATEUR" values('gestionnaireprojet',t_liste_t_ref_t_privilege());
