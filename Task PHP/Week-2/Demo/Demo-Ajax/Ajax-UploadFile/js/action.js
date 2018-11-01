$(document).ready(function() {
  var form = $('#js-form');
  var btSubmit = $('#js-btSubmit');
  var file = $('#js-file');
  var progress = $('#js-progress');
  var progressBar = $('#js-progress_bar');
  var progressPercent = $('#js-progress_percent');
  var result = $('#js-result');
  var percentValue = 0;

  btSubmit.click(function() {
    if (file.val() == '') {
      progress.css('display', 'block');
      progressBar.css('width', '100px');
      progressPercent.html('100%');
      alert('No file selected for upload');
    } else {
      //form.attr('onsubmit','return processForm(this)');
      form.ajaxForm({
        //Before uploading value in progress is 0%
        beforeSubmit: function() {
          result.empty();
          percentValue = "0%";
          progressBar.width = percentValue;
          progressPercent.html(percentValue);
        },

        //while uploading value in progress increase
        uploadProgress: function(event, position, total, percentComplete) {
          var percentValue = percentComplete + '%';
          progressbar.width(percentValue);
          percent.html(percentValue);
        },

        //when uploading file finish value in progress is 100%
        success: function() {
          var percentValue = '100%';
          progressbar.width(percentValue);
          percent.html(percentValue);
        },

        //Add response text to div #result when uploading complete
        complete: function(xhr) {
          result.html(xhr.responseText);
        }
      });
    }
  });
});
