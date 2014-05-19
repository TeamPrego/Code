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
  class Competition {
  
  public $id;
  public $name;
  public $organizer;
  public $dateFrom;
  public $dateTo;
  public $lastDate;
  public $logo;
  
	public function __construct(){
  }
  
  public function setCompetition($compId, $compName, $compOrganizer, $compDateFrom, $compDateTo, $compLastDate, $compLogo){
    $this -> id = $compId;
    $this -> name = $compName;
    $this -> organizer = $compOrganizer;
    $this -> dateFrom = $compDateFrom;
    $this -> dateTo = $compDateTo;
    $this -> lastDate = $compLastDate;
    $this -> logo = $compLogo;
  }
  
  //Function that sends a new competition to the database
  //gets input from for the competition. A lot of the code is for
  //being able to upload image
  public function pushToDB($name, $arranger, $beginDate, $endDate, $lastDate){
  include "config.php";
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

      mysqli_close($con);

	  header("Location: createCompetitionStep2.php?compID=".$row->competitionId);
    }
	/*
    Id as argument. Gets competitions from database and
    
  */
	
  public function updateCompetition($id, $name, $date, $lastDate, $organizer){
  include "config.php";
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

  public function updateCompetitionLogo($id, $logo){
    include "config.php";
    $sql = "UPDATE  competition SET  logo =  '$logo' WHERE  competitionId = '$id'";
    if (!mysqli_query($con,$sql)) {
			  die('Error: ' . mysqli_error($con));
		}
    mysqli_close($con);
  }
  
	public function getAllYearClasses() {
	  include "config.php";
    $query = "SELECT * FROM allyearclasses WHERE 1";
	  $data = mysqli_query($con, $query);
	  if (!$data) {
		  die('Error: ' . mysqli_error($con));
		}
		$array=array();
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
	$query = "SELECT disciplineId
				FROM allDisciplines";
	
	$data = mysqli_query($con, $query);
		
		if (!$data) {
		  die('Error: ' . mysqli_error($con));
		}
		
		$query2 = "SELECT disciplineId
				FROM competitiondisciplines WHERE yearClass = '$inp' && competitionId = '$compID'";
	
		$data2 = mysqli_query($con, $query2);
		
		if (!$data2) {
		  die('Error: ' . mysqli_error($con));
		}
		
		$allId=array();
		while($row = $data->fetch_object()){
		$allId[] = $row->disciplineId;
		}
		
		$chosenId=array();
		while($row = $data2->fetch_object()){
		$chosenId[] = $row->disciplineId;
		}
		
		if(isset($chosenId)){
			$result = array_diff($allId, $chosenId);
		}
		else{
			$result = $allId;
		}
		$leftoverDisciplineNames=array();
		
		if(isset($result)){
			foreach($result as $key){
				$query3 = "SELECT discipline
				FROM allDisciplines WHERE disciplineId = '$key'";
			
			$data3 = mysqli_query($con, $query3);
			
			if (!$data3) {
			  die('Error: ' . mysqli_error($con));
			}
			
			while($row = $data3->fetch_object()){
			$leftoverDisciplineNames[] = $row->discipline;
			}
			}
		}

		return $leftoverDisciplineNames;
		mysqli_close($con);
    }
	
	public function getAllAvailableDisciplines($compID) {
  
	  include "config.php";
	  $query = "SELECT allDisciplines.discipline, competitiondisciplines.yearClass, allDisciplines.disciplineId
		FROM allDisciplines, competitiondisciplines 
		WHERE allDisciplines.disciplineId = competitiondisciplines.disciplineId AND competitiondisciplines.competitionId = '$compID'";
		$data = mysqli_query($con, $query);
		
		if (!$data) {
		  die('Error: ' . mysqli_error($con));
		}
		
		$nameOfDisciplines=array();
		while($row = $data->fetch_object()){
		$nameOfDisciplines[] = ['klass' => $row->yearClass,'gren' => $row->discipline, 'Id' => $row->disciplineId];
		}
		
		//ej sorterad!! hur göra? sortera först på åldersklass på samma sätt som i db och sen sorterad på gren också på samma sätt som i db...

		echo json_encode($nameOfDisciplines);
		mysqli_close($con);
  }
	//sjukt bra o snyggt sätt att skriva ut arrayer 
	//echo '<pre>'; print_r($nameOfDisciplines); echo '<pre/>';
	
	public function addAgeClass($compID, $gren, $ageClass) {
  
	include "config.php";
	  foreach($gren as $key){
		$query = "INSERT INTO competitiondisciplines(competitionId, yearClass, disciplineId)
			 VALUES ('$compID', '$_POST[chooseClass]', (SELECT disciplineId
				FROM allDisciplines
				WHERE discipline = '$key'))";
				
				$data = mysqli_query($con, $query);
		
				if (!$data) {
				  die('Error: ' . mysqli_error($con));
				}
		}
		
		mysqli_close($con);
		header("Location: createCompetitionStep2.php?compID=".$compID);
    }
	
    public function deleteDiscipline($compID, $grenId, $class) {
      include "config.php";
	
		$sql = "DELETE FROM competitiondisciplines WHERE competitionId = $compID && yearClass = '$class' && disciplineId = '$grenId'";


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
        $temp = new Competition();
        $temp->setCompetition($row->competitionId, $row->competitionName, $row->dateFrom, $row->dateTo, $row->lastDate, $row->organizer, $row->logo);
        $array[] = $temp;
        
      }
      mysqli_close($con);
      //echo'<pre>'; print_r($array); echo '<pre/>';
      return $array;
    }

    public function getCompetitionByName($compName){
      include 'config.php';
      $sql = "SELECT * FROM competition WHERE competitionName = '$compName'";
      $dataCompetition = mysqli_query($con, $sql);
      $data;
      while($row=$dataCompetition->fetch_object()) {

        $temp = new Competition();
        $temp->setCompetition($row->competitionId, $row->competitionName, $row->organizer, $row->dateFrom, $row->dateTo, $row->lastDate, $row->logo);
        $data = $temp;

      }
      return $data;
      mysqli_close($con);	
    }

    public function toArray() {
    	$array = 	[	'competitionId' 				=>	$this->id,
    							'competitionName' 			=> 	$this->name,
    							'competitionOrganizer' 	=> 	$this->organizer,
    							'competitionDateFrom' 			=> 	$this->dateFrom,
    							'competitionDateTo' 			=> 	$this->dateTo,
    							'competitionLastDate' 	=> 	$this->lastDate,
    							'competitionLogo' 			=> 	$this->logo,
    						];
    	return $array;
    }


    /*public function getAllAvailableDisciplines(){*/

  public function getAllAvailableDisciplines2(){

    include 'config.php';
    
    $sql = "SELECT * FROM alldisciplines WHERE 1";
    $dataDisciplines = mysqli_query($con, $sql);
    $allDisciplines = [];
    
    while($row=$dataDisciplines->fetch_object()) {
      $allDisciplines[] = [	'id' 					=> $row->disciplineId, 
      											'discipline' 	=> $row->discipline];
    }
    
    mysqli_close($con);
    return $allDisciplines;
  }


  public function getEventById($id){
      include "config.php";
      $sql = "SELECT * FROM competitiondisciplines WHERE competitionId = '$id'";
      $dataEvent = mysqli_query($con, $sql);
      $data = [];
      while($row=$dataEvent->fetch_object()) {
                $data[] = [	'competitionId' => $row->competitionId,
														'yearClass' => $row->yearClass,
						                'discipline' => $row->discipline];
      }
      mysqli_close($con);	
      return $data;
  }

}// End of class


	// Check which competitionid belongs to a contact id.
	// Input: Contact Id
	// Return: Competition Id
	function getCompetitionIdFromContactId($contactId) {
		include "config.php";
    $competitionId = mysqli_query($con, "SELECT competitionId FROM contact WHERE contactId = '$contactId'");
    mysqli_close($con);	
		return $competitionId->fetch_object()->competitionId;
	}

	// Gets all Classes from one competition
	// Input: CompetitionId
	// Output: An array with all classes
	function getAllClassesFromCompetition($competitionId) {
		include "config.php";
		$data = mysqli_query($con, "SELECT * FROM competitiondisciplines WHERE competitionId= '$competitionId'");
		$array=array();
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
		$data = mysqli_query($con, "SELECT a.*
																FROM alldisciplines a
																INNER JOIN competitiondisciplines cd ON a.disciplineId = cd.disciplineId
																WHERE cd.competitionId = $competitionId");
		$array=array();
		while($row = $data->fetch_object()) {
			if(!in_array($row->disciplineId, $array)) {
				array_push($array, $row->disciplineId);
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
		$disc =array();

		//Findning all classes and dicipilnes
		$dataAgeClass = mysqli_query($con, "SELECT * FROM competitiondisciplines WHERE competitionId = '$competitionId'
																				ORDER BY  `competitiondisciplines`.`yearClass` ASC ");
		if (!$dataAgeClass) {
		  die('Error: ' . mysqli_error($con));
		}

		while($rowAgeClass = $dataAgeClass->fetch_object()) {
			$rawDiscipline = getDisciplineByDisciplineId($rowAgeClass->disciplineId);
			if(	($yearClass == "Alla" 									&& $discipline == "Alla") 	||
					($rowAgeClass->yearClass == $yearClass 	&& $discipline == "Alla") 	||
					($rawDiscipline == $discipline 					&& $yearClass == "Alla") 	||
					($rawDiscipline == $discipline 					&& $rowAgeClass->yearClass === $yearClass)) {
				
				$participants = [];
				$query = "SELECT p.*, c.*, pd.*, cd.*, ad.*
									FROM alldisciplines ad
									INNER JOIN competitiondisciplines cd	ON ad.disciplineId = cd.disciplineId
									INNER JOIN participantdisciplines pd 	ON cd.competitionDisciplineId = pd.competitionDisciplineId
									INNER JOIN participant p 							ON pd.participantId = p.participantId
									INNER JOIN contact c 									ON p.contactId = c.contactId
									INNER JOIN competition comp 					ON c.competitionId = comp.competitionId
									WHERE comp.competitionId = '$competitionId'";
			  $dataDiscipline = mysqli_query($con, $query);
			  $theDiscipline="";

				if (!$dataDiscipline) {
				  die('Error: ' . mysqli_error($con));
				}
				
				while($rowDiscipline = $dataDiscipline->fetch_object()) {
					if($rowDiscipline->competitionDisciplineId == $rowAgeClass->competitionDisciplineId) {
						$participants[] = [	'firstName'	=> $rowDiscipline->firstName,
																'lastName' 	=> $rowDiscipline->lastName,
																'club' 			=> getClub($rowDiscipline->clubId)['club'],
																'prio' 			=> $rowDiscipline->prio,
																'SB'				=> $rowDiscipline->SB,
																'PB'				=> $rowDiscipline->PB,
																'birthYear'	=> $rowDiscipline->birthYear];
						$theDiscipline = $rowDiscipline->discipline;
					}
				}
				if($participants != null) {
					$disc[] = [ 'className' 		=> $rowAgeClass->yearClass,
											'discipline' 		=> $theDiscipline,
											'participants' 	=> $participants];
				}
			}
		}
		return $disc;
	}

	// Gets all competition
	// Input: Nothing
	// Output: All competitions in an array
	function getAllCompetitionsToArray() {
	  include 'config.php';
	  $sql = "SELECT * FROM competition";
	  $dataCompetition = mysqli_query($con, $sql);
	  $array = [];
	  while($row=$dataCompetition->fetch_object()) {      
	  	$array[] = 	[	'competitionId' 				=>	$row->competitionId,
										'competitionName' 			=> 	$row->competitionName,
										'competitionOrganizer' 	=> 	$row->organizer,
										'competitionDateFrom' 	=> 	$row->dateFrom,
                    'competitionDateTo' 		=> 	$row->dateTo,
										'competitionLastDate' 	=> 	$row->lastDate,
                    'competitionLogo' 			=> 	$row->logo];
	  }
	  mysqli_close($con);
	  return $array;
	}

	//Gets all classes for competition with competition id
	//Input: Competition Id
	//Output: Array with all year classes
	function getYearClassesByCompId($cId){
		include "config.php";

		$query = "SELECT * FROM competitiondisciplines WHERE competitionId = '$cId'";
		$data = mysqli_query($con, $query);

		if (!$data) {
			  die('Error: ' . mysqli_error($con));
		}

		$array=array();
		while($row = $data->fetch_object()) {
			if (!in_array($row->yearClass, $array)){
					array_push($array, $row->yearClass);
			}
		}
		return $array;
	}

?>

