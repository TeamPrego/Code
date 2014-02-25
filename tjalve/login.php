<?php
include "templates/header.php";
?>	
<link rel="stylesheet" type="text/css" href="css/loginstyle.css" />
<script src="nakscript.js"></script>

<div id = "loginBody">
  <form method="post" action="/contact" id="contact-form">
    <fieldset>
      <legend>Logga in</legend>      
    
      <div>
        <label for="txt">Användarnamn</label>
        <input type="text" name="txt" id="txt" maxlength="16"/>
      </div>
        
      <div>
        <label for="psw">Lösenord</label>
        <input type="password" name="psw" id="psw" maxlength="16"/>
      </div>
        
      <div class="submit">
        <input type="submit" name="subm" id="subm" value="logga in" />
      </div>
    </fieldset>
	</form>

<?php
include "templates/footer.php";
?>