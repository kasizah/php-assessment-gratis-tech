-- Active: 1632866680629@@127.0.0.1@3306@listings
DROP SCHEMA IF EXISTS listings;
CREATE SCHEMA listings;
USE listings;

--
-- under the hood
--
CREATE TABLE engine (
    engine_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    displacement decimal(3,1) NOT NULL,
    engine_type varchar(10) NOT NULL,
    PRIMARY KEY (engine_id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;

CREATE TABLE transmission (
    transmission_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    num_gears int NOT NULL,
    transmission_type varchar(50) NOT NULL,
    PRIMARY KEY (transmission_id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;

--
-- Table for technical info
--
CREATE TABLE car (
    car_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    make varchar(50) NOT NULL,
    model varchar(50) NOT NULL,
    vehicle_trim varchar(100) NOT NULL,
    engine_id SMALLINT UNSIGNED NOT NULL,
    transmission_id SMALLINT UNSIGNED NOT NULL,
    drive_type varchar(10) NOT NULL,
    int_color varchar(100) NOT NULL,
    ext_color varchar(100) NOT NULL,
    PRIMARY KEY (car_id),
    KEY idx_fk_engine_id (engine_id),
    KEY idx_fk_transmission_id (transmission_id),
    CONSTRAINT car_engine_fk FOREIGN KEY (engine_id) REFERENCES engine (engine_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT car_transmission_fk FOREIGN KEY (transmission_id) REFERENCES transmission (transmission_id) ON DELETE RESTRICT ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;

--
-- Table for seller details
--
CREATE TABLE details (
    details_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    car_id SMALLINT UNSIGNED NOT NULL,
    price int NOT NULL,
    vehicle_condition varchar(10) NOT NULL,
    mileage int NOT NULL,
    stock_num int NOT NULL,
    vin varchar(200) NOT NULL,
    PRIMARY KEY (details_id),
    KEY idx_fk_car_id (car_id),
    CONSTRAINT details_fk FOREIGN KEY (car_id) REFERENCES car(car_id) ON DELETE RESTRICT ON UPDATE CASCADE
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8;

CREATE VIEW technical_info AS SELECT
CONCAT(_utf8'2022 ', car.make, _utf8' ', car.model, _utf8' ', car.vehicle_trim) as vehicle,
CONCAT(e.displacement, _utf8' L ', e.engine_type) as motor, 
CONCAT(t.num_gears, _utf8'-speed ', t.transmission_type, _utf8', ', car.drive_type) as drivetrain,
car.int_color, car.ext_color
FROM car
INNER JOIN engine AS e ON car.engine_id = e.engine_id
INNER JOIN transmission AS t ON car.transmission_id = t.transmission_id;

CREATE VIEW car_details AS SELECT
CONCAT(_utf8'2022 ', car.make, _utf8' ', car.model, _utf8' ', car.vehicle_trim) as vehicle,
deets.price, deets.vehicle_condition, deets.mileage, deets.stock_num, deets.vin
FROM details as deets
INNER JOIN car ON deets.car_id = car.car_id;

CREATE VIEW view_all AS SELECT
CONCAT(_utf8'2022 ', car.make, _utf8' ', car.model, _utf8' ', car.vehicle_trim) as vehicle,
CONCAT(e.displacement, _utf8' L ', e.engine_type) as motor,
CONCAT(t.num_gears, _utf8'-speed ', t.transmission_type, _utf8', ', car.drive_type) as drivetrain,
car.int_color, car.ext_color, deets.price, deets.vehicle_condition, deets.mileage, deets.stock_num, deets.vin
FROM details AS deets
INNER JOIN car ON deets.car_id = car.car_id
INNER JOIN engine AS e ON car.engine_id = e.engine_id
INNER JOIN transmission AS t ON car.transmission_id = t.transmission_id;