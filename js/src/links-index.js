$(document).ready(function() {
  fn = function() {
    var prevTop = 0;
    $("a", $(".inner-links")).each(function() {
      var link = $(this);
      var top = link.offset().top;
      if (top == prevTop) {
        link.attr("class", "border");
      } else { // new line
        prevTop = top;
        link.removeClass("border"); // in case 'border' was previously added
      }
    });
  };
  $(window).resize(fn);
  fn();
});