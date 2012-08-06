-- scripts/data.sqlite.sql
--
-- You can begin populating the database with the following SQL statements.
 
INSERT INTO "filters" VALUES(1,'Paladin','paladin');
INSERT INTO "filters" VALUES(2,'Nobel item','nobel-item');
INSERT INTO "filters" VALUES(3,'Church','church');
INSERT INTO "filters" VALUES(4,'World speed','speed');
INSERT INTO "filters" VALUES(5,'Bonux villages','bonus-villages');

INSERT INTO "filter_options" VALUES(1,'2','2',4);
INSERT INTO "filter_options" VALUES(2,'1.5','1.5',4);
INSERT INTO "filter_options" VALUES(3,'1','1',4);
INSERT INTO "filter_options" VALUES(4,'No','false',3);
INSERT INTO "filter_options" VALUES(5,'Yes','true',3);
INSERT INTO "filter_options" VALUES(6,'Coins','2',2);
INSERT INTO "filter_options" VALUES(7,'Packages','1',2);
INSERT INTO "filter_options" VALUES(8,'No','false',1);
INSERT INTO "filter_options" VALUES(9,'Yes','True',1);
INSERT INTO "filter_options" VALUES(10,'Yes','true',5);
INSERT INTO "filter_options" VALUES(11,'No','false',5);
