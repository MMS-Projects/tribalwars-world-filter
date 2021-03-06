-- scripts/data.sqlite.sql
--
-- You can begin populating the database with the following SQL statements.
 
INSERT INTO "filters" VALUES(1,'Paladin','game_knight');
INSERT INTO "filters" VALUES(2,'Nobel item','snob_gold');
INSERT INTO "filters" VALUES(3,'Church','game_church');
INSERT INTO "filters" VALUES(4,'World speed','speed');
INSERT INTO "filters" VALUES(5,'Bonus villages','coord_bonus_villages');

INSERT INTO "filter_options" VALUES(1,'2','2',4);
INSERT INTO "filter_options" VALUES(2,'1.5','1.5',4);
INSERT INTO "filter_options" VALUES(3,'1','1',4);
INSERT INTO "filter_options" VALUES(4,'No','0',3);
INSERT INTO "filter_options" VALUES(5,'Yes','1',3);
INSERT INTO "filter_options" VALUES(6,'Coins','1',2);
INSERT INTO "filter_options" VALUES(7,'Packages','0',2);
INSERT INTO "filter_options" VALUES(8,'No','0',1);
INSERT INTO "filter_options" VALUES(9,'Yes','1',1);
INSERT INTO "filter_options" VALUES(10,'Yes','7',5);
INSERT INTO "filter_options" VALUES(11,'No','0',5);

INSERT INTO "worlds" VALUES(1,'nl1',0,0,0,1.0,0);
INSERT INTO "worlds" VALUES(2,'nl2',1,1,0,2.0,0);
INSERT INTO "worlds" VALUES(3,'nl3',1,1,0,1.0,0);
INSERT INTO "worlds" VALUES(4,'nl4',1,1,0,1.0,0);
INSERT INTO "worlds" VALUES(5,'nl5',0,0,0,1.0,0);
INSERT INTO "worlds" VALUES(6,'nl6',2,1,0,1.0,7);
INSERT INTO "worlds" VALUES(7,'nl7',2,1,0,2.0,7);
INSERT INTO "worlds" VALUES(8,'nl8',1,1,0,1.0,0);
INSERT INTO "worlds" VALUES(9,'nl9',2,1,0,1.0,7);
INSERT INTO "worlds" VALUES(10,'nl10',0,0,0,1.0,0);
INSERT INTO "worlds" VALUES(11,'nl11',2,1,1,1.0,7);
INSERT INTO "worlds" VALUES(12,'nl12',2,1,1,1.0,7);
INSERT INTO "worlds" VALUES(13,'nl13',1,1,0,2.0,0);
INSERT INTO "worlds" VALUES(14,'nl14',2,1,1,1.0,8);
INSERT INTO "worlds" VALUES(15,'nl15',2,1,0,2.0,8);
INSERT INTO "worlds" VALUES(16,'nl16',0,0,0,1.0,0);
INSERT INTO "worlds" VALUES(17,'nl17',2,1,1,1.0,10);
INSERT INTO "worlds" VALUES(18,'nl18',1,1,0,1.0,0);
INSERT INTO "worlds" VALUES(19,'nl19',1,1,0,2.0,0);
INSERT INTO "worlds" VALUES(20,'nl20',2,1,1,1.0,10);
INSERT INTO "worlds" VALUES(21,'nl21',2,1,1,1.0,10);
INSERT INTO "worlds" VALUES(22,'nl22',2,1,0,1.0,10);
INSERT INTO "worlds" VALUES(23,'nl23',2,1,1,1.0,10);
INSERT INTO "worlds" VALUES(24,'nl24',0,0,0,1.0,0);
INSERT INTO "worlds" VALUES(25,'nl25',2,1,1,1.0,10);
INSERT INTO "worlds" VALUES(26,'nl26',2,1,1,1.0,10);
INSERT INTO "worlds" VALUES(27,'nl27',0,1,0,1.0,10);
INSERT INTO "worlds" VALUES(28,'nl28',2,1,0,1.0,0);
INSERT INTO "worlds" VALUES(29,'nl29',1,1,0,1.0,5);
INSERT INTO "worlds" VALUES(30,'nls1',1,1,0,400.0,100);
INSERT INTO "worlds" VALUES(31,'nlc1',1,1,0,2.0,0);

INSERT INTO "communities" VALUES(1,'nl','tribalwars.nl',2);
INSERT INTO "communities" VALUES(2,'de','die-staemme.de',15);
INSERT INTO "communities" VALUES(3,'uk','tribalwars.co.uk',27);
INSERT INTO "communities" VALUES(4,'ts','tribalwarsmasters.net',37);
INSERT INTO "communities" VALUES(5,'fr','guerretribale.fr',23);
INSERT INTO "communities" VALUES(6,'us','tribalwars.us',36);
INSERT INTO "communities" VALUES(7,'net','tribalwars.net',3);
