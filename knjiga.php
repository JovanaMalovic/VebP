<?php
    
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

	<title>Knjiga</title>

	<link rel="icon" type="image/jpg" href="icon.jpg">
    <link rel="stylesheet" type="text/css" href="css/knjiga.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        
    <meta name="author" content="Jovana Malović">
    <meta name="keywords" content="knjige, biblioteka, čitanje">

    <script src="js/jquery-3.3.1.js"></script>

</head>
<body>

	<?php

            include("navigacija.php");
            include("funkcije.php");
        ?>
        
        <!--wrapper za sadrzaj-->
        <div id="omotac">
            
            <?php

                $id_knjiga = $_GET['id_knjiga']; 

                $veza = connect();

                $upit = "SELECT * FROM knjiga WHERE id='$id_knjiga'";

                $rezultat = mysqli_query($veza, $upit);

                    if($rezultat == false){
                        die ("Greska prilikom upita");
                    }

                    $red = mysqli_fetch_assoc($rezultat);
                    $id = $red['id'];
                    $naziv = $red['naziv'];
                    $slika = "images/".$red['slika'];
                    $korisnik = $red['id_korisnik'];
                    $autor = $red['autor'];
                    $izdavac = $red['izdavac'];
                    $ocena = $red['ocena'];
                    $opis = $red['opis'];
            

                    echo "<p id='naslov'>$naziv</p>";
                    echo "<div id='sadrzaj'>
                
                            <div id='levi'>
                                <img src='$slika' alt='Slika knjige'>      
                            </div>";

                    echo "<div id='desni'>
                            <ul>
                                <li>Postavio: $korisnik</li>
                                <li>Autor: $autor</li>
                                <li>Izdavač: $izdavac</li>
                                <li>Ocena: $ocena</li>
                            </ul>
                        </div>";

                    if($opis != ""){
                        echo "<div id='opis'>$opis</div>";
                    }

                    disconnect($veza);

            ?>

 				<form action="" method="POST">
                <div id="dodaj_komentar">           	
            		<label>Ostavi komentar</label>
            		<textarea name="opis" class="form-control" style="width: 280px;" rows="5" ></textarea>
            		<br>
                    <input type="submit" name="submit" class="btn btn-outline-dark" aria-pressed="true" value="Potvrdi" id="potvrdi">
            	</div>
                </form>
            	<p id="komentar_id">Komentari: </p>
            	<div id="komentari">

                    <?php


                        if(isset($_POST['submit'])){

                            $tekst = trim($_POST['opis']);
                            $vreme = date("h:i:sa");
                            $ime = $_SESSION['username'];
                           

                            $veza = connect();
                            
                            if(!empty($tekst)){

                                $upit = "INSERT INTO komentari (id_knjiga, id_korisnik, komentar) VALUES ('$id', '$ime', '$tekst')";

                                $rezultat = mysqli_query($veza, $upit);

                                if($rezultat == false){
                                    die ("Greska prilikom upita".mysqli_error($veza));
                                }
                            }

                             disconnect($veza);
                        }

                    ?>
                    
                    <?php

                        $veza = connect();

                        $upit = "SELECT * FROM komentari WHERE id_knjiga=$id";

                         $rezultat = mysqli_query($veza, $upit);

                                if($rezultat == false){
                                    die ("Greska prilikom upita".mysqli_error($veza));
                                }

                            while($red = mysqli_fetch_assoc($rezultat)){

                                $dodao = $red['id_korisnik'];
                                $vreme = $red['vreme'];
                                $tekst = $red['komentar'];

                                echo "<div class='komentar'>
                                        <div class='traka'>
                                                <span class='dodao'>$dodao</span>
                                            <span class='vreme'>$vreme</span>
                                        </div>$tekst</div>";
                            }                        

                            disconnect($veza);
                    ?>            		
            	</div>

            </div>
       

        </div>


        <?php 
        include("footer.php");
        include("skriptovi.php");

      ?>  
</body>
</html>