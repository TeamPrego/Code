/*Granskad och godkänd 2014-03-04*/
function femaleDisplay() {
  var saveAge = document.getElementById("droplistFemale");
  document.getElementById("age").value=saveAge.options[saveAge.selectedIndex].text;
  document.getElementById("droplistFemale").value = "empty";
}

function maleDisplay() {
  var saveAge = document.getElementById("droplistMale");
  document.getElementById("age").value=saveAge.options[saveAge.selectedIndex].text;
  document.getElementById("droplistMale").value = "empty";
}