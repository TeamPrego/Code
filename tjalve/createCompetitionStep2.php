<!--Create competition page-->
<!--Granskad och godkänd 2014-03-04-->
<?php
include "templates/adminheader.php";
?>

<div id="comp">
		<?php
		include "database/getCompetition.php";
		
		//include "database/getCompetitionIcon.php";
		?>
</div>

<h1> "sätt in tävlingens namn här från createCompetition </h1>

visa bilden som laddades upp på tidiagre sidan 
visa även datum, anmälningsdatum och liknande så men kan se att man har fyllt i rätt.


Välj åldesklass och resp. gren här:

<table class ="createcompTable">
      <td>Åldersklass:</td>
	  
      <td colspan="2"> 
        Damer:	<!--<form action = "skapa_tabell.php" method="post" class="choice-bar"-->
          <select id="droplistFemale" onchange="femaleDisplay()">
            <option value="empty"></option>
            <option value="f7">F7</option>
            <option value="f8">F8</option>
            <option value="f9">F9</option>
            <option value="f10">F10</option>
            <option value="f11">F11</option>
            <option value="f12">F12</option>
            <option value="f13">F13</option>
            <option value="f14">F14</option>
            <option value="f15">F15</option>
            <option value="f17">F17</option>
            <option value="k">K</option>
          </select>

        Herrar:	
          <select id="droplistMale" onchange="maleDisplay()">
            <option></option>
            <option value="p7">P7</option>
            <option value="p8">P8</option>
            <option value="p9">P9</option>
            <option value="p10">P10</option>
            <option value="p11">P11</option>
            <option value="p12">P12</option>
            <option value="p13">P13</option>
            <option value="p14">P14</option>
            <option value="p15">P15</option>
            <option value="p17">P17</option>
            <option value="h">H</option>
          </select>
		  </td>
      </td>
    <script src="createCompetition.js"></script>
	</tr>	
</table>

<div id ="chosenAge">Vald ålderssdsklass: <input type="text" id="age" size="4" disabled style="color:black"></input></div>

<table class ="createcompTable">
  <tr>
    <td>
	textfälten måste anpassa sig efter storleken på fönstret de gör dem inte just nu!!!
      Valbara grenar
    </td>
    <td>
      Valda grenar
  </tr>
  <tr>
    <td>
      <textarea rows="4" cols="50"><?php include "database/getAllDisciplines.php"; ?></textarea>
    </td>
    <td>
      <textarea rows="4" cols="50">Textarea2</textarea>
    </td>
  </tr>
</table>

<?php
include "templates/adminfooter.php";
?>