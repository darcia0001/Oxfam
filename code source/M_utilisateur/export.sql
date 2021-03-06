--------------------------------------------------------
--  Fichier cr�� - samedi-avril-11-2015   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Type T_GROUPE_UTILISATEUR
--------------------------------------------------------

  CREATE OR REPLACE TYPE "DARCIA"."T_GROUPE_UTILISATEUR" AS object(
	nom varchar(50),
	liste_privileges t_liste_t_ref_t_privilege
 	);

/
--------------------------------------------------------
--  DDL for Type T_LISTE_T_REF_T_PRIVILEGE
--------------------------------------------------------

  CREATE OR REPLACE TYPE "DARCIA"."T_LISTE_T_REF_T_PRIVILEGE" AS  TABLE  of t_ref_t_privilege;

/
--------------------------------------------------------
--  DDL for Type T_PRIVILEGE
--------------------------------------------------------

  CREATE OR REPLACE TYPE "DARCIA"."T_PRIVILEGE" AS object(
	nom varchar(50),
	codePriv varchar(50)
 	)final;

/
--------------------------------------------------------
--  DDL for Type T_STRUCTURE
--------------------------------------------------------

  CREATE OR REPLACE TYPE "DARCIA"."T_STRUCTURE" AS object(
	nom varchar(100)
 	);

/
--------------------------------------------------------
--  DDL for Type T_REF_T_PRIVILEGE
--------------------------------------------------------

  CREATE OR REPLACE TYPE "DARCIA"."T_REF_T_PRIVILEGE" AS object(
			valeur ref t_privilege
		);

/
--------------------------------------------------------
--  DDL for Type T_UTILISATEUR
--------------------------------------------------------

  CREATE OR REPLACE TYPE "DARCIA"."T_UTILISATEUR" AS object(
	nom varchar(50),
	prenom varchar(100),
	email varchar(200),
	password varchar(100),
	profil varchar(50),
	groupe_utilisateur REF t_groupe_utilisateur,
	structure REF t_structure

 	);

/
--------------------------------------------------------
--  DDL for Table GROUPES_UTILISATEUR
--------------------------------------------------------

  CREATE TABLE "DARCIA"."GROUPES_UTILISATEUR" OF "DARCIA"."T_GROUPE_UTILISATEUR" 
 OIDINDEX  ( PCTFREE 10 INITRANS 2 MAXTRANS 255 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ) 
 PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" 
 NESTED TABLE "LISTE_PRIVILEGES" STORE AS "TAB_PRIVILEGES"
 (PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ) RETURN AS VALUE;
--------------------------------------------------------
--  DDL for Table PRIVILEGESAPP
--------------------------------------------------------

  CREATE TABLE "DARCIA"."PRIVILEGESAPP" OF "DARCIA"."T_PRIVILEGE" 
 OIDINDEX  ( PCTFREE 10 INITRANS 2 MAXTRANS 255 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ) 
 PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Table STRUCTURES
--------------------------------------------------------

  CREATE TABLE "DARCIA"."STRUCTURES" OF "DARCIA"."T_STRUCTURE" 
 OIDINDEX  ( PCTFREE 10 INITRANS 2 MAXTRANS 255 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ) 
 PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
-- Impossible d'afficher le langage DDL TABLE pour l'objet DARCIA.TAB_PRIVILEGES avec DBMS_METADATA tentant le g�n�rateur interne.
CREATE INDEX SYS_FK0000022586N00004$ ON TAB_PRIVILEGES (NESTED_TABLE_ID ASC) 
LOGGING 
TABLESPACE SYSTEM 
PCTFREE 10 
INITRANS 2 
STORAGE 
( 
  INITIAL 65536 
  NEXT 1048576 
  MINEXTENTS 1 
  MAXEXTENTS UNLIMITED 
  FREELISTS 1 
  FREELIST GROUPS 1 
  BUFFER_POOL DEFAULT 
) 
NOPARALLELCREATE TABLE TAB_PRIVILEGES 
LOGGING 
TABLESPACE SYSTEM 
PCTFREE 10 
PCTUSED 40 
INITRANS 1 
STORAGE 
( 
  INITIAL 65536 
  NEXT 1048576 
  MINEXTENTS 1 
  MAXEXTENTS UNLIMITED 
  FREELISTS 1 
  FREELIST GROUPS 1 
  BUFFER_POOL DEFAULT 
) 
NOCOMPRESS 
NOPARALLEL
--------------------------------------------------------
--  DDL for Table UTILISATEURS
--------------------------------------------------------

  CREATE TABLE "DARCIA"."UTILISATEURS" OF "DARCIA"."T_UTILISATEUR" 
 OIDINDEX  ( PCTFREE 10 INITRANS 2 MAXTRANS 255 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ) 
 PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
