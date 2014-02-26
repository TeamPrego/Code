<!--Create competition page-->

<?php
include "templates/adminheader.php";
?>
<h1> Skapa tävling </h1>

<table class ="createComp">
		<tr>
			<td>Tävlingsnamn:</td>
			<td><input name="compName" id="compName"/></td>
			<td>Arrangör:</td>
			<td><input name="organizer" id="organizer"/></td>
		</tr>
		
		<tr>
			<td>Datum:</td>
			<td><input name="date" id="date"/></td>
			<td>Sista anmäl.dag:</td>
			<td><input name="lastDay" id="lastDay"/></td>
		</tr>
		
		<tr>
      <td>Tävlingslogga:</td>
			<td><input name="compLogo" id="compLogo"/></td>
			<td><button class="button">Bläddra</button></td>
		</tr>	
    
    <tr>
      <td>Åldersklass:</td>
			
      <td colspan="2"> Damer:	<!--<form action = "skapa_tabell.php" method="post" class="choice-bar"-->
        <select name="dropList" id="dropList">
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
         <!--<input type="submit" id="result-button"-->
    </form></td>
      
      <td> Herrar:	<!--<form action = "skapa_tabell.php" method="post" class="choice-bar"-->
        <select name="dropList" id="dropList">
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
         <!--<input type="submit" id="result-button"-->
    </form></td>
   
   
		</tr>	
</table>


<?php
include "templates/adminfooter.php";
?>