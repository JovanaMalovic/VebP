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
		
		<title>Galerija knjiga</title>

		<link rel="icon" type="image/jpg" href="icon.jpg">
	    <link rel="stylesheet" type="text/css" href="css/galerija.css">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	        
	    <meta name="author" content="Jovana Malović">
	    <meta name="keywords" content="knjige, biblioteka, čitanje">

	    <script src="js/jquery-3.3.1.js"></script>
	    <script>

	    	var slike = [];

	    	$(document).ready(function(){

	    		$.ajax({

	    			url: 'galerija_obrada.php',
	    			method: 'POST',
	    			success: function(odgovor){
	    				slike = odgovor.split(",");
	    				/*probala sam da ovde izadjem iz ajax poziva, ali promenljiva slike nakon izlaska nije imala upisan odgovor*/
	    		//		console.log(slike);
	    				var brojac = 0;
	    				$("img").attr("src", slike[brojac]);
	    				var n = slike.length;
	    		//	console.log(n);
         				function next(){

	    					if(brojac < n-1){
	    						brojac++;
	    					}	
	    					else{
	    						brojac = 0;
	    					}
	    				
	    				$("img").attr("src", slike[brojac]);
	    				}

	    				function back(){
	    					
	    					if(brojac > 0){
	    						brojac--;
	    					}	
	    					else{
	    						brojac = n-1;
	    					}
	    				
	    					$("img").attr("src", slike[brojac]);
	    				}

	    				$("#back").click(function(){
	    					back();
	    				});

	    				$("#next").click(function(){
	    					next();
	    				});

	    				var timer;

	    				$("#start").click(function(){
	    			
	    					timer = window.setInterval(next, 4000);
	    				});

	    				$("#stop").click(function(){
	    			
	    					window.clearInterval(timer);
	    				}); 			
	    			}
	    		});


	    	});

	    </script>
</head>
<body>
		<?php
			include("navigacija.php");
		?>
        <div id="omotac">
        	
        	<div id="naslovna_linija">
	            <p id="naslov">Galerija online biblioteke</p>

	            <div id="slideshow">
	         	   	<img src="">
	            	<br>
	            	<input type="button" class="btn btn-outline-dark" aria-pressed="true" value="Prethodna" id="back">
	            	<input type="button" class="btn btn-outline-dark" aria-pressed="true" value="Sledeca" id="next">
	            	<br>
	            	<input type="button" class="btn btn-outline-dark" aria-pressed="true" value="Pokreni slideshow "  id="start">
	            	<br>
	            	<input type="button" class="btn btn-outline-dark" aria-pressed="true" value="Zaustavi slideshow" id="stop">
	            </div>
	        </div>
	    </div>
	    <?php
        	include("footer.php");
        	include("skriptovi.php");

        ?>

</body>
</html>