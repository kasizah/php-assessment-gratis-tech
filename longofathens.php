<!-- Entry page -->
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
                    <a class="navbar-brand" href="#">Long of Athens</a></div></nav></header>
        <?php
            // create array of imagees
            $images = array("22-chevrolet-traverse-high-country-silver.jpg",
                            "22-gmc-sierra-sle-white.jpg",
                            "22-chevrolet-colorado-4wd-z71-black.jpg",
                            "22-chevrolet-colorado-2wd-lt-black.jpg",
                            "22-gmc-sierra-denali-white.jpg",
                            "22-gmc-sierra-sle-charcoal.jpg",
                            "22-chevrolet-camaro-1ss-white.jpg",
                            "22-chevrolet-colorado-2wd-lt-black.jpg",
                            "22-chevrolet-tahoe-ls-IRL-black.jpg",
                            "22-chevrolet-tahoe-lt-charcoal.jpg",
                            "22-buick-enclave-premium-IRL-white.jpg",
                            "22-chevrolet-suburban-lt-black.jpg",
                            "22-chevrolet-equinox-lt-gray.jpg",
                            "22-chevrolet-suburban-lt-black.jpg");

            // create vehicle listing PHP files
            for($i = 0; $i < count($images); $i++) {
                $handle = fopen("vehicle_listing".$i.".php", "w");
                include ("new_listing.php");

                fclose($handle);
            }

            // turn image array into buttons (grid) leading to listing pages
            echo '<div class="row row-cols-4">';
            for($i = 0; $i < count($images); $i++) {
                echo '<div class="col">
                        <button class="btn btn-default">
                            <form method="get" action="vehicle_listing'.$i.'.php">
                                <input type="image" src='.$images[$i].' name="car'.$i.'" width="175px" />
                            </form>
                        </button>
                      </div>';
            }
            echo '</div>';
        ?>
    </body>
</html>