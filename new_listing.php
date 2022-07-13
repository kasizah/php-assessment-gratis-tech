<?php
fwrite($handle, '<!DOCTYPE html>

<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                                        
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
                                        
            <title>Long of Athens</title>
                <style>
                    footer {
                        padding-top: 3rem;
                        padding-bottom: 3rem; }
                    footer p {
                        margin-bottom: .25rem; }
                </style>
    </head>
                                    
    <body>
        <header>
            <nav class="navbar navbar-default navbar-dark bg-dark">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Long of Athens</a></div></nav></header>
        <?php
            echo \'<button class="btn btn-default">
                        <form action="longofathens.php" method="post">
                            <input type="submit" value="Back to Inventory">
                        </form>
                    </button><br />\';

            $mysqli = new mysqli("localhost:3306", "root", "");

            $mysqli->query("DROP DATABASE IF EXISTS listings");

            $q = "CREATE DATABASE listings";
            if ($mysqli->query($q) === FALSE) {
                echo "Error creating databse: " . $mysqli->error;
            }

            // create database tables (technical)
            $mysqli->query("CREATE TABLE listings.car (
                                car_id int auto_increment NOT NULL,
                                make varchar(50) NULL,
                                model varchar(50) NULL,
                                vehicle_trim varchar(100) NULL,
                                CONSTRAINT car_pk PRIMARY KEY (car_id)
                            )
                            ENGINE=InnoDB
                            DEFAULT CHARSET=utf8mb4
                            COLLATE=utf8mb4_general_ci;");
            $mysqli->query("CREATE TABLE listings.p_d_train (
                                p_d_train_id int auto_increment NOT NULL,
                                engine varchar(10) NULL,
                                transmission varchar(30) NULL,
                                drive_type varchar(10) NULL,
                                CONSTRAINT p_d_train_pk PRIMARY KEY (p_d_train_id)
                            )
                            ENGINE=InnoDB
                            DEFAULT CHARSET=utf8mb4
                            COLLATE=utf8mb4_general_ci;");
            $mysqli->query("CREATE TABLE listings.car_color (
                                car_color_id int auto_increment NOT NULL,
                                interior varchar(100) NULL,
                                exterior varchar(100) NULL,
                                CONSTRAINT car_color_pk PRIMARY KEY (car_color_id)
                            )
                            ENGINE=InnoDB
                            DEFAULT CHARSET=utf8mb4
                            COLLATE=utf8mb4_general_ci;");
            // create arrays (technical)
            $make         = array(); 
            $model        = array();
            $trim         = array();
            $displacement = array();
            $engine_type  = array();
            $num_gears    = array();
            $transmission = array();
            $drive_type   = array();
            $ext_color    = array();
            $int_color    = array();
            
            // seller details tables
            $mysqli->query("CREATE TABLE listings.details (
                                details_id int auto_increment NOT NULL,
                                price varchar(20) NULL,
                                vehicle_condition varchar(10) NULL,
                                mileage int NULL,
                                stock_num varchar(50) NULL,
                                vin varchar(200) NULL,
                                CONSTRAINT details_pk PRIMARY KEY (details_id)
                            )
                            ENGINE=InnoDB
                            DEFAULT CHARSET=utf8mb4
                            COLLATE=utf8mb4_general_ci;");
            // seller details arrays
            $price     = array();
            $condition = array();
            $mileage   = array();
            $stock_num = array();
            $vin       = array();

            $mysqli->close();

            // get data from CSV files
            $handle = fopen("technical_info.csv", "r");
            $data = fgetcsv($handle, 1000, ",");
            while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                array_push($make, $data[0]); array_push($model, $data[1]); array_push($trim, $data[2]);
                array_push($displacement, $data[3]); array_push($engine_type, $data[4]);
                array_push($num_gears, $data[5]); array_push($transmission, $data[6]);
                array_push($drive_type, $data[7]);
                array_push($ext_color, $data[8]); array_push($int_color, $data[9]); }
            fclose($handle);

            $handle = fopen("more_details.csv", "r");
            $data = fgetcsv($handle, 1000, ",");
            while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                array_push($price, $data[0]); array_push($condition, $data[1]); array_push($mileage, $data[2]);
                array_push($stock_num, $data[3]); array_push($vin, $data[4]); }
            fclose($handle);

            $mysqli = new mysqli("localhost:3306", "root", "", "listings");
            if($mysqli->connect_error) {
                exit(\'Error connecting to database\');
            }
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $mysqli->set_charset("utf8mb4");

            $mysqli->query("use listings;");

            $mysqli->query("SET AUTOCOMMIT=1;");

            // car (basic info) table
            $q = "INSERT INTO listings.car (make,model,vehicle_trim) VALUES\n";
            for($l = 0; $l < count($make); $l++) {
                $q .= "(\'".$make[$l]."\',\'".$model[$l]."\',\'".$trim[$l]."\')";

                if($l !== count($make)-1)
                    $q .= ",\n";
                else
                    $q .= ";";
            } $mysqli->query($q);
            // power/drivetrain table
            $q = "INSERT INTO listings.p_d_train (engine,transmission,drive_type) VALUES\n";
            for($l = 0; $l < count($displacement); $l++) {
                $engine = $displacement[$l]." L ".$engine_type[$l];
                $tranny = $num_gears[$l]."-speed ".$transmission[$l];
                $q .= "(\'$engine\',\'$tranny\',\'".$drive_type[$l]."\')";

                if($l !== count($displacement)-1)
                    $q .= ",\n";
                else
                    $q .= ";";
            } $mysqli->query($q);
            // car color table
            $q = "INSERT INTO listings.car_color (interior,exterior) VALUES\n";
            for($l = 0; $l < count($int_color); $l++) {
                if($int_color[$l] === "null" && $ext_color[$l] === "null") {
                    $q .= "(\'N/A\',\'N/A\')";
                } elseif($int_color[$l] === "null") {
                    $q .= "(\'N/A\',\'".$ext_color[$l]."\')";
                } elseif($ext_color[$l] === "null") {
                    $q .= "(\'".$int_color[$l]."\',\'N/A\')";
                } else {
                    $q .= "(\'".$int_color[$l]."\',\'".$ext_color[$l]."\')";
                }

                if($l !== count($int_color)-1)
                    $q .= ",\n";
                else
                    $q .= ";";
            } $mysqli->query($q);
            // further details
            $q = "INSERT INTO listings.details (price,vehicle_condition,mileage,stock_num,vin) VALUES\n";
            for($l = 0; $l < count($price); $l++) {
                $q .= "(\'$".number_format($price[$l], 2, \'.\', \',\')."\',\'".$condition[$l]."\',".$mileage[$l].",\'".$stock_num[$l]."\',\'".$vin[$l]."\')";

                if($l !== count($price)-1)
                    $q .= ",\n";
                else
                    $q .= ";";
            } $mysqli->query($q);

            echo \'<img src='.$images[$i].' width="175px" /><br />\';
            
            // get car info from MySQL database
            $stmt = $mysqli->prepare("SELECT CONCAT(\'2022 \',make,\' \',model,\' \',vehicle_trim) as vehicle,engine,transmission,drive_type,interior,exterior
                                      FROM car,p_d_train,car_color WHERE car.car_id='.$i.' AND p_d_train.p_d_train_id=car.car_id AND car_color.car_color_id=car.car_id;");
            $stmt->execute(); // submit query to DB
            $result = $stmt->get_result(); // get the results
            // if($result->num_rows === 0) exit(\'No rows\');

            // set up table
            print("<table border=\'0.5\'>");
            print("<tr><td style=\'text-align:left\'><b>Price: </b>"
                ."</tr><td style=\'text-align:left\'><b>Engine: </b>"
                ."</tr><td style=\'text-align:left\'><b>Transmission: </b>"
                ."</tr><td style=\'text-align:left\'><b>Drive type: </b>"
                ."</tr><td style=\'text-align:left\'><b>Interior color: </b>"
                ."</tr><td style=\'text-align:left\'><b>Exterior color: </b></tr>"); 
            print("</table>");
            
            $mysqli->close();
        ?>
    </body>
</html>');
?>