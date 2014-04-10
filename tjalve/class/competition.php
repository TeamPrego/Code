<?php
  include "config.php";
  
  class Competition {
  
	public function __construct(){
    }
    
    public function pushToDB($name, $arranger, $beginDate, $endDate, $lastDate){
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
	  
      $sql = "INSERT INTO competition (`competitionId`, `competitionName`, `dateFrom`, `dateTo`, `lastDate`, `organizer`, `logo`) 
      VALUES (NULL,'$name','$beginDate','$endDate','$lastDate','$arranger','$filePath')";
	  
	  $data = mysqli_query($con, $sql);
	
      if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);
	
	include "config.php";
	$query = "SELECT * FROM competition WHERE competitionName = '$name'";
			$data2 = mysqli_query($con, $query);
			
			if (!$data2) {
			  die('Error: ' . mysqli_error($con));
			}
			$row = $data2->fetch_object();
		//	echo $row->compID;
      mysqli_close($con);
	  header("Location: createCompetitionStep2.php?compID=".$row->competitionId);
    }
	
	public function getCompetition($compID) { //TABORT!???? eller kommer jag/vi behöva denna??!
			
			$query = "SELECT * FROM competition WHERE competitionId = '$compID'";
			$data = mysqli_query($con, $query);
			
			if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}
			$row = $data->fetch_object();
			echo "<div id='competition'><h1>" . $row->competitionName . "</h1></div>";	
		  // echo "<div id='compLogoDiv'>";
			echo "<table id='bronk'>";
			echo "<tr><td>Arrangör: </td><td>" . $row->organizer . "</td></tr>";	
			echo "<tr><td>Tävlingsdatum: </td><td>" . $row->dateFrom . " - " . $row->dateTo . "</td></tr>";	
			echo "<tr><td>Sista anmälningsdag: </td><td>" . $row->lastDate . "</td></tr>";	
			echo "</table>";
		  // echo "</div>";
		 
			echo "<img id ='compLogo' src=". $row->logo ." alt ='Image' />";
				
			mysqli_close($con);
    }
	
	
	public function getCompName($compID) {
      include "config.php";
	  $query = "SELECT * FROM competition WHERE competitionId = '$compID'";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}
		$row = $data->fetch_object();
	  return $row->competitionName;
    }

	public function getCompOrganizer($compID) {
      include "config.php";
	  $query = "SELECT * FROM competition WHERE competitionId = '$compID'";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}
		$row = $data->fetch_object();
	  return $row->organizer;
    }
	
	public function getCompDate($compID) {
      include "config.php";
	  $query = "SELECT * FROM competition WHERE competitionId = '$compID'";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}
		$row = $data->fetch_object();
	  return $row->dateFrom . " - " . $row->dateTo;
    }
	
	public function getCompLastDate($compID) {
      include "config.php";
	  $query = "SELECT * FROM competition WHERE competitionId = '$compID'";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}
		$row = $data->fetch_object();
	  return $row->lastDate;
    }
    
	public function getCompFile($compID) {
      include "config.php";
	  $query = "SELECT * FROM competition WHERE competitionId = '$compID'";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}
		$row = $data->fetch_object();
	  return $row->logo;
    }

	public function getAllYearClasses() {
	  include "config.php";
      $query = "SELECT * FROM allyearclasses WHERE 1";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
			  die('Error: ' . mysqli_error($con));
			}
		$array=[];
		while($row = $data->fetch_object()) {
			if(!in_array($row->yearClass, $array)) {
				array_push($array, $row->yearClass);
			}
		}
		//sort($array, SORT_DESC);
		mysqli_close($con); 
		foreach ($array as $key => $value) {
		  printf("\t<option value='%s'>%s</option>\n", $value, $value);
		}
	  
    }
	
	
	public function getAllDisciplines($compID, $inp) {
      include "config.php";
		
		$query = "SELECT * FROM alldisciplines";
	$data = mysqli_query($con, $query);

	if (!$data) {
	  die('Error: ' . mysqli_error($con));
	}
	
	$query2 = "SELECT discipline FROM competitiondisciplines WHERE competitionId = '$compID' && yearClass = '$inp'";
	$data2 = mysqli_query($con, $query2);

	if (!$data2) {
	  die('Error: ' . mysqli_error($con));
	}
	
	$disc=[];
	while($row = $data->fetch_object()){
	$disc[] = ['gren'=>$row->discipline];
	}
	
	$compare=[];
	while($row = $data2->fetch_object()){
	$compare[] = ['gren'=>$row->discipline];
	}
	
	$compareTmp=[];
		foreach($disc as $aV){
		$discTmp[] = $aV['gren'];
		}
		if(isset($compare)){
			foreach($compare as $aV){
				$compareTmp[] = $aV['gren'];
			}
		}
		else{
			$compareTmp[] = 'empty';
		}
		$result=[];
		$result=array_diff($discTmp, $compareTmp);
		return $result;
	
	
	mysqli_close($con);
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

<script type="text/javascript">	
console.log("hey mom!!");
</script>

<?php

if(isset($_GET['compID']) && isset($_GET['inp'])) {

	 $compID = $_GET['compID'];
   	 $inp	= $_GET['inp'];
	 echo $inp;
     $temp = new competition();
     $result = $temp->getAllDisciplines($compID, $inp);
	 echo json_encode($result);
}
?>