REM INSERTING into DARCIA.GROUPES_UTILISATEUR
SET DEFINE OFF;
Insert into DARCIA.GROUPES_UTILISATEUR (NOM,LISTE_PRIVILEGES) values ('gestionnaireprojet',DARCIA.T_LISTE_T_REF_T_PRIVILEGE());
Insert into DARCIA.GROUPES_UTILISATEUR (NOM,LISTE_PRIVILEGES) values ('administrateur',DARCIA.T_LISTE_T_REF_T_PRIVILEGE());
Insert into DARCIA.GROUPES_UTILISATEUR (NOM,LISTE_PRIVILEGES) values ('agentcontroleoxfam',DARCIA.T_LISTE_T_REF_T_PRIVILEGE());
Insert into DARCIA.GROUPES_UTILISATEUR (NOM,LISTE_PRIVILEGES) values ('agentvalidationoxfam',DARCIA.T_LISTE_T_REF_T_PRIVILEGE());
Insert into DARCIA.GROUPES_UTILISATEUR (NOM,LISTE_PRIVILEGES) values ('operateurprojet',DARCIA.T_LISTE_T_REF_T_PRIVILEGE());
Insert into DARCIA.GROUPES_UTILISATEUR (NOM,LISTE_PRIVILEGES) values ('gestionnaireprojet',DARCIA.T_LISTE_T_REF_T_PRIVILEGE());
REM INSERTING into DARCIA.PRIVILEGESAPP
SET DEFINE OFF;
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('gerer_langue','admin');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('gerer_sauvegarde','admin');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('importer_budget','admin');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('gerer_utilisateur','admin');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('creer_projet','validation');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('modifier_projet','validation');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('supprimer_projet','validation');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('cloturer_ouvrir_plan_mensuel','validation');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('consulter_etat_financier','validation');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('gerer_etat_financier','validation');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('imprimer_etat_financier','validation');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('consulter_projet','controle');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('consulter_etat_caisse','controle');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('consulter_etat_banque','controle');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('accepter_rejeter_operation','controle');
Insert into DARCIA.PRIVILEGESAPP (NOM,CODEPRIV) values ('notifier_projet','controle');
REM INSERTING into DARCIA.STRUCTURES
SET DEFINE OFF;
Insert into DARCIA.STRUCTURES (NOM) values ('oxfam');
Insert into DARCIA.STRUCTURES (NOM) values ('esp');
Insert into DARCIA.STRUCTURES (NOM) values ('crent');
Insert into DARCIA.STRUCTURES (NOM) values ('dgi');
REM INSERTING into DARCIA.UTILISATEURS
SET DEFINE OFF;
Insert into DARCIA.UTILISATEURS (NOM,PRENOM,EMAIL,PASSWORD,PROFIL,GROUPE_UTILISATEUR,STRUCTURE) values ('KHOUSSA','Mamadou','darcia@yahoo.fr','4d1eb8127ffba2ca3083efe8278c8ed51203b2a0','administrateur','DARCIA.T_GROUPE_UTILISATEUR(''administrateur''DARCIA.T_LISTE_T_REF_T_PRIVILEGE())','DARCIA.T_STRUCTURE(''oxfam'')');
Insert into DARCIA.UTILISATEURS (NOM,PRENOM,EMAIL,PASSWORD,PROFIL,GROUPE_UTILISATEUR,STRUCTURE) values ('nom','ibrrr','email2','mdp','administrateur','DARCIA.T_GROUPE_UTILISATEUR(''administrateur''DARCIA.T_LISTE_T_REF_T_PRIVILEGE())','DARCIA.T_STRUCTURE(''oxfam'')');
Insert into DARCIA.UTILISATEURS (NOM,PRENOM,EMAIL,PASSWORD,PROFIL,GROUPE_UTILISATEUR,STRUCTURE) values ('nom','ib','email3','mdp','administrateur','DARCIA.T_GROUPE_UTILISATEUR(''administrateur''DARCIA.T_LISTE_T_REF_T_PRIVILEGE())','DARCIA.T_STRUCTURE(''oxfam'')');
Insert into DARCIA.UTILISATEURS (NOM,PRENOM,EMAIL,PASSWORD,PROFIL,GROUPE_UTILISATEUR,STRUCTURE) values ('nom','ib','email4','mdp','administrateur','DARCIA.T_GROUPE_UTILISATEUR(''administrateur''DARCIA.T_LISTE_T_REF_T_PRIVILEGE())','DARCIA.T_STRUCTURE(''oxfam'')');
Insert into DARCIA.UTILISATEURS (NOM,PRENOM,EMAIL,PASSWORD,PROFIL,GROUPE_UTILISATEUR,STRUCTURE) values ('nom','ib','email7','mdp','administrateur','DARCIA.T_GROUPE_UTILISATEUR(''administrateur''DARCIA.T_LISTE_T_REF_T_PRIVILEGE())','DARCIA.T_STRUCTURE(''oxfam'')');
Insert into DARCIA.UTILISATEURS (NOM,PRENOM,EMAIL,PASSWORD,PROFIL,GROUPE_UTILISATEUR,STRUCTURE) values ('nom','ib','email9','mdp','administrateur','DARCIA.T_GROUPE_UTILISATEUR(''administrateur''DARCIA.T_LISTE_T_REF_T_PRIVILEGE())','DARCIA.T_STRUCTURE(''oxfam'')');
Insert into DARCIA.UTILISATEURS (NOM,PRENOM,EMAIL,PASSWORD,PROFIL,GROUPE_UTILISATEUR,STRUCTURE) values ('nom','ib','email98','mdp','administrateur','DARCIA.T_GROUPE_UTILISATEUR(''administrateur''DARCIA.T_LISTE_T_REF_T_PRIVILEGE())','DARCIA.T_STRUCTURE(''oxfam'')');
Insert into DARCIA.UTILISATEURS (NOM,PRENOM,EMAIL,PASSWORD,PROFIL,GROUPE_UTILISATEUR,STRUCTURE) values ('nom','ib','email222','mdp','administrateur','DARCIA.T_GROUPE_UTILISATEUR(''administrateur''DARCIA.T_LISTE_T_REF_T_PRIVILEGE())','DARCIA.T_STRUCTURE(''oxfam'')');
Insert into DARCIA.UTILISATEURS (NOM,PRENOM,EMAIL,PASSWORD,PROFIL,GROUPE_UTILISATEUR,STRUCTURE) values ('nom','ib','email444','mdp','administrateur','DARCIA.T_GROUPE_UTILISATEUR(''administrateur''DARCIA.T_LISTE_T_REF_T_PRIVILEGE())','DARCIA.T_STRUCTURE(''oxfam'')');
--------------------------------------------------------
--  DDL for Index SYS_C007284
--------------------------------------------------------

  CREATE UNIQUE INDEX "DARCIA"."SYS_C007284" ON "DARCIA"."GROUPES_UTILISATEUR" ("SYS_NC0000400005$") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index SYS_C007285
