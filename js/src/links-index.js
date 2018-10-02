$(document).ready(function() {
  $(window).resize(function() {
    var prevTop = 0;
    $("a", $(".inner-links")).each(function() {
      var link = $(this);
      var top = link.offset().top;
      if (top == prevTop) {
        link.attr("class", "border");
      } else {
        prevTop = top;
        link.removeClass("border");
      }
    });
  });
  $(window).resize();
});
