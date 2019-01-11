
document.getElementById("planning-0").style.display = "block";

function buttonClick(el){
  var tables = document.getElementsByClassName("table");
  for (var i = 0; i < tables.length; i++) {
    tables[i].style.display = "none";
  }
  var id = el.id;
  
  document.getElementById(id).style.display = "block";
}