--------------------------------------------------------

  CREATE UNIQUE INDEX "DARCIA"."SYS_C007285" ON "DARCIA"."GROUPES_UTILISATEUR" ("SYS_NC_OID$") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index SYS_C007283
--------------------------------------------------------

  CREATE UNIQUE INDEX "DARCIA"."SYS_C007283" ON "DARCIA"."PRIVILEGESAPP" ("SYS_NC_OID$") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index SYS_C007286
--------------------------------------------------------

  CREATE UNIQUE INDEX "DARCIA"."SYS_C007286" ON "DARCIA"."STRUCTURES" ("SYS_NC_OID$") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index SYS_FK0000022586N00004$
--------------------------------------------------------

  CREATE INDEX "DARCIA"."SYS_FK0000022586N00004$" ON "DARCIA"."TAB_PRIVILEGES" ("NESTED_TABLE_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  DDL for Index SYS_C007287
--------------------------------------------------------

  CREATE UNIQUE INDEX "DARCIA"."SYS_C007287" ON "DARCIA"."UTILISATEURS" ("SYS_NC_OID$") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM" ;
--------------------------------------------------------
--  Constraints for Table GROUPES_UTILISATEUR
--------------------------------------------------------

  ALTER TABLE "DARCIA"."GROUPES_UTILISATEUR" ADD UNIQUE ("SYS_NC_OID$")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
  ALTER TABLE "DARCIA"."GROUPES_UTILISATEUR" ADD UNIQUE ("LISTE_PRIVILEGES")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
--------------------------------------------------------
--  Constraints for Table PRIVILEGESAPP
--------------------------------------------------------

  ALTER TABLE "DARCIA"."PRIVILEGESAPP" ADD UNIQUE ("SYS_NC_OID$")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
--------------------------------------------------------
--  Constraints for Table STRUCTURES
--------------------------------------------------------

  ALTER TABLE "DARCIA"."STRUCTURES" ADD UNIQUE ("SYS_NC_OID$")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
--------------------------------------------------------
--  Constraints for Table UTILISATEURS
--------------------------------------------------------

  ALTER TABLE "DARCIA"."UTILISATEURS" ADD UNIQUE ("SYS_NC_OID$")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "SYSTEM"  ENABLE;
