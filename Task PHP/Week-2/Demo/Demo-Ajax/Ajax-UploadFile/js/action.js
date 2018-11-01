$(document).ready(function() {
  var form = $('#js-form');
  var btSubmit = $('#js-btSubmit');
  var file = $('#js-file');
  var progress = $('#js-progress');
  var progressBar = $('#js-progress_bar');
  var progressPercent = $('#js-progress_percent');
  var result = $('#js-result');
  var percentValue = '0%';

  btSubmit.click(function() {
    if (file.val() == '') {
      alert('No file selected for upload');
      return false;
    } else {
      progress.css('display', 'block');
      form.ajaxForm({
        //Before uploading value in progress is 0%
        beforeSubmit: function() {
          progressBar.width(percentValue);
          progressPercent.html(percentValue);
        },

        //while uploading value in progress will increase
        uploadProgress: function(event, position, total, percentComplete) {
          var value = percentComplete + '%';
          progressBar.width(value);
          progressPercent.html(value);
        },

        //when uploading file finish value in progress is 100%
        success: function() {
          percentValue = '100%';
          progressBar.width(percentValue);
          progressPercent.html(percentValue);
        },

        //Add response text to tag <p> #result when uploading complete
        complete: function(data) {
          result.html(data.responseText);
        }
      });
    }
  });
});
