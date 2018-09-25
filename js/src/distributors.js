$(document).ready(function() {
  $('.distributor .type .premium').hover(function() {
    $(this).siblings('#current').text($(this).text())
  }, function() {
    $(this).siblings('#current').text('');
  });
  $('.distributor .type .exclusive').hover(function() {
    $(this).siblings('#current').text($(this).text())
  }, function() {
    $(this).siblings('#current').text('');
  });
  $('.distributor .product-links .product').hover(function() {
    $(this).closest('.product-links').find('#current').text($(this).text())
  }, function() {
    $(this).closest('.product-links').find('#current').text('');
  });
});
