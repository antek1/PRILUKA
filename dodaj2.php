<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
include_once '../../config.php';
if (!isset($_SESSION["autoriziran"]) || $_SESSION["autoriziran"] -> uloga != "administrator") {
	header("location: ../../index.php");
	
}
	
	




	if(isset($_POST['dodaj']))
	{
		$sorta_vina = $_POST['sorta_vina'];
		$vinarija = $_POST['vinarija'];
		$boja = $_POST['boja_vina'];		
		$zapremnina = $_POST['zapremnina'];
		$kvaliteta_vina = $_POST['kvaliteta_vina'];
		$godina_berbe = $_POST['godina_berbe'];
		$postotak_alkohola = $_POST['postotak_alkohola'];
		$stanje_skladista = $_POST['stanje_skladista'];
		$opis = $_POST['opis'];		
		$cijena = $_POST['cijena'];

		
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
		
		
		if(empty($sorta_vina)){
			$errMSG = "Molimo vas unesite naziv vina";
		}
		else if(empty($vinarija)){
			$errMSG = "Molimo vas unesite naziv vinarije";
		}
		else if(empty($boja)){
			$errMSG = "Molimo vas unesite sortu vina";
		}
		
		else if(empty($zapremnina)){
			$errMSG = "Molimo vas unesite zapremninu";
		}
		else if(empty($kvaliteta_vina)){
			$errMSG = "Molimo vas unesite kvalitetu vina";
		}
		else if(empty($godina_berbe)){
			$errMSG = "Molimo vas unesite godinu berbe";
		}
		else if(empty($postotak_alkohola)){
			$errMSG = "Molimo vas unesite postotak alkohola";
		}
		else if(empty($stanje_skladista)){
			$errMSG = "Molimo vas unesite stanje skladišta";
		}			
		else if(empty($opis)){
			$errMSG = "Molimo vas unesite opis";
		}
		else if(empty($cijena)){
			$errMSG = "Molimo vas unesite cijenu vina";
		}
		else if(empty($imgFile)){
			$errMSG = "Molimo vas unesite sliku";
		}
		else
		{
			$upload_dir = 'img/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			$userpic = rand(1000,1000000).".".$imgExt;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					$errMSG = "Slika je prevelika";
				}
			}
			else{
				$errMSG = "Jedino JPG, JPEG, PNG & GIF";		
			}
		}
		
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$izraz=$veza->prepare('INSERT INTO vino (vinarija,boja_vina,sorta_vina,zapremnina,kvaliteta_vina,stanje_skladista,postotak_alkohola,godina_berbe,slika,opis,cijena) 
			VALUES (:vinarija,:boja_vina,:sorta_vina,:zapremnina,:kvaliteta_vina,:stanje_skladista,:postotak_alkohola,:godina_berbe,:slika,:opis,:cijena)');
			
			$izraz->bindParam(':vinarija',$vinarija);
			$izraz->bindParam(':boja_vina',$boja);
			$izraz->bindParam(':sorta_vina',$sorta_vina);
			$izraz->bindParam(':kvaliteta_vina',$kvaliteta_vina);
			$izraz->bindParam(':zapremnina',$zapremnina);
			$izraz->bindParam(':postotak_alkohola',$postotak_alkohola);			
			$izraz->bindParam(':stanje_skladista',$stanje_skladista);			
			$izraz->bindParam(':godina_berbe',$godina_berbe);
			$izraz->bindParam(':opis',$opis);
			$izraz->bindParam(':cijena',$cijena);
			$izraz->bindParam(':slika',$userpic);


			if($izraz->execute())
			{
				$successMSG = "Novo vino je uspješno uneseno";
				header("locatio:n index.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "Greška kod unošenja";
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- head -->
	<?php include_once '../../head.php'; ?>
	<!-- /head -->
</head>
<body>

<?php include_once '../../header.php'; ?>

<div class="container">


	<div class="page-header">
    	<h1 class="h2">Dodavanje vina<a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Pogledaj sve unešena vina </a></h1>
    </div>
    

	<?php
	if(isset($errMSG)){
			?>
            <div class="alert alert-danger">
            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
	}
	?>   

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">Vina</label></td>
        <td><input class="form-control" type="text" name="sorta_vina" placeholder="Naziv vina" value="<?php echo $sorta_vina; ?>" /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Vinarija</label></td>
        <td><select name="vinarija" id="vinarija" placeholder="Vinarija" >
								<option value="0" >Vinarija</option>
								<option>------------------------------------------------</option>

								<?php

								$izraz = $veza -> prepare("SELECT * FROM vinarija order by naziv");
								$izraz -> execute();
								$rezultat = $izraz -> fetchAll(PDO::FETCH_OBJ);
								foreach ($rezultat as $vinarija) : ?>

								<option
								 <?php if(isset($_POST["vinarija"]) && $_POST["vinarija"]==$vinarija->id){
									echo " selected=\"selected\" ";
								} 
								?>  value="<?php echo $vinarija->id; ?>"><?php echo $vinarija->naziv; ?>
									
								</option>

							<?php endforeach; ?>						
												
							

						</select>



       
    </tr>
    
     <tr>
    	<td><label class="control-label">Sorta vina</label></td>
        <td><label >Boja vina:</label>

						<select name="boja_vina" id="boja_vina" placeholder="Sorta vina" >
							<option value="0" >Sorta vina</option>
							<option>------------------------------------------------</option>

							<?php
							$izraz = $veza -> prepare("SELECT * FROM boja_vina order by boja");
							$izraz -> execute();
							$rezultat = $izraz -> fetchAll(PDO::FETCH_OBJ);
							foreach ($rezultat as $boja_vina) : ?>

							<option
							<?php if(isset($_POST["boja_vina"]) && $_POST["boja_vina"]==$boja_vina->id){
								echo " selected=\"selected\" ";
							} ?>

							value="<?php echo $boja_vina->id; ?>"><?php echo $boja_vina->boja; ?>
								
							</option>

						<?php endforeach; ?>						

					</select>
					</td>


       
    </tr>

     <tr>
    	<td><label class="control-label">Zapremnina</label></td>
        <td><input class="form-control" type="text" name="zapremnina" placeholder="Zapremnina" value="<?php echo $zapremnina; ?>" /></td>
    </tr>

     <tr>
    	<td><label class="control-label">Kvaliteta vina</label></td>
        <td><input class="form-control" type="text" name="kvaliteta_vina" placeholder="Kvaliteta vina" value="<?php echo $kvaliteta_vina; ?>" /></td>
    </tr>

     <tr>
    	<td><label class="control-label">Godina berbe</label></td>
        <td><input class="form-control" type="text" name="godina_berbe" placeholder="Godina berbe" value="<?php echo $godina_berbe; ?>" /></td>
    </tr>

     <tr>
    	<td><label class="control-label">Postotak alkohola</label></td>
        <td><input class="form-control" type="text" name="postotak_alkohola" placeholder="Postotak alkohola" value="<?php echo $postotak_alkohola; ?>" /></td>
    </tr>

     <tr>
    	<td><label class="control-label">Stanje skladišta</label></td>
        <td><input class="form-control" type="text" name="stanje_skladista" placeholder="Stanje skladišta" value="<?php echo $stanje_skladista; ?>" /></td>
    </tr>

     <tr>
    	<td><label class="control-label">Opis</label></td>
        <td><input class="form-control" type="text" name="opis" placeholder="Opis" value="<?php echo $opis; ?>" /></td>
    </tr>

    <tr>
    	<td><label class="control-label">Cijena</label></td>
        <td><input class="form-control" type="text" name="cijena" placeholder="Cijena" value="<?php echo $cijena; ?>" /></td>
    </tr>

    <tr>
    	<td><label class="control-label">Slika</label></td>
        <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
    </tr>
    
    <tr>
        <td colspan="2">

        <button type="submit" name="dodaj" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; Spremi
        </button>


        <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-backward"></span> Odustani </a>
        
        </td>
    </tr>
    </tr>

    

    
    </table>
    
</form>




    

</div>



	


<!-- Latest compiled and minified JavaScript -->



</body>
</html>