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
                    <a class="navbar-brand" href="#">Long of Athens</a>
                    <style>
                        #address {
                            display: none;
                            color: gray;
                            padding-left: 10px;
                            text-align: left;
                        } #call-us {
                            display: none;
                            color: gray;
                            padding-left: 10px;
                            text-align: left;
                        }</style>
                    <button onclick="showAddress()">
                        <input type="image" src="directions.png" width="30px" /></button>
                    <button onclick="showPhone()">
                        <input type="image" src="phone.png" width="30px" /></button>
                    <div id="address">
                        <div class="row">
                            1900 Congress Parkway South<br>Athens, TN 37303</div>
                        <div class="row">
                            <a target="_blank" href="https://maps.google.com/?q=1900%20Congress%20Parkway%20South,%20Athens,%20TN,%2037303" data-bb-processed="true">
                                <button class="btn btn-primary float-left">Get Directions</button>
                            </a></div></div>
                    <div id="call-us">
                        <div class="row">
                            <div class="col-8">
                                Sales:<br>(423)745-1962 <br>
                                <a href="tel:(423)745-1962" data-bb-processed="true">
                                    <button class="btn btn-primary mt-3 float-left">Call</button>
                                </a></div></div></div>
                    <script>
                        function showAddress() {
                            var x = document.getElementById("address");
                            var y = document.getElementById("call-us");
                            if(x.style.display === "none") {
                                x.style.display = "block";
                                y.style.display = "none";
                            } else {
                                x.style.display = "none";
                            } 
                        } function showPhone() {
                            var x = document.getElementById("address");
                            var y = document.getElementById("call-us");
                            if(y.style.display === "none") {
                                x.style.display = "none";
                                y.style.display = "block";
                            } else {
                                y.style.display = "none";
                            } 
                        }
                    </script></div></nav></header>
        <?php
            echo \'<button class="btn btn-default">
                        <form action="main.php" method="post">
                            <input type="submit" value="Back to Inventory">
                        </form>
                    </button><br />\';

            $mysqli = new mysqli("localhost", "root", "", "listings");

            if ($mysqli->connect_error) {
                exit(\'Error connecting to database\'); // Should be typical "can\' connect" message 
            }
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $mysqli->set_charset("utf8mb4");

            // create arrays (technical)
            $vehicle    = array();
            $motor      = array();
            $drivetrain = array();
            $ext_color  = array();
            $int_color  = array();
            
            // seller details arrays
            $price     = array();
            $condition = array();
            $mileage   = array();
            $stock_num = array();
            $vin       = array();

            echo \'<img src='.$images[$i].' width="175px" /><br />\';
            
            // get car info from MySQL database
            $stmt = $mysqli->prepare("SELECT CONCAT(\'2022 \',car.make,\' \',car.model,\' \',car.vehicle_trim) as vehicle,
                                      CONCAT(e.displacement,\' L \',e.engine_type) as motor,
                                      CONCAT(t.num_gears,\'-speed \',t.transmission_type,\', \',car.drive_type) as drivetrain,
                                      car.int_color as interior, car.ext_color as exterior, 
                                      details.price as price, details.vehicle_condition as vc, details.mileage as mileage, details.stock_num as stock_num, details.vin as vin
                                      FROM details 
                                      INNER JOIN car ON details.car_id = car.car_id 
                                      INNER JOIN engine AS e ON car.engine_id = e.engine_id
                                      INNER JOIN transmission AS t ON car.transmission_id = t.transmission_id;");
            $stmt->execute(); // submit query to DB
            $result = $stmt->get_result(); // get the results
            if($result->num_rows === 0) exit(\'No rows\');

            // populate arrays
            $l = 0;

            while($row = $result->fetch_assoc()) {
                $vehicle[$l]    = $row[\'vehicle\'];
                $motor[$l]      = $row[\'motor\'];
                $drivetrain[$l] = $row[\'drivetrain\'];
                $int_color[$l]  = $row[\'interior\'];
                $ext_color[$l]  = $row[\'exterior\'];
                $price[$l]      = $row[\'price\'];
                $condition[$l]  = $row[\'vc\'];
                $mileage[$l]    = $row[\'mileage\'];
                $stock_num[$l]  = $row[\'stock_num\'];
                $vin[$l]        = $row[\'vin\'];
                $l++;
            }

            // set up table
            print("<table border=\'0.5\'>");
            echo \'<big><i>\'.$vehicle['.$i.'].\'</i></big\';
            print("<tr><td style=\'text-align:left\'><b>Price: </b>$".number_format($price['.$i.'],2,\'.\',\',\').""
                ."</tr><td style=\'text-align:left\'><b>Engine: </b>$motor['.$i.']"
                ."</tr><td style=\'text-align:left\'><b>Drivetrain: </b>$drivetrain['.$i.']"
                ."</tr><td style=\'text-align:left\'><b>Interior color: </b>$int_color['.$i.']"
                ."</tr><td style=\'text-align:left\'><b>Exterior color: </b>$ext_color['.$i.']"
                ."</tr><td style=\'text-align:left\'><b>Vehicle condition: </b>$condition['.$i.']"
                ."</tr><td style=\'text-align:left\'><b>Mileage: </b>$mileage['.$i.']"
                ."</tr><td style=\'text-align:left\'><b>Stock #: </b>$stock_num['.$i.']"
                ."</tr><td style=\'text-align:left\'><b>VIN #: </b>$vin['.$i.']</tr>"); 
            print("</table>");
            
            $mysqli->close();
        ?>
    </body>
</html>');
?>