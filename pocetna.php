x<?php

    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: naslovna.php');
    }

?>




<!DOCTYPE html>

<html>

    <head>
    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>Moja biblioteka</title>

        <link rel="icon" type="image/jpg" href="icon.jpg">
        <link rel="stylesheet" type="text/css" href="css/style_pocetna.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        
        <meta name="author" content="Jovana Malović">
        <meta name="keywords" content="knjige, biblioteka, čitanje">

        <script src="js/jquery-3.3.1.js"></script>

        <script>

            $(document).ready(function(){

                $("#dugme").click(function(){

                    $.ajax({

                        url: 'knjige_ispis.php',
                        method: 'POST',
                        success: function(odgovor){
                            $("#prikaz_knjiga").html(odgovor);
                        }
                    });

                });

});
        </script>
    </head>

    <body>
    
        <?php

            include("navigacija.php");

        ?>
        
        <!--wrapper za sadrzaj-->
        <div id="omotac">
        
            <p id="naslov">Najbolje ocenjene knjige</p>

            <!--Slideshow koriscenjem bootstrapa. :) Nemojte zameriti, mnogo mi se dopao. A onaj JS Slideshow takodje postoji na sajtu. :) -->

            <?php

                include("funkcije.php");

                $veza = connect();

                $upit = "SELECT slika, ocena FROM knjiga WHERE ocena=5"; 

                $rezultat = mysqli_query($veza, $upit);

                if($rezultat == false){
                    die ("Greska prilikom upita".mysqli_error($veza));
                }

                echo "<div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>
                        <div class='carousel-inner'>";

                $red = mysqli_fetch_assoc($rezultat);
                $slika = "images/".$red['slika'];
                 echo "<div class='carousel-item active'>
                        <img class='d-block w-100 slika' src='$slika'>
                    </div>";

                while($red = mysqli_fetch_assoc($rezultat)){

                    $slika = "images/".$red['slika'];

                    echo "<div class='carousel-item'>
                        <img class='d-block w-100 slika' src='$slika'>
                    </div>";
                }

                echo "</div>
                <a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                </a>
                <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                </a>
            
                </div>";

                disconnect($veza);

            ?>


                <!--dugme za prikaz svih knjiga-->
                <input type="button" name="dugme" id="dugme" class="btn btn-outline-dark" 
                    aria-pressed="true" value="Prikaz svih knjiga u biblioteci">

                <div id="prikaz_knjiga"></div>

            </div>
            


      <?php 
        include("footer.php");
        include("skriptovi.php");

      ?>  
        
        
    

    </body>

</html>
