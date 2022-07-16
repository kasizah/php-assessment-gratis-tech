<!-- Entry page -->
<?php
    // Initialize the session
    session_start();
    
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
?>

<!-- main code -->
<!DOCTYPE html>

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
                            if (x.style.display === "none") {
                                x.style.display = "block";
                                y.style.display = "none";
                            } else {
                                x.style.display = "none";
                            }
                        } function showPhone() {
                            var x = document.getElementById("address");
                            var y = document.getElementById("call-us");
                            if (y.style.display === "none") {
                                x.style.display = "none";
                                y.style.display = "block";
                            } else {
                                y.style.display = "none";
                            }
                        }
                    </script></div></nav></header>
        Welcome, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>, to Long of Athens.
        <?php
            include("all_vehicles.php");
        ?>
        <p>
            <a href="reset-password.php" class="btn btn-warning">Reset password</a>
            <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
        </p>
    </body>
</html>