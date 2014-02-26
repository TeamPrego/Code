function femaleDisplay()
{
var saveAge = document.getElementById("droplistFemale");
document.getElementById("age").value=saveAge.options[saveAge.selectedIndex].text;
}

function maleDisplay()
{
var saveAge = document.getElementById("droplistMale");
document.getElementById("age").value=saveAge.options[saveAge.selectedIndex].text;
}