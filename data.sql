USE listings;

--
-- Dumping data for engine table
--

SET AUTOCOMMIT=0;
INSERT INTO engine VALUES
(1, 3.6,'V6'), 
(2, 6.6,'V8'),
(3, 3.6,'V6'),
(4, 2.8,'I4'),
(5, 6.6,'V8'),
(6, 6.6,'V8'),
(7, 6.2,'V8'),
(8, 3.6,'V6'),
(9, 5.3,'V8'),
(10, 5.3,'V8'),
(11, 3.6,'V6'),
(12, 5.3,'V8'),
(13, 1.5,'I4'),
(14, 5.3,'V8');
COMMIT;

--
-- Dumping data for transmission table
--

SET AUTOCOMMIT=0;
INSERT INTO transmission VALUES
(1,9,'automatic'),
(2,10,'automatic'),
(3,8,'automatic'),
(4,6,'automatic'),
(5,10,'automatic'),
(6,10,'automatic'),
(7,10,'automatic'),
(8,8,'automatic'),
(9,10,'automatic'),
(10,10,'automatic'),
(11,9,'automatic'),
(12,10,'automatic'),
(13,6,'automatic'),
(14,10,'automatic');
COMMIT;

--
-- Dumping data for car table
--

SET AUTOCOMMIT=0;
INSERT INTO car VALUES
(1,'Chevrolet','Traverse','High Country',1,1,'AWD','Black Cherry Metallic','Jet Black/Clove'),
(2,'GMC','Sierra','SLE',2,2,'4WD','Pacific Blue Metallic','Jet Black'),
(3,'Chevrolet','Colorado','Z71',3,3,'4WD','Satin Steel Metallic','Jet Black'),
(4,'Chevrolet','Colorado','LT',4,4,'RWD','Black','Jet Black'),
(5,'GMC','Sierra','Denali',5,5,'4WD','Pacific Blue Metallic','Dark Walnut/Ash Gray'),
(6,'GMC','Sierra','SLE',6,6,'4WD','Cayenne Red Tintcoat','Jet Black'),
(7,'Chevrolet','Camaro','1SS',7,7,'RWD','Vivid Orange Metallic',null),
(8,'Chevrolet','Colorado','LT',8,8,'RWD','Satin Steel Metallic','Jet Black'),
(9,'Chevrolet','Tahoe','LS',9,9,'4WD','Dark Ash Metallic','Gideon/Very Dark Atmosphere'),
(10,'Chevrolet','Tahoe','LT',10,10,'4WD','Satin Steel Metallic','Jet Black'),
(11,'Buick','Enclave','Premium',11,11,'AWD','White Frost Tricoat','Dark Galvanized with Ebon'),
(12,'Chevrolet','Suburban','LT',12,12,'4WD',null,null),
(13,'Chevrolet','Suburban','LT',13,13,'AWD','Blue Glow Metallic','Jet Black'),
(14,'Chevrolet','Suburban','LT',14,14,'4WD','Dark Ash Metallic','Jet Black');
COMMIT;

--
-- Dumping data for seller details table
--

SET AUTOCOMMIT=0;
INSERT INTO details VALUES
(1,1,54115,'New',3,168836,'1GNEVNKW4NJ168836'),
(2,2,69545,'New',4,302830,'1GT49MEY2NF302830'),
(3,3,40595,'New',3,203896,'1GCGTDEN6N1203896'),
(4,4,36370,'New',3,208592,'1GCGSCE18N1208592'),
(5,5,85240,'New',3,309462,'1GT49REY5NF309462'),
(6,6,70895,'New',3,309725,'1GT49TEY4NF309725'),
(7,7,48275,'New',3,129854,'1G1FF3D75N0129854'),
(8,8,34190,'New',3,222822,'1GCGSCENXN1222822'),
(9,9,57330,'New',4,317510,'1GNSKMKD0NR317510'),
(10,10,63790,'New',3,330421,'1GNSKNKD3NR330421'),
(11,11,55010,'New',4,186230,'5GAERCKWXNJ186230'),
(12,12,68590,'New',3,338073,'1GNSKCKD7NR338073'),
(13,13,29090,'New',3,246532,'3GNAXKEV9NL246532'),
(14,14,66490,'New',3,346325,'1GNSKCKD4NR346325');
COMMIT;