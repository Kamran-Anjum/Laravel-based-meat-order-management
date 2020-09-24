$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('.dropdown-toggle').dropdown();

// add to whishlist
$('.add-to-whishlist').click(function(event){
  var ele = $(event.target);
  if(ele.hasClass('fa-heart-o'))
  {
    ele.removeClass('fa-heart-o')
    .addClass('fa-heart')
  }
  else{
    ele.addClass('fa-heart-o')
    .removeClass('fa-heart')
  }
})

// change image on color hover
// var $img = $('.img-box img'),
// dsrc = $img.attr('src');
// $('.choose-img li a').hover(function(){
//   var $this = $(this).addClass('hover');
//   $img.attr('src', $this.data('image'));
//   }, 
//   function() {
//     $(this).removeClass('hover');
//   $img.attr('src', dsrc);
//   });
                            

// change image on color hover
var $img = $('.img-box img'),
dsrc = $img.attr('src');
$('.choose-img li a').hover(function() {
  var ele = $(event.target);
  var tileDiv = ele.parent().closest('div').parent().closest('div').parent().closest('div').parent().closest('div');
  
  tileDiv.find(".product-image").attr('src', ele.data('image'));
  ele.addClass('hover');
},
function() {
  var ele = $(event.target);
  var tileDiv = ele.parent().closest('div').parent().closest('div').parent().closest('div').parent().closest('div');
  
  tileDiv.find(".product-image").attr('src', dsrc);
});
