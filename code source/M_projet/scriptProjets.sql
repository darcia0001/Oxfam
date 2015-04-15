create type t_langue as object(
	nom varchar(25), code varchar(10)
);

create type t_monnaie as object(
	nomDevise varchar(20), 
	signe varchar(20)
);

create type t_secteurActivite as object(
	libelle varchar(20),
	code varchar(20)
);

create type t_categorieProjet as object(
	libelle varchar(20)
);

create type t_pays as object(
	codePays varchar(30),
	nomComplet varchar(30),
	nomAbrege varchar(30),
	langue REF t_langue,
	monnaie REF t_monnaie
);

create type t_refPays as object( val ref t_pays ); 		-- référence vers un pays

create type t_ville as object(
	nomVille varchar(25),
	lePays ref t_pays
);

create type t_refVille as object( val ref t_ville ); 		-- référence vers une ville

create type t_listeVille as  table of t_refville;		-- liste de réfs vers villes

create type t_projet as object under t_structure(
	nom varchar(50),
	secteur REF t_secteurActivite,
	categorie REF t_categorieProjet,
	villeProjet REF t_ville
);

create type t_refProjet as object( 	val ref t_projet ); 	-- référence vers un projet 

create table monnaie of t_monnaie;

create table langue of t_langue;

create table secteurActivite of t_secteurActivite;

create table categorieProjet of t_categorieProjet;

create table ville of t_ville;

create table projet of t_projet; 	

create table pays of t_pays	nested table listeVilles store as lesVilles;


							# INSERTIONS TEST
insert into langue values('Francais','FR');
insert into langue values('English','ENG');
insert into langue values('Espanol','ESP');
insert into langue values('Arabe','ARA');
insert into langue values('Portuguese','POR');


insert into monnaie values('FCFA','CFA');
insert into monnaie values('Euro','€');
insert into monnaie values('USDollar','$');
insert into monnaie values('Livres','£');
insert into monnaie values('Ouguiya','Oug');

insert into secteurActivite values('Informatique','INF');
insert into secteurActivite values('Agriculture','AGRI');
insert into secteurActivite values('Elevage','ELEV');
insert into secteurActivite values('Pêche','PECH');

insert into categorieProjet values('Augmentation');

insert into pays values(
	'1', 'Sénégal','SEN',
	(select ref(l) from langue l where l.code='FRA') ,
	(select ref(m) from monnaie m where m.nomDevise='FCFA')
);
insert into pays values(
	'2', 'Mali','MAL',
	(select ref(l) from langue l where l.code='FRA') ,
	(select ref(m) from monnaie m where m.nomDevise='FCFA')
);
insert into pays values(
	'3', 'Mauritanie','MAUR',
	(select ref(l) from langue l where l.code='ARA') ,
	(select ref(m) from monnaie m where m.nomDevise='Ouguiya')
);

insert into ville values('Dakar', (select ref(p) from pays p where p.nomComplet='Senegal') );
insert into ville values('Thiès'; (select ref(p) from pays p where p.nomComplet='Senegal'));
insert into ville values('Kaolack'; (select ref(p) from pays p where p.nomComplet='Senegal'));
insert into ville values('Saint-Louis'; (select ref(p) from pays p where p.nomComplet='Senegal'));
insert into ville values('Tambacounda', (select ref(p) from pays p where p.nomComplet='Senegal'));
insert into ville values('Ziguinchor', (select ref(p) from pays p where p.nomComplet='Senegal'));
insert into ville values('Bamako', (select ref(p) from pays p where p.nomComplet='Mali'));
insert into ville values('Praia', (select ref(p) from pays p where p.nomComplet='Cap-Vert'));
insert into ville values('Abidjan', (select ref(p) from pays p where p.nomComplet='Cote d Ivoire'));
insert into ville values('Niamey', (select ref(p) from pays p where p.nomComplet='Niger'));
insert into ville values('Nouatchok', (select ref(p) from pays p where p.nomComplet='Mauritanie'));
insert into ville values('Lomé', (select ref(p) from pays p where p.nomComplet='Togo'));
insert into ville values('Cotonou', (select ref(p) from pays p where p.nomComplet='Benin'));


insert into projet values(
    'Test Projet 1',
    ( select ref(sect) from secteurActivite sect where sect.code='INF'),
    ( select ref(cat) from categorieProjet cat where cat.libelle='Augmentation' ),
    ( select ref(v) from ville v where v.nomville='Thiès' )
 );