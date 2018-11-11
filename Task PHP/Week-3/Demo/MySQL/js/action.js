$(document).ready(function() {
  var btnShow = $('#js-btn-show');
  var listUsers = $('#js-users');

  btnShow.click(function() {
    listUsers.css('display', 'block');
    $.ajax({
      url: 'controllers/UserController.php',
      method: 'get',
      data: 'show',
      success: function(data) {
        listUsers.html(data);
      }
    });
  });
});