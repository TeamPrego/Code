

<?php

if(isset($_GET['competitionId'])) {

	 $compID = $_GET['competitionId'];
     $temp = new competition();
     $result = $temp->getAllAvailableDisciplines($compID);
	 echo json_encode($result);
	 }

if(isset($_GET['compName'])) {
 
	 $compName = $_GET['compName'];
     $temp = new competition();
     $result = $temp->getCompetitionByName($compName);
     /*$result = ['competitionId' => "1",
								'competitionName' => "Flonks",
                'date' => "2014",
                'lastDate' => "2014",
                'organizer' => "Jag",
                ];*/
    echo json_encode($result);
    //echo $compName;
    //echo "DOPE!";
}
?>
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
	
  //public function updateCompetition($id, $name, $date, $lastDate, $organizer){
  public function updateCompetition($id, $name, $date, $lastDate, $organizer){
    include "config.php";
    //$sql = "UPDATE  `competition` SET  `competitionName` =  STRUT,`date` =  '$date',`lastDate` =  '$lastDate',`organizer` =  '$organizer',`logo` =  '' WHERE  `competition`.`competitionId` = '$id'";
    $sql = "UPDATE  competition SET  competitionName =  '$name', date = '$date', lastDate='$lastDate', organizer='$organizer' WHERE  competitionId = '$id'";
    if (!mysqli_query($con,$sql)) {
			  die('Error: ' . mysqli_error($con));
		}
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
	  
	  /*$query = "SELECT discipline
	  FROM allDisciplines
	   JOIN competitiondisciplines ON allDisciplines.disciplineId != competitiondisciplines.disciplineId
	  WHERE competitiondisciplines.yearClass = '$inp' && 
			competitiondisciplines.competitionId = '$compID'";*/
			
		//nåt på g kanske?? annars är det den över som gäller om detta inte funkar då får jag jobba vidare på den övre...	
	$query = "SELECT discipline
				FROM allDisciplines
				WHERE disciplineId != (disciplineId FROM competitiondisciplines WHERE yearClass = '$inp' && competitionId = '$compID')";
	
			
	  
		$data = mysqli_query($con, $query);
		
		if (!$data) {
		  die('Error: ' . mysqli_error($con));
		}
		
		$nameOfDisciplines=[];
		while($row = $data->fetch_object()){
		echo $row->discipline. "<br>";
		$nameOfDisciplines[] = ['gren' => $row->discipline];
		}
		
		return $nameOfDisciplines;
		mysqli_close($con);
    }
	
	public function getAllAvailableDisciplines($compID) {
      include "config.php";
	  
	  $query = "SELECT allDisciplines.discipline, competitiondisciplines.yearClass
		FROM allDisciplines, competitiondisciplines 
		WHERE allDisciplines.disciplineId = competitiondisciplines.disciplineId AND competitiondisciplines.competitionId = '$compID'";
		
		/*$query = "SELECT family.Position, food.Meal ".
 "FROM family, food ".
	"WHERE family.Position = food.Position";*/
		
    include "config.php";
	
		$query = "SELECT * FROM competitiondisciplines WHERE competitionId = '$compID'";
		$data = mysqli_query($con, $query);
		
		if (!$data) {
		  die('Error: ' . mysqli_error($con));
		}
		
		$nameOfDisciplines=[];
		while($row = $data->fetch_object()){
		$nameOfDisciplines[] = ['klass' => $row->yearClass,'gren' => $row->discipline];
		}
		
		echo json_encode($nameOfDisciplines);
		mysqli_close($con);
  }
	
	
	public function addAgeClass($compID, $gren, $ageClass) {
      include "config.php";
		$query = "INSERT INTO competitiondisciplines(competitionId, yearClass, disciplineId)
			 VALUES ('$compID', '$_POST[chooseClass]', (SELECT disciplineId
				FROM allDisciplines
				WHERE discipline = '$gren'))";
				if (!mysqli_query($con,$quary)) {
				  die('Error: ' . mysqli_error($con));
				}
		
		mysqli_close($con);
		header("Location: createCompetitionStep2.php?compID=".$compID);
		//kolla vilka grenar till resp ålder som redan finns i db så men inte kan lägga in dubbla...
		/*$query2 = "SELECT discipline FROM competitiondisciplines WHERE competitionId = '$compID' && yearClass = '$ageClass'";
		$data2 = mysqli_query($con, $query2);
		
		if (!$data2) {
		  die('Error: ' . mysqli_error($con));
		}
		
		$array=[];
		foreach ($Id as $grenId) { 
		while($row = $data2->fetch_object()){
			array_push($array, $row->disciplineId);
			echo 'Id:  ' .$grenId. '<br>';
			echo '$row->disc:  ' .$row->disciplineId. '<br>';	
		}
		
		
			if(!in_array($grentyp, $array)) {
				array_push($array, $grentyp);
				$quary = "INSERT INTO competitiondisciplines (competitionId, yearClass, disciplineId)
				VALUES ('$compID', '$_POST[chooseClass]', '$grenId')";
				if (!mysqli_query($con,$quary)) {
				  die('Error: ' . mysqli_error($con));
				}
			}
		}
		mysqli_close($con);
		header("Location: createCompetitionStep2.php?compID=".$compID);*/
    }
	
    public function deleteDiscipline($compID, $gren, $class) {
      include "config.php";
	
		$sql = "DELETE FROM competitiondisciplines WHERE competitionId = $compID && yearClass = '$class' && disciplineId = '$gren'";

			if (!mysqli_query($con,$sql)) {
			  die('Error: ' . mysqli_error($con));
			}
			mysqli_close($con);
		header("Location: ../createCompetitionStep2.php?compID=".$compID);
    }
	
	/*public function getDisciplineNameById($disciplineId) {
      include "config.php";
	  $query = "SELECT discipline FROM competitiondisciplines WHERE disciplineId = '$disciplineId'";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
		  die('Error: ' . mysqli_error($con));
		}
		$row = $data->fetch_object();
	  return $row;
    }*/
	
	
	
	
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
      include 'config.php';
      $sql = "SELECT * FROM competition";
      $dataCompetition = mysqli_query($con, $sql);
      $array = [];
      while($row=$dataCompetition->fetch_object()) {      
	    	$array[] = 	[	'competitionId' 				=>	$row->competitionId,
											'competitionName' 			=> 	$row->competitionName,
											'competitionOrganizer' 	=> 	$row->organizer,
											'competitionDate' 			=> 	$row->date,
											'competitionLastDate' 	=> 	$row->lastDate];
											/*
         	Ska helst inte skicka tillbaka en array med tävlingar till "vanlig kod" då man ska inte komma åt variablerna i koden
						Bättre att skicka tillbaka en array med keys.
        $temp = new Competition();
        $temp->setCompetition($row->competitionId, $row->competitionName, $row->organizer, $row->date, $row->lastDate);
        $array[] = $temp;*/
      }
      mysqli_close($con);
      return $array;
    }

    public function getCompetitionByName($compName){
      
      include 'config.php';
      $sql = "SELECT * FROM competition WHERE competitionName = '$compName'";
      //$sql = "SELECT * FROM competition WHERE competitionName = 'TFC'";
      $dataCompetition = mysqli_query($con, $sql);
      $data;
      while($row=$dataCompetition->fetch_object()) {

                $data = ['competitionId' => $row->competitionId,
						'competitionName' => $row->competitionName,
					'date' => $row->date,
					'lastDate' => $row->lastDate,
					'organizer' => $row->organizer,
					];

        //$allCompetitions[] = ['id' => $row->competitionId, 'name' => $row->competitionName, 'arranger' => $row->organizer, 'beginDate' => $row->date, 'lastDate' => $row->lastDate];
        
        $temp = new Competition();
        $temp->setCompetition($row->competitionId, $row->competitionName, $row->organizer, $row->date, $row->lastDate);
        $data = $temp;
        //echo $allCompetitions[0]->name;

      }
      return $data;
      mysqli_close($con);	
    }

    public function toArray() {
    	$array = 	[	'competitionId' 				=>	$this->id,
    							'competitionName' 			=> 	$this->name,
    							'competitionOrganizer' 	=> 	$this->organizer,
    							'competitionDate' 			=> 	$this->date,
    							'competitionLastDate' 	=> 	$this->lastDate,
    						];
    	return $array;
    }
    
    

    /*public function getAllAvailableDisciplines(){

    public function getAllAvailableDisciplines2(){
>>>>>>> 4ac828a223f28067dc989e9a905fde21abdcffee
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
<<<<<<< HEAD
    }*/
 }


    
    
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
} 
	// Check which competitionid belongs to a contact id.
	// Input: Contact Id
	// Return: Competition Id
	function getCompetitionIdFromContactId($contactId) {
		include "config.php";
    $competitionId = mysqli_query($con, "SELECT competitionId FROM contact WHERE contactId = '$contactId'");
    mysqli_close($con);	
		return $competitionId = $competitionId->fetch_object()->competitionId;
	}

	// Gets all Classes from one competition
	// Input: CompetitionId
	// Output: An array with all classes
	function getAllClassesFromCompetition($competitionId) {
		include "config.php";
		$data = mysqli_query($con, "SELECT * FROM competitiondisciplines WHERE competitionId= '$competitionId'");
		$array=[];
		while($row = $data->fetch_object()) {
			if(!in_array($row->yearClass, $array)) {
				array_push($array, $row->yearClass);
			}
		}
		mysqli_close($con);	
		return $array;
	}

	// Gets all disciplines from one competition
	// Input: CompetitionId
	// Output: An array with all disciplines
	function getAllDisciplinesFromCompetition($competitionId) {
		include "config.php";
		$data = mysqli_query($con, "SELECT * FROM competitiondisciplines WHERE competitionId= '$competitionId'");
		$array=[];
		while($row = $data->fetch_object()) {
			if(!in_array($row->discipline, $array)) {
				array_push($array, $row->discipline);
			}
		}
		mysqli_close($con);	
		return $array;
	}
	// Gets all participants to the startlist
	// Input: CompetitionId, yearClass and Discipline
	// Output: Array with a lot of information about the
	function getStartlist($competitionId, $yearClass, $discipline) {
		include "config.php";
		$disc =[];
		//Findning all classes and dicipilnes
		$dataAgeClass = mysqli_query($con, "SELECT * FROM competitiondisciplines WHERE competitionId = '$competitionId'");
		if (!$dataAgeClass) {
		  die('Error: ' . mysqli_error($con));
		}

		while($rowAgeClass = $dataAgeClass->fetch_object()) {
			if(($yearClass === "Alla" && $discipline === "Alla") ||
			($rowAgeClass->yearClass === $yearClass && $discipline === "Alla") ||
			($rowAgeClass->discipline === $discipline && $yearClass === "Alla") ||
			($rowAgeClass->discipline === $discipline && $rowAgeClass->yearClass === $yearClass)) {
				$participants = [];
				$query = "SELECT p.*, c.*, pd.*
		              FROM participantdisciplines pd
		              INNER JOIN participant p ON pd.participantId = p.participantId
		              INNER JOIN contact c ON p.contactId = c.contactId
		              INNER JOIN competition comp ON c.competitionId = comp.competitionId
		              WHERE comp.competitionId = '$competitionId'";
			  $dataDiscipline = mysqli_query($con, $query);

				if (!$dataDiscipline) {
				  die('Error: ' . mysqli_error($con));
				}
				while($rowDiscipline = $dataDiscipline->fetch_object()){
					if($rowDiscipline->yearClass === $rowAgeClass->yearClass && $rowDiscipline->discipline === $rowAgeClass->discipline)
						$participants[] = [	'firstName'	=> $rowDiscipline->firstName,
																'lastName' 	=> $rowDiscipline->lastName,
																'club' 			=> $rowDiscipline->clubId,
																'prio' 			=> $rowDiscipline->prio];
				}
				if($participants != null) {
					$disc[] = [ 'className' 		=> $rowAgeClass->yearClass,
											'discipline' 		=> $rowAgeClass->discipline,
											'participants' 	=> $participants];
				}
			}
		}
		return $disc;
	}
?>



<?php
/*
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
*/

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

