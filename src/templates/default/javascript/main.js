$(document).ready(function() {
  $('.expand-button').each(function(index) {
    $(this).click(function(e) {
      if ($(this).parent().hasClass('open')) {
        $(this).next().slideUp();
      } else {
        $(this).next().slideDown();
      }
      $(this).parent().toggleClass('open').toggleClass('closed');
    });
  });
  $('.toggle-button').each(function(index) {
    $(this).click(function(e) {
      var div = $(this).next('.source-listing');
      $(this).parent().toggleClass('open').toggleClass('closed');
    });
  });
});
