<!DOCTYPE html>
<html lang="es">
	<?php 
		require_once 'head.php'; 
		$webTitle = "Add a photo- Picturesque";		
	?>

	<body onLoad="fillAlbumDate()">		
		<div id="popUpAlbum">
			<?php
      			include 'album.html';  
    		?>
		</div>
		<div id="overlay-back"></div>
		<header>				
			<a href="index.php"> 
				<img class="logoBox" src="Resources/Images/logo.png" alt="Logo"/> 
			</a>	
			<?php if (isset($_COOKIE['authenticated']) || isset($_SESSION['authenticated'])) include 'logged.html';   ?>

			<div class="currentStyle">
				<button class="btn btn-login btnStyle" id="cangestyle">Style</button>
				<ul id="webstyle">
					<li id="principal" onclick="getStringFromObject(this)"> <p>Principal</p></li>
					<li id="accesible" onclick="getStringFromObject(this)"> <p>Accesible</p></li>			
				</ul>
			</div>
			<div class="currentAccesibleStyle">
				<p> Pick the Style: </p>
				<button class="btn btn-login btnStyle" id="principalA" onclick="getStringFromObject(this)" >Principal </button>
				<button class="btn btn-login btnStyle" id="accesibleA" onclick="getStringFromObject(this)" >Accesible </button>
			</div>
			<div class="padding headerContent">				
				<h1>Add a photo...</h1>				
			</div>						
		</header>

		<section>
			<div class="boxPics"> <a class="back" href="profile.php"><h2><i class="fa fa-arrow-left"></i>  Go back</h2></a></div>
			<div class="wrapper ASWrapper">
                <div class="login WSadvanced">				
					<form autocomplete="on" method="post" id="addPhotoform" action="addphoto.php" name="photoform"> 
                        <div class="wrapperSearch wrapperAddPhoto">
                            <span class="titleh1">Complete the fields... </span> 
                            <div class="usuRegistro"> 
                                <p>     
                                    <label for="title"><b>TITLE: </b> </label>                      
                                    <input type="text" name="title" id="title" placeholder="E.G: landscape"/>                         
                                </p>   
                                <p>     
                                    <label for="description"><b>DESCRIPTION: </b> </label> <br>
                                    <textarea placeholder="E.G: My visit last summer..." rows="4" cols="50" name="description" id="descriptiona"></textarea>                   
                                </p>   
                                <p id="dateFields">     
                                    <label for="dateFrom" id="dateTitle"><b>DATE: </b> </label>                  
                                            <select id="dayfrom" name="dayfrom" onchange="reseting(this)">
                                            </select>
                                            <select id="monthfrom" name="monthfrom" onchange="reseting(this)">
                                            </select>
                                            <select id="yearfrom" name="yearfrom" onchange="reseting(this)">
                                            </select> <br>   
                                            <?php
                                                if(isset($_POST['CreatePhoto']) && isset($_POST['dayfrom']) && isset($_POST['monthfrom']) && isset($_POST['yearfrom']) ){   
                                                    $months =["January" => 1,"February" => 2,"March" => 3,"April" => 4,"May" => 5,"June" => 6,"July" => 7,"August" => 8,"September" => 9,"October" => 10,"November" => 11,"December" => 12];
                                                    $str=$months[$_POST['monthfrom']];
                                                    $foo=checkdate($str,$_POST["dayfrom"],$_POST["yearfrom"]);
                                                    if($foo==TRUE){
                                                        $DateValidation=TRUE;
                                                    }
                                                }
                                            ?>             
                                </p>   
                                
                                <p>     
                                    <label for="title"><b>COUNTRY: </b> </label>                      
                                    <?php
                                          require_once("includecountry.php");
                                        
                                        ?>                       
                                </p>   
                                <p>
                                	<label for="picture"><b>PICTURE (URL):</b> </label>
                                	<input type="text" name="picture" id="picture" placeholder="Paste your URL here"/>    
                                </p>   
                                <p>     
                                    <label for="title"><b>ALBUM: </b> </label>                      
                                    <?php    
										$identificador = @mysqli_connect('localhost','web','','pibd');
                                            $i=0;
                                            if(!$identificador){
                                                echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
                                                echo "</p>";
                                                exit;
                                            }                                    
                                        $sentencia2= "select * from albumes a, usuarios u where u.NomUsuario = '$_SESSION[authenticated]' and a.Usuario = u.idUsuario";
                                        
                                        if(!($resultado2 = @mysqli_query($identificador,$sentencia2))){
                                            echo "<p>Error al ejecutar la sentencia <b>$sentencia2</b>: ". mysqli_error($identificador);
                                            echo "</p>";
                                            exit;
                                        }
                                    
                                        echo "<select name='albumes' id='albumes'>";
                                            while ($fila2 = @mysqli_fetch_assoc($resultado2)){
                                            	if($_GET['id'] == $fila2[idAlbum]) echo "<option value='$fila2[idAlbum]' selected> $fila2[TituloAlbum] </option>";
                                                else echo "<option value='$fila2[idAlbum]'> $fila2[TituloAlbum] </option>";
                                            }
                                        
                                        echo "</select>";           
                                    ?>                       
                                </p>               

                                <p class="button printOut"><input class="searchR" type="submit" name="CreatePhoto" value="Add!"/> </p>
                                <button class="printIn">Add!</button>                                                     
                            </div> 
                        </div>                      
                    </form>

				</div>
                 
        		</div>
        	</div>
	
		</section>
           <?php 
            if(isset($_POST['CreatePhoto'])){
                $identificador = @mysqli_connect('localhost','web','','pibd');
                if(!$identificador){
                    echo "<p>Error al conectar con la base de datos: ". mysqli_connect_errno();
                    echo "</p>";
                    exit;
                }
                $date = $_POST['yearfrom'].'-'.$str.'-'.$_POST['dayfrom'];
                $insercionFoto = "insert into fotos (Titulo, Descripcion, Fecha, Pais, Album, Fichero, FRegistro) VALUES ('$_POST[title]', '$_POST[description]',
                                    '$date', $_POST[country], '$_POST[albumes]','$_POST[picture]', NOW())"; 
                if( !($resultado_p = @mysqli_query($identificador,$insercionFoto)) ){
                        echo "<p>Error al ejecutar la sentencia <b>$insercionFoto</b>: ". mysqli_error($identificador);
                        echo "</p>";
                        exit;
                }
                $_SESSION["photo_title"]= $_POST['title'];  
                $_SESSION["photo_description"]= $_POST['description'];
                $_SESSION["photo_date"]= $date;
                $_SESSION["photo_country"]= $_POST['country'];

                echo "<script>document.location.href = \"photoresult.php\";</script>";

                mysqli_free_result($resultado2);
                mysqli_close($identificador);
            }
        ?>


		<span class="rights printIn">Made for an awesome subject in the University of Alicante. All Copyright reserved to Alberto Martínez Martínez and Roxanne López van Dooren</span>
		<?php
			require_once("footer.php");
		?>	
		
	</body>	
</html>