$(document).ready(function() {
  var btClick = $('#btClick');

  // Event click on button 'Click me' to get a String 'OK' by Ajax
  btClick.click(function() {
    $.ajax({
      url: 'ajax.php',
      method: 'get',
      success: function(data) {
        alert(data);
      }
    });
  });
});