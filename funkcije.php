<?php

function connect(){
	
	$veza = mysqli_connect('localhost', 'root', '', 'biblioteka');

	if($veza == false){
		die("<span class='greska'>Nije uspelo povezivanje sa bazom</span>");
	}

	return $veza;
}

function disconnect($veza){

	mysqli_close($veza);

}

?>