
function myFunction(el) {
  var x = el.value

  // If the pressed keyboard button is "a" or "A" (using caps lock or shift), alert some text.
  if(x=="fun"){
    document.getElementById("fun").classList.remove("hide");
  }
}
