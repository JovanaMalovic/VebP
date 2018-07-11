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
		
		<title>Pretraga</title>

		<link rel="icon" type="image/jpg" href="icon.jpg">
	    <link rel="stylesheet" type="text/css" href="css/pretraga.css">
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
        	
        	<div id="naslovna_linija">
	            <p id="naslov">Pretražite online biblioteku</p>
	        </div>

	        <p id="tekst">*Pretragu možete vršiti po autoru, nazivu knjige ili korisniku. U polje unesite pun naziv autora, knjige ili korisnika</p>
	     <form action="" method="POST">
	     	<div id="forma">
	        <input type="text" name="unos" style="width: 250px;" class="form-control">
	        <br>
	        <input type="radio" name="pretraga" value="1">Autor
	        <br>
	        <br>
	        <input type="radio" name="pretraga"  value="2">Naziv knjige
	        <br>
	        <br>
	        <input type="radio" name="pretraga" value="3">Username korisnika
	        <br>
	        <br>
	        <input type="submit" name="submit" class="btn btn-outline-dark" aria-pressed="true" value="Pretraži">
	    </div>
	    </form>

	    	<div id="prikaz_knjiga">

	    	<?php


	    		if(isset($_POST['submit'])){

	    			//Asistentkinji sam poslala sa !empty($_POST['pretraga']), jos jedna greska koja mi je promakla
	    			if(!empty($_POST['unos']) && isset($_POST['pretraga'])){


	    				$unos = trim($_POST['unos']);
	    				$cekirano = $_POST['pretraga'];
	    				if($cekirano == 1){

	    					//pretrazujemo po autoru
	    					$upit = "SELECT * FROM knjiga WHERE autor='$unos'";
	    				}

	    				if($cekirano == 2){
	    					$upit = "SELECT * FROM knjiga WHERE naziv='$unos'";
	    				}

	    				if($cekirano == 3){
	    					$upit = "SELECT * FROM knjiga WHERE id_korisnik='$unos'";
	    				}

	    				$veza = connect();

	    				$rezultat = mysqli_query($veza, $upit);

	    				if($rezultat == false){
	    					die("Greska prilikom upita ".mysqli_error($veza));
	    				}

	    				if(mysqli_num_rows($rezultat) == 0)
	    					die("Nema rezultata!");

	    				while($red = mysqli_fetch_assoc($rezultat)){
	    					$id = $red['id'];
							$slika = $red['slika'];
							$naziv = $red['naziv'];
							$autor = $red['autor'];
					        $ocena = $red['ocena'];
					        $korisnik = $red['id_korisnik'];


					        //morala sam da skracujem prikaz naziva jer se javlja problem u prikazu
					        if(strlen($naziv) > 18){
					        	$naziv = substr($naziv, 0, 15);
					        	$naziv = $naziv."...";
					        }

					        if(strlen($autor) > 18){
					        	$autor = substr($autor, 0, 15);
					        	$autor = $autor."...";
					        }

							echo "<div class='knjige'>";

					        echo "<div class='levi_i_desni'><div class='levi'><img src='images/$slika' alt='Slika knjige' class='slika_knjige'></div>";
					        echo "<div class='desni'>$naziv<br>$autor<br>Ocena: $ocena<br>
						    	<a href='biblioteka.php?korisnik=$korisnik' class='link'>$korisnik</a><br><a href='knjiga.php?id_knjiga=$id' class='link'>Detaljnije...</a></div></div></div>";							            
						    }

						    //Asistentkinji sam poslala sa ovom naredbom nakon naredne }. To je greska koja mi je promakla.
						    disconnect($veza);
						}
	    				
	    		}
	    		
	    	?>

	    </div>
	    </div>

	    <?php
        	include("footer.php");
        	include("skriptovi.php");

        ?>

</body>
</html>