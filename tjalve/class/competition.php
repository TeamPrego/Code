

<?php
/*2014-04-11
The class should represent a competition:
-id
-name
-staring date
-ending date
-last apply date
-organizer
(-events) -> Not done for some reason include "event.php" will not work.
*/
  
  include "config.php";
  //include "event.php";
  class Competition {
  
  public $id;
  public $name;
  public $organizer;
  public $date;
  public $lastDate;
  
	public function __construct(){
  }
  
  public function setCompetition($compId, $compName, $compOrganizer, $compDate, $compLastDate){
    $this -> id = $compId;
    $this -> name = $compName;
    $this -> organizer = $compOrganizer;
    $this -> date = $compDate;
    $this -> lastDate = $compLastDate;
  }
  
  //Function that sends a new competition to the database
  //gets input from for the competition. A lot of the code is for
  //being able to upload image
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
	/*
    Id as argument. Gets competitions from database and
    
  */
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
	
	
	public function getCompName($competitionId) {
	  include "config.php";
	  $query = "SELECT * FROM competition WHERE competitionId = '$competitionId'";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
			 die('Error: ' . mysqli_error($con));
		}
		$row = $data->fetch_object();
	  return $row->competitionName;
	}

	public function getCompNameByContactId($contactId) {
		include "config.php";
		$query = "SELECT competitionId FROM contact WHERE contactId = '$contactId'";
		$data = mysqli_query($con, $query);
	  if (!$data) {
			 die('Error: ' . mysqli_error($con));
		}
		$row = $data->fetch_object();
		$compName = new Competition();
	  return $compName->getCompName($row->competitionId);
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
	
	public function getAllAvailableDisciplines($compID) {
      include "config.php";
	
		$query = "SELECT * FROM competitiondisciplines WHERE competitionId = '$compID'";
		$data = mysqli_query($con, $query);

		if (!$data) {
		  die('Error: ' . mysqli_error($con));
		}
		
		$disc = [];
		while($row = $data->fetch_object()) {
			$disc[] = ['gren' => $row->discipline, 'klass' => $row->yearClass];
		}
		foreach ($disc as $key => $row) {
		$gren[$key]  = $row['gren'];
		$klass[$key] = $row['klass'];
		}
		
		array_multisort($klass, SORT_ASC, $gren, SORT_ASC , $disc);
		//sort($disc, SORT_REGULAR);
		//sort($disc['gren']);
		//return $disc;
		echo json_encode($disc);
		mysqli_close($con);
    }
	
	public function addAgeClass($compID, $name, $ageClass) {
      include "config.php";
		
		//kolla vilka grenar till resp ålder som redan finns i db så men inte kan lägga in dubbla...
		$query2 = "SELECT discipline FROM competitiondisciplines WHERE competitionId = '$compID' && yearClass = '$ageClass'";
		$data2 = mysqli_query($con, $query2);
		
		if (!$data2) {
		  die('Error: ' . mysqli_error($con));
		}
		
		$array=[];
		foreach ($name as $grentyp) { 
		while($row = $data2->fetch_object()){
			array_push($array, $row->discipline);
			echo 'name:  ' .$grentyp. '<br>';
			echo '$row->disc:  ' .$row->discipline. '<br>';	
		}
		
		
			if(!in_array($grentyp, $array)) {
				array_push($array, $grentyp);
				$quary = "INSERT INTO competitiondisciplines (competitionId, yearClass, discipline)
				VALUES ('$compID', '$_POST[chooseClass]', '$grentyp')";
				if (!mysqli_query($con,$quary)) {
				  die('Error: ' . mysqli_error($con));
				}
			}
		}
		mysqli_close($con);
		header("Location: createCompetitionStep2.php?compID=".$compID);
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
    public function getAllCompetitions(){
      include 'database/config.php';
      $sql = "SELECT * FROM competition WHERE 1";
      $dataCompetition = mysqli_query($con, $sql);
      $allCompetitions = [];
      while($row=$dataCompetition->fetch_object()) {
        //$allCompetitions[] = ['id' => $row->competitionId, 'name' => $row->competitionName, 'arranger' => $row->organizer, 'beginDate' => $row->date, 'lastDate' => $row->lastDate];
        
        $temp = new Competition();
        $temp->setCompetition($row -> competitionId, $row->competitionName, $row->organizer, $row->date, $row->lastDate);
        $allCompetitions[] = $temp;
        //echo $allCompetitions[0]->name;
      }
      mysqli_close($con);
      return $allCompetitions; 
    }
    public function getCompetitionByName($compName){
      
      include 'config.php';
      $sql = "SELECT * FROM competition WHERE competitionName = '$compName'";
      //$sql = "SELECT * FROM competition WHERE competitionName = 'TFC'";
      $dataCompetition = mysqli_query($con, $sql);
      $data;
      while($row=$dataCompetition->fetch_object()) {
        //$allCompetitions[] = ['id' => $row->competitionId, 'name' => $row->competitionName, 'arranger' => $row->organizer, 'beginDate' => $row->date, 'lastDate' => $row->lastDate];
        
        $temp = new Competition();
        $temp->setCompetition($row -> competitionId, $row->competitionName, $row->organizer, $row->date, $row->lastDate);
        $data = $temp;
        //echo $allCompetitions[0]->name;
      }
      return $data;
      mysqli_close($con);	
    }
    
    public function getAllAvailableDisciplines2(){
      include 'config.php';
      
      $sql = "SELECT * FROM alldisciplines WHERE 1";
      $dataDisciplines = mysqli_query($con, $sql);
      $allDisciplines = [];
      
      while($row=$dataDisciplines->fetch_object()) {
        $allDisciplines[] = ['id' => $row->disciplineId, 
        'discipline' => $row->discipline,
        ];
      }
      
      mysqli_close($con);
      return $allDisciplines;
    }
    
    ////////////////////////
  public function getEventById($id){
      include "config.php";
      $sql = "SELECT * FROM competitiondisciplines WHERE competitionId = '$id'";
      //$sql = "SELECT * FROM competitiondisciplines WHERE competitionId = 1";
      $dataEvent = mysqli_query($con, $sql);
      $data = [];
      while($row=$dataEvent->fetch_object()) {
                
                $data[] = ['competitionId' => $row->competitionId,
								'yearClass' => $row->yearClass,
                'discipline' => $row->discipline,
                ];
      }
      mysqli_close($con);	
      return $data;
      
  }
  ///////////////////////
    
}
  
  
  
  
?>

<?php
if(isset($_GET['compID']) && isset($_GET['inp'])) {

	 $compID = $_GET['compID'];
   	 $inp	= $_GET['inp'];

     $temp = new competition();
     $result = $temp->getAllDisciplines($compID, $inp);
	 echo json_encode($result);
}



if(isset($_GET['competitionId'])) {

	 $compID = $_GET['competitionId'];
     $temp = new competition();
     $result = $temp->getAllAvailableDisciplines($compID);
	 echo json_encode($result);
	 }

/*
if(isset($_GET['compName'])) {
    //include "event.php";
    $compName = $_GET['compName'];
    $temp = new competition();
    
    $result1 = $temp->getCompetitionByName($compName);
    
    //$temp2 = new Event();
    $result2 = $temp->getEventById($result1->id);
    $resultTot = array($result1, $result2);
    //$resultTot = array($result1);
    
    //echo json_encode($resultTot);
    echo json_encode($resultTot);
    
    
}
*/

?>