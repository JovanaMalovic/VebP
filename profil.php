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
        
        <title>Moj profil</title>
        
        <link rel="icon" type="image/jpg" href="icon.jpg">
        <link rel="stylesheet" type="text/css" href="css/profil.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        
        <meta name="author" content="Jovana Malović">
        <meta name="keywords" content="knjige, biblioteka, čitanje">

    </head>




<body>

	<?php

		include("navigacija.php");
        include("funkcije.php");
	?>

	<div id="omotac">

		<p id="naslov">Profil i podaci korisnika</p>
	
	<p id="tekst">*Ukoliko zelite da izmenite svoje podatke, unesite nove podatke u za to predviđena polja. Ukoliko izmene prođu proveru bićete izlogovani sa starog naloga. Da biste ponovo pristupili online biblioteci, prijavite se sa novim podacima</p>

    <div id="podaci">
        <?php

            $ime = $_SESSION['username'];
            $mail = $_SESSION['mail'];
            $pass = $_SESSION['password'];

            echo "Vaše korisničko ime: $ime";
            echo "<br>";
            echo "Vaš e-mail: $mail";
            echo "<br>";
            echo "Vaša lozinka: $pass";

        ?>
    </div>	

	<form action="" method="POST">
                        <div>
                        	<label>Korisničko ime: </label>
                            <input type="text" style="width: 250px;" class="form-control" name="ime" required>
                            <br>
                            
                            <label>Email adresa: </label>
                            <input type="email" style="width: 250px;" class="form-control" name="mail" required>
                            <br>
                            
                            <label>Lozinka: </label>
                            <input type="password" style="width: 250px;" class="form-control"  name="pass" required>
                            <br>
                            
                            <input type="submit" class="btn btn-outline-dark" aria-pressed="true" value="Izmeni" name="submit">
                            <br>
                            <?php

                                
                                if(isset($_POST['submit'])){


                                    $ime = $_POST['ime'];
                                    $mail = $_POST['mail'];
                                    $pass = $_POST['pass'];

                                    $at_pos = strpos($mail, "@");

                                    //pozicija poslednje pojave tacke 
                                    $tacka = strripos($mail, ".");

                                    if($tacka < $at_pos){

                                        die("Neispravna e-mail adresa");
                                    }

                                    //konekcija na bazu

                                    $trenutno = $_SESSION['username'];


                                    $veza = connect();

                                    //moram da proverim da li u bazi vec postoji taj korisnik, ako da, mora drugo korisnicko ime

                                    if($trenutno != $ime){

                                       $upit = "SELECT * FROM korisnik WHERE username='$ime'";
                                       
                                       $rezultat = mysqli_query($veza, $upit);

                                        if($rezultat == false){
                                            die("Greska prilikom upita ".mysqli_error());
                                        }

                                        $n = mysqli_num_rows($rezultat);

                                        if($n > 0){

                                            die("Korisničko ime je zauzeto!");
                                        }
                                    }


                                    $upit1 = "UPDATE korisnik SET username = '$ime', mail = '$mail', password = '$pass' 
                                                            WHERE username = '$trenutno'";

                                    $rezultat = mysqli_query($veza, $upit1);

                                    if($rezultat == false){
                                        die("Greska prilikom upita ".mysqli_error());
                                    }
                                    
                                    disconnect($veza);

                                    include("odjava.php");
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