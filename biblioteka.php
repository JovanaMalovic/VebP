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
		
		<title>Biblioteka</title>

		<link rel="icon" type="image/jpg" href="icon.jpg">
	    <link rel="stylesheet" type="text/css" href="css/biblioteka.css">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	        
	    <meta name="author" content="Jovana Malović">
	    <meta name="keywords" content="knjige, biblioteka, čitanje">

	    <script src="js/jquery-3.3.1.js"></script>
	</head>

	<body>

		<?php

            include("navigacija.php");

        ?>

        <!--wrapper za sadrzaj-->
        <div id="omotac">
        	
        	<div id="naslovna_linija">

        		<?php

        			//provera da li smo linkom dosli do biblioteke nekog drugog korisnika ili smo na svojoj biblioteci
        			if(!isset($_GET['korisnik'])){

			        $korisnik = $_SESSION['username'];
			    	}
			    	else{
			    		$korisnik = $_GET['korisnik'];
			    	}

        		?>

	            <p id='naslov'>Biblioteka korisnika <?php echo $korisnik; ?> </p>

	            <?php
	            if( $korisnik == $_SESSION['username']){
	            	echo "<a href='dodaj_knjigu.php'><input type='button' name='dodaj' id='dodaj' value='Dodajte knjigu' class='btn btn-outline-dark' aria-pressed='true'></a>";
	        		}
	        ?>
	            
        	</div>
            <div id="prikaz_knjiga">
            	
            	<?php

            	include("funkcije.php");

			        $veza = connect();


            		$upit = "SELECT id, slika, naziv, autor, ocena, id_korisnik FROM knjiga WHERE id_korisnik='$korisnik'";

            		$rezultat = mysqli_query($veza, $upit);

		            if($rezultat == false){
		            	die ("Greska prilikom upita".mysqli_error($veza));
		            }


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
            		echo "<div class='desni'>$naziv<br>$autor<br>Ocena: $ocena
            		<br><a href='biblioteka.php?korisnik=$korisnik' class='link'>$korisnik</a><br><a href='knjiga.php?id_knjiga=$id' class='link'>Detaljnije...</a></div></div></div>";
		            }

		            disconnect($veza);
		        ?>

		    </div>
		</div>
            	

            	

        <?php
        	include("footer.php");
        	include("skriptovi.php");

        ?>

	</body>
</html>