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

		<title>Dodavanje knjige</title>

		<link rel="icon" type="image/jpg" href="icon.jpg">
	    <link rel="stylesheet" type="text/css" href="css/dodaj_knjigu.css">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	        
	    <meta name="author" content="Jovana Malović">
	    <meta name="keywords" content="knjige, biblioteka, čitanje">

	    <script src="js/jquery-3.3.1.js"></script>
	    <script >
         
            $(document).ready(function(){

                $("form").submit(function(){

                    var naziv = trim($("#naziv").val());
                    var autor = trim($("#autor").val());
                    var izdavac = trim($("#izdavac").val());
                    var ocena = $("select").val();
                    var opis = trim($("textarea").val());

                    if(naziv == ""){
                        $("#greska1").html(Morate uneti naziv);
                        return;
                    }

                    if(autor == ""){
                        $("#greska2").html(Morate uneti ime autora);
                        return;
                    }


                });


            });

        </script>
	</head>
	
	<body>

        <?php

            include("navigacija.php");
            include("funkcije.php");

        ?>

		<div id="omotac">

			<p id="naslov">Dodaj knjigu i uvećaj svoju biblioteku</p>
		
			<p id="tekst">*Da bi dodao knjigu unesi potrebne podatke u za to predviđena polja</p>

			<form action="" method="POST" enctype="multipart/form-data">
                        <div>
                            <span id="poruka"></span>
                        	<label>Naziv knjige: </label>
                            <input type="text" style="width: 270px;" name="naziv" class="form-control" required>
                            <span id="greska1">*obavezno polje</span>
                            <br>
                            
                            <label>Autor: </label>
                            <input type="text" style="width: 270px;" name="autor" class="form-control" required>
                            <span id="greska2">*obavezno polje</span>
                            <br>
                            
                            <label>Izdavac: </label>
                            <input type="text" style="width: 270px;" class="form-control" name="izdavac">
                            <br>
                            
                            <label>Ocena: </label>
                            <select style="width: 180px;" class="form-control" name="ocena">
                            	<option value="0"></option>
                            	<option value="1">1</option>
                            	<option value="2">2</option>
                            	<option value="3">3</option>
                            	<option value="4">4</option>
                            	<option value="5">5</option>
                            </select>
                            <br>

                            <label>Slika: </label>
                            <input type="file" name="image" class="form-control" style="width: 250px;" required>
                            <span id="greska2">*obavezno polje</span>
                            <br>
                            <label>Opis: </label>
                            <textarea name="opis" class="form-control" style="width: 270px;" rows="7"></textarea>
                            <br>

                            <input type="submit" name="submit" class="btn btn-outline-dark" aria-pressed="true" value="Dodaj knjigu">

                            <?php

                                if(isset($_POST['submit'])){

                                    $naziv = $_POST['naziv'];
                                    $autor = $_POST['autor'];
                                    $izdavac = $_POST['izdavac'];
                                    $ocena = $_POST['ocena'];
                                    $opis = $_POST['opis'];
                                    $korisnik = $_SESSION['username'];

                                    //naredne linije koda sam pronasla na internetu i iskoristila ih kako bi moja web aplikacija dobila 
                                    //funkcionalnost kakvu sam zelela. Izvor: http://codewithawa.com/posts/image-upload-using-php-and-mysql-database

                                    $slika = $_FILES['image']['name'];

                                    //Slika ce se smestati u folder images u okviru foldera projekta
                                    $target = "images/".basename($slika);

                                    $veza = connect();

                                    $upit = "INSERT INTO knjiga (naziv, ocena, slika, opis, autor, izdavac, id_korisnik) 
                                            VALUES ('$naziv', $ocena, '$slika', '$opis', '$autor', '$izdavac', '$korisnik')";

                                    $rezultat = mysqli_query($veza, $upit);

                                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                                        //echo "Image uploaded successfully";
                                    }else{
                                        die("Failed to upload image");
                                    }

                                    if($rezultat == false){
                                        die("Greska prilikom upita!");
                                    }

                                    echo "Uspešno dodata knjiga";
                                    
                                    disconnect($veza);
                                }


                            ?>
                        </div>
                    </form>

		</div>

        <?php 
        include("footer.php");
        include("skriptovi.php");

      ?>  
        

	</body>
</html>