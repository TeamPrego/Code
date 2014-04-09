<?php
  include "config.php";
  
  class Competition {
  
	public function __construct(){
    }
    
    public function pushToDB($name, $arranger, $beginDate, $lastDate){
	  //http://www.w3schools.com/php/php_file_upload.asp
			//copy image
			if ($_FILES["file"]["error"] > 0)
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
			$filePath  = "upload/" . $file . "";
      
      include "config.php";
	  
      $sql = "INSERT INTO competition (`compID`, `compName`, `compArr`, `compDate`, `compLastDate`, `compIcon`) 
      VALUES (NULL,'$name','$arranger','$beginDate','$lastDate','$filePath')";
	  
	  $data = mysqli_query($con, $sql);
	
      if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);
	
	include "config.php";
	$query = "SELECT * FROM competition WHERE compName = '$name'";
			$data2 = mysqli_query($con, $query);
			
			if (!$data2) {
			  die('Error: ' . mysqli_error($con));
			}
			$row = $data2->fetch_object();
		//	echo $row->compID;
      mysqli_close($con);
	  header("Location: createCompetitionStep2_classTest.php?compID=".$row->compID);
    }
	
	public function getCompetition($compID) { //TABORT!???? eller kommer jag/vi behöva denna??!
			
			$query = "SELECT * FROM competition WHERE compID = '$compID'";
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
	
	
	public function getCompName($compID) {
      include "config.php";
	  $query = "SELECT * FROM competition WHERE compID = '$compID'";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}
		$row = $data->fetch_object();
	  return $row->compName;
    }

	public function getCompOrganizer($compID) {
      include "config.php";
	  $query = "SELECT * FROM competition WHERE compID = '$compID'";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}
		$row = $data->fetch_object();
	  return $row->compArr;
    }
	
	public function getCompDate($compID) {
      include "config.php";
	  $query = "SELECT * FROM competition WHERE compID = '$compID'";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}
		$row = $data->fetch_object();
	  return $row->compDate;
    }
	
	public function getCompLastDate($compID) {
      include "config.php";
	  $query = "SELECT * FROM competition WHERE compID = '$compID'";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}
		$row = $data->fetch_object();
	  return $row->compLastDate;
    }
    
	public function getCompFile($compID) {
      include "config.php";
	  $query = "SELECT * FROM competition WHERE compID = '$compID'";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}
		$row = $data->fetch_object();
	  return $row->compIcon;
    }
	
	
	
    public function changeName($newName) {
      $name=$newName;
    }
    public function changeBeginDate($newDate) {
      $beginDate=$newDate;
    }
    public function changeEndDate($newDate) {
      $endDate=$newDate;
    }
    public function changeLastDate($newDate) {
      $lastDate=$newDate;
    }
    public function changeArranger($newArranger) {
      $arranger=$newArranger;
    }
    
  }
?>