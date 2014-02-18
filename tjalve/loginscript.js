window.onload=function()
{
document.getElementById("ancor").onclick=popup;
document.getElementById("btn").onclick=pushdown;
};

function popup()
{
document.getElementById("wrapper").style.display="block";
}

function pushdown()
{
document.getElementById("wrapper").style.display="none";
}