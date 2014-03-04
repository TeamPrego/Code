<?php
include "templates/header.php";
?>	
<!--Granskad och godkänd 2014-03-04-->
<link rel="stylesheet" href="css/loginstyle.css"></link>

<div id = "loginBody">
  <form method="post" action="/contact" id="contact-form">
    <fieldset>
      <legend>Logga in</legend>      
    
      <div>
        <label for="txt">Användarnamn</label>
        <input type="text" name="txt" id="txt" maxlength="16"></input>
      </div>
        
      <div>
        <label for="psw">Lösenord</label>
        <input type="password" name="psw" id="psw" maxlength="16"></input>
      </div>
        
      <div class="submit">
        <input type="submit" name="subm" id="subm" value="logga in"></input>
      </div>
    </fieldset>
	</form>

<?php
include "templates/footer.php";
?>