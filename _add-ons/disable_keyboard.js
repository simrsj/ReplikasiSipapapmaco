$(window).on("keydown", function (event) {
  if (event.keyCode == 123) {
    // alert('Entered F12');
    return false;
  } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
    // alert('Entered ctrl+shift+i')
    return false; //Prevent from ctrl+shift+i
  } else if (event.ctrlKey && event.keyCode == 73) {
    // alert('Entered ctrl+shift+i')
    return false; //Prevent from ctrl+shift+i
  }
});
$(document).on("contextmenu", function (e) {
  // alert('Right Click Not Allowed')
  e.preventDefault();
});
