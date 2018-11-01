$(document).ready(function() {
  var arrayNumber = [6, 1, 5, 2, 8, 3];
  var button = $('#js-btClick');
  var content = $('#js-txtContent');
  var result = $('#js-result');

  content.html('Mảng số nguyên: ' + arrayNumber);

  button.click(function() {
    loadAjax(arrayNumber);
  });

  /* Function to get result from file ajax.php.
  *   @param array to get value.
  *   return none.
  * */
  function loadAjax(array) {
    $.ajax({
      url: 'ajax.php',
      method: 'POST',
      data: {'mainArray' : array},
      success: function(data) {
        result.html(data);
      }
    });
  }
});
