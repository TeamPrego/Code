<?php
	include "config.php";
	
	class Competition{
	
		public function getCompetition($compID){
			$ID = $compID;
			
			$query = "SELECT * FROM competition WHERE compID = '$ID'";
			$data = mysqli_query($con, $query);
			
			if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}
			$row = $data->fetch_object();
			echo "<div id='competition'><h1>" . $row->compName . "</h1></div>";	
		  // echo "<div id='compLogoDiv'>";
			echo "<table id='bronk'>";
			echo "<tr><td>Arrangör: </td><td>" . $row->compArr . "</td></tr>";	
			echo "<tr><td>Tävlingsdatum: </td><td>" . $row->compDate . "</td></tr>";	
			echo "<tr><td>Sista anmälningsdag: </td><td>" . $row->compLastDate . "</td></tr>";	
			echo "</table>";
		  // echo "</div>";
		 
			echo "<img id ='compLogo' src=". $row->compIcon ." alt ='Image' />";
				
			mysqli_close($con);
		}
		
		public function addCompetition($compName, $organizer, $date, $lastDay/*, $file*/){
			//http://www.w3schools.com/php/php_file_upload.asp
			//copy image
			/*if ($_FILES["file"]["error"] > 0)
			  {
			  echo "Error: " . $_FILES["file"]["error"] . "<br>";
			  }
			else
			  {
			  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			  echo "Type: " . $_FILES["file"]["type"] . "<br>";
			  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			  echo "Stored in: " . $_FILES["file"]["tmp_name"];
			  }
			  
			//save image on server
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$temp = explode(".", $_FILES["file"]["name"]);
			$extension = end($temp);
			if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/jpg")
			|| ($_FILES["file"]["type"] == "image/pjpeg")
			|| ($_FILES["file"]["type"] == "image/x-png")
			|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 6000000)
			&& in_array($extension, $allowedExts))
			  {
			  if ($_FILES["file"]["error"] > 0)
				{
				echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
				}
			  else
				{
				echo "Upload: " . $_FILES["file"]["name"] . "<br>";
				echo "Type: " . $_FILES["file"]["type"] . "<br>";
				echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

				if (file_exists("upload/" . $_FILES["file"]["name"]))
				  {
				  echo $_FILES["file"]["name"] . " already exists. ";
				  }
				else
				  {
				  move_uploaded_file($_FILES["file"]["tmp_name"],
				  "../upload/" . $_FILES["file"]["name"]);
				  echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
				  }
				}
			  }
			else
			{
			  echo "Invalid file";
			}
			//$file ->resizeImage(50,50, imagick::FILTER_LANCZOS, 0.9, true);
			$file = $_FILES["file"]["name"];
			$filePath  = "upload/" . $file . "";*/
			$sql = "INSERT INTO competition (`compID`, `compName`, `compArr`, `compDate`, `compLastDate`) 
			VALUES (NULL,'$_POST[".$compName."]','$_POST[".$organizer."]','$_POST[".$date."]','$_POST[".$lastDay."]')";
			
			
			if (!mysqli_query($con,$sql)) {
			  die('Error: ' . mysqli_error($con));
			}
			
			$data = mysqli_query($con, "SELECT compID FROM competition WHERE compName='$_POST[compName]'");
			$compID = $data->fetch_object()->compID;

			mysqli_close($con);
			
			header("Location: ../createCompetitionStep2.php?compID=".$compID);
		}
	}
?>
