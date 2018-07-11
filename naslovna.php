<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!--Korisceno je bas ovako (sa shrink-to-fit=no) jer sam responsive design radila preko bootstrap grida-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>Moja biblioteka</title>
        
        <link rel="icon" type="image/jpg" href="icon.jpg">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        
        <meta name="author" content="Jovana Malović">
        <meta name="keywords" content="knjige, biblioteka, čitanje">
    </head>
    
    <body>

        <?php
            include("funkcije.php");
        ?>
    

        <div class="container">
            <div class="row">
                <div id="levo" class="col-12 col-md-6">
                    <p id="naslov">Pridruži se online zajednici ljubitelja knjiga</p>
                </div>
        
                <div id="desno" class="col-12 col-md-6">
                
                    <form id="forma1" action="" method="POST">
                        <div id="prijava">
                            <div id="kor_ime">
                                <label>Korisničko ime</label>
                                <br>
                                <input type="text" style="width: 200px;" class="form-control" name="ime_kor">
                            </div>

                            <div id="lozinka">
                                <label>Lozinka</label>
                                <br>
                                <input type="password" style="width: 200px;" class="form-control" name="lozinka">
                                <span></span>
                            </div>
                            <input type="submit" name="log_in" class="btn btn-outline-dark" value="Prijavi se" id="prijaviSe">
                        </div>
                    </form>

                    <?php

                                
                                if(isset($_POST['log_in'])){


                                    $ime = $_POST['ime_kor'];
                                    $pass = $_POST['lozinka'];

                                    //konekcija na bazu

                                    $veza = connect();

                                    $upit = "SELECT * FROM korisnik WHERE username='$ime' and password='$pass'";

                                    $rezultat = mysqli_query($veza, $upit);

                                    if($rezultat == false){
                                        die("<span class='greska'>Greska prilikom upita</span>");
                                    }

                                    $n = mysqli_num_rows($rezultat);

                                    if($n == 0){

                                        die("<span class='greska'>Korisnik ne postoji!</span>");
                                    }

                                    $korisnik = mysqli_fetch_assoc($rezultat);

                                    session_start();

                                    $_SESSION['username'] = $korisnik['username'];
                                    $_SESSION['mail'] = $korisnik['mail'];
                                    $_SESSION['password'] = $korisnik['password'];

                                    header('Location: pocetna.php');


                                    disconnect($veza);

                                }

                            ?>



                    
                    <form id="forma2" action="" method="POST">
                        <div id="registracija">
                            <p>Napravi nalog</p>
                            <input type="text" name="ime" maxlength="15" placeholder="Korisničko ime" style="width: 200px; height: 30px;" class="form-control" required>
                            <br>
                            <input type="email" name="mail" placeholder="Email adresa" style="width: 200px; height: 30px;" class="form-control" required>
                            <br>
                            <input type="password" name="pass" placeholder="Lozinka" style="width: 200px; height: 30px;" class="form-control" required>
                            <br>

                            <input type="submit" name="reg_dugme" class="btn btn-outline-dark" value="Gotovo" id="gotovo">
                            <br>
                            
                        </div>
                    </form>
                    
                    <?php

                                
                                if(isset($_POST['reg_dugme'])){


                                    $ime = $_POST['ime'];
                                    $mail = $_POST['mail'];
                                    $pass = $_POST['pass'];

                                    $at_pos = strpos($mail, "@");

                                    //pozicija poslednje pojave tacke 
                                    $tacka = strripos($mail, ".");

                                    if($tacka < $at_pos){

                                        die("<span class='greska'>Neispravna e-mail adresa</span>");
                                    }

                                    //konekcija na bazu

                                    $veza = connect();

                                    $upit = "SELECT * FROM korisnik WHERE username='$ime'";

                                    $rezultat = mysqli_query($veza, $upit);

                                    if($rezultat == false){
                                        die("<span class='greska'>Greska prilikom upita</span>");
                                    }

                                    $n = mysqli_num_rows($rezultat);

                                    if($n > 0){

                                        die("<span class='greska'>Korisničko ime je zauzeto!</span>");
                                    }

                                    $upit1 = "INSERT INTO korisnik (username, mail, password) VALUES ('$ime', '$mail', '$pass')";

                                    $rezultat = mysqli_query($veza, $upit1);

                                    if($rezultat == false){
                                        die("<span class='greska'>Greska prilikom upita</span>");
                                    }

                                    echo "<span class='greska'>Registracija uspešna, prijavite se</span>";

                                    disconnect($veza);

                                }

                            ?>

                </div>
            </div>
        </div>

        <?php
            include("skriptovi.php");

        ?>
    </body>
    

</html>
