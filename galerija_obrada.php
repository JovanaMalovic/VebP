<?php

            
            include("funkcije.php");

            $veza = connect();

            $upit = "SELECT slika FROM knjiga";

            $rezultat = mysqli_query($veza, $upit);

            if($rezultat == false){
            	die("Greska prilikom upita".mysqli_error());
            }

            $slike = "";

            while($red = mysqli_fetch_assoc($rezultat)){
            	$slike = $slike."images/".$red['slika'].",";
            }

            $n = strlen($slike);

            $slike = substr($slike, 0, $n-1);
	
			echo "$slike";

?>