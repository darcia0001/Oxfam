drop table operationcaisse ; 
drop table operationBanque ;
drop type t_operationCaisse ;
drop type t_operationBanque ;
drop type t_operation ;
create or replace type t_Operation as object (
	id integer,
	libelle varchar(50),
	dateOperation date,
	sommeOperation integer,
	noteOperation varchar(50),
	etatSoumission varchar(30),
	soumission varchar(50),
	referencePaiement varchar(50),
	ligneBudget NUMBER
) not final;
/
create type t_OperationCaisse under t_Operation(
	numRecu integer
);
/
create type t_OperationBanque under t_Operation(
	typeOpBancaire varchar(50),
	referenceOperation varchar(50)
);
/

-- Creation des tables d' operations
create table operationCaisse of t_OperationCaisse ;
create table operationBanque of t_OperationBanque ;

-- Insertion d'une opération	
INSERT INTO operationCaisse values (
	t_OperationCaisse(
		seq_opCaisse.NEXTVAL,
		'Operation1', 
		'28-12-1882', 
		25000,
		'noteOperation 1', 
		'etatSoumission 1', 
		'soumission 1', 
		'referencePaiement 2222', 
		1, 
		125
	),
	t_OperationCaisse(
		seq_opCaisse.NEXTVAL,
		'Operation2', 
		'28-12-1891', 
		25000,
		'noteOperation 2', 
		'etatSoumission 2', 
		'soumission 2', 
		'referencePaiem ent 2222', 
		1, 
		125
	),
	
	t_OperationCaisse(
		seq_opCaisse.NEXTVAL,
		'Operation3', 
		'28-12-2015', 
		25000,
		'noteOperation 3', 
		'etatSoumission 3', 
		'soumission 3', 
		'referencePaiem ent 2222', 
		2, 
		125
	)
);

-- Séquence pour l'auto_incrémentation de l'ID de la table OperationCaisse
CREATE SEQUENCE seq_opCaisse
	MINVALUE 1
	START WITH 1
	INCREMENT BY 1
	CACHE 50 ;

-- Séquence pour l'auto_incrémentation de l'ID de la table OperationBanque
CREATE SEQUENCE seq_opBanque
	MINVALUE 1
	START WITH 1
	INCREMENT BY 1
	CACHE 50 ;

-- Avoir le dernier ID de la table OperationCaisse
SELECT seq_opCaisse.NEXTVAL AS nextInsertID FROM DUAL;

INSERT INTO lignebudget values ('bugget1',250000,0);
