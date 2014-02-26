function femaleDisplay()
{
var saveAge = document.getElementById("droplistFemale");
document.getElementById("age").value=saveAge.options[saveAge.selectedIndex].text;
}