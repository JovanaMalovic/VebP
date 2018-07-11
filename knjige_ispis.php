<?php

	include("funkcije.php");

	$veza = connect();
			        
    $upit = "SELECT id, slika, naziv, autor, ocena, id_korisnik FROM knjiga";

    $rezultat = mysqli_query($veza, $upit);

	if($rezultat == false){
		die ("Greska prilikom upita ".mysqli_error($veza));
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
        echo "<div class='desni'>$naziv<br>$autor<br>Ocena: $ocena<br>
	    	<a href='biblioteka.php?korisnik=$korisnik' class='link'>$korisnik</a><br><a href='knjiga.php?id_knjiga=$id' class='link'>Detaljnije...</a></div></div></div>";
		            }

		disconnect($veza);

		?>


                
