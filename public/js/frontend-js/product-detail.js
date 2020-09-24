$(function(){
   $(".details-toggle").click(function () {
      $(this).find(".edit-toggle").text(function(i, text){
          return text === "CHANGE" ? "CLOSE" : "CHANGE";
      })
   });
    $("#accordion").accordion({ header: "h5", collapsible: true, active: false });
}); 

(function ($) {
    $(document).ready(function() {
        $('.xzoom, .xzoom-gallery').xzoom({zoomWidth: 400, title: true, tint: '#333', Xoffset: 15});

        //Integration with hammer.js
        var isTouchSupported = 'ontouchstart' in window;

        if (isTouchSupported) {
            //If touch device
            $('.xzoom').each(function(){
                var xzoom = $(this).data('xzoom');
                xzoom.eventunbind();
            });

            $('.xzoom').each(function() {
                var xzoom = $(this).data('xzoom');
                $(this).hammer().on("tap", function(event) {
                    event.pageX = event.gesture.center.pageX;
                    event.pageY = event.gesture.center.pageY;
                    var s = 1, ls;

                    xzoom.eventmove = function(element) {
                        element.hammer().on('drag', function(event) {
                            event.pageX = event.gesture.center.pageX;
                            event.pageY = event.gesture.center.pageY;
                            xzoom.movezoom(event);
                            event.gesture.preventDefault();
                        });
                    }

                    xzoom.eventleave = function(element) {
                        element.hammer().on('tap', function(event) {
                            xzoom.closezoom();
                        });
                    }
                    xzoom.openzoom(event);
                });
            });
        } else {
            //If not touch device

            //Integration with fancybox plugin
            $('#xzoom-fancy').bind('click', function(event) {
                var xzoom = $(this).data('xzoom');
                xzoom.closezoom();
                $.fancybox.open(xzoom.gallery().cgallery, {padding: 0, helpers: {overlay: {locked: false}}});
                event.preventDefault();
            });

            //Integration with magnific popup plugin
            $('#xzoom-magnific').bind('click', function(event) {
                var xzoom = $(this).data('xzoom');
                xzoom.closezoom();
                var gallery = xzoom.gallery().cgallery;
                var i, images = new Array();
                for (i in gallery) {
                    images[i] = {src: gallery[i]};
                }
                $.magnificPopup.open({items: images, type:'image', gallery: {enabled: true}});
                event.preventDefault();
            });
        }
    }); 
})(jQuery);

function imgg(id) { 
        console.log(id);
        $("#imggf").attr("value",id);
    }
function gfpr(price){
    //console.log(price);
   document.getElementById("amnt").value= price;
   //$("#amnt").attr("value",price);
}

    function changeProduct(){
    var base_url = window.location.origin;
    var radio = $('input[name=product-color]:checked').val();

    if (radio == 'monument')
    {   $("#thumb-link").attr("href",base_url+'/images/frontend-images/shirt-monument.jpg');
        $("#preview").attr("src",base_url+'/images/frontend-images/preview/shirt-monument.jpg');
        $("#preview").attr("xoriginal",base_url+'/images/frontend-images/shirt-monument.jpg');
        $("#thumbnail").attr("src",base_url+'/images/frontend-images/thumbs/shirt-monument.jpg');
        $("#thumbnail").attr("xpreview",base_url+'/images/frontend-images/preview/shirt-monument.jpg');
        $(".selected-color").text(radio);
    }

    else if (radio == 'pinegreen')
    {   $("#thumb-link").attr("href",base_url+'/images/frontend-images/shirt-pinegreen.jpg');
        $("#preview").attr("src",base_url+'/images/frontend-images/preview/shirt-pinegreen.jpg');
        $("#preview").attr("xoriginal",base_url+'/images/frontend-images/shirt-pinegreen.jpg');
        $("#thumbnail").attr("src",base_url+'/images/frontend-images/thumbs/shirt-pinegreen.jpg');
        $("#thumbnail").attr("xpreview",base_url+'/images/frontend-images/preview/shirt-pinegreen.jpg');
        $(".selected-color").text(radio);
    }
    // else if (radio == 'pinegreen')
    // {   $("#thumb-link").attr("href","../images/frontend-images/shirt-pinegreen.jpg");
    //     $("#preview").attr("src","../images/frontend-images/preview/shirt-pinegreen.jpg");
    //     $("#preview").attr("xoriginal","../images/frontend-images/shirt-pinegreen.jpg");
    //     $("#thumbnail").attr("src","../images/frontend-images/thumbs/shirt-pinegreen.jpg");
    //     $("#thumbnail").attr("xpreview","../images/frontend-images/preview/shirt-pinegreen.jpg");
    //     $(".selected-color").text(radio);
    // }

    else if (radio == 'dustblue')
    {   $("#thumb-link").attr("href",base_url+'/images/frontend-images/shirt-dustblue.jpg');
        $("#preview").attr("src",base_url+'/images/frontend-images/preview/shirt-dustblue.jpg');
        $("#preview").attr("xoriginal",base_url+'/images/frontend-images/shirt-dustblue.jpg');
        $("#thumbnail").attr("src",base_url+'/images/frontend-images/thumbs/shirt-dustblue.jpg');
        $("#thumbnail").attr("xpreview",base_url+'/images/frontend-images/preview/shirt-dustblue.jpg');
        $(".selected-color").text(radio);
    }
}

function changeattribute(id,name1){
//alert(name1);
//alert(id);
$('#option-title-tagline-'+id).text(name1);
}



    // localStorage.removeItem('cartproductids');
    // localStorage.removeItem('productattributename'+'20');
    // localStorage.removeItem('localcollarfilter'+'20');
    // localStorage.removeItem('productattributename'+'21');
    // localStorage.removeItem('localcollarfilter'+'21');
    // localStorage.removeItem('productattributename'+'22');
    // localStorage.removeItem('localcollarfilter'+'22');

    // customized Product

/*
function addCartItems({id, name, qty, image, rate, attributes}){
    var cartItems = [];
    console.log(id);
    cartItems.push({
        id, name, qty, image, rate,
        attributes

    });

    console.log(cartItems);
    updateCartItemsLocalstorage();
}

function addCartItemsQty(id){

    for (var i = 0; i < cartItems.length; i++) {
        if (cartItems[i].id === id) {
          cartItems[i].qty++;
          break;
        }
    }
    updateCartItemsLocalstorage();
}

function subCartItemsQty(id){

    for (var i = 0; i < cartItems.length; i++) {
        if (cartItems[i].id === id) {
          cartItems[i].qty--;
          break;
        }
    }
    updateCartItemsLocalstorage();
}

function removeCartItems(removeableId){

    cartItems = cartItems.filter(function(item) {
        if (item.id == removeableId) {
            return false;
        }
        return true;
    }, removeableId);

    updateCartItemsLocalstorage();
}

function loadCartItems(){
    cartItems = JSON.parse(localStorage.getItem("cartItems"));
}

function updateCartItemsLocalstorage(){
    localStorage.setItem("cartItems", JSON.stringify(cartItems));
}
loadCartItems();
*/
$('#addToCart').click(function(){
    var proid = $('#addToCart').val();
    var productname = document.getElementById('productName').innerHTML;
    var productprice = document.getElementById('productPrice').getAttribute('value');
    var productpricepromo = document.getElementById('productPricepromo').getAttribute('value');
    var type = document.getElementById('typec').getAttribute('value');
    var productimage = document.getElementById('productImage').getAttribute('value');
    
    var attrname = [];
    var attrvalue = [];

    var listcollar = $("#collarsizecustomize :input[type='radio']:checked").val();


    var listsleeve = $("#sleevelengthc :input[type='radio']:checked").val();

    var listshirt = $("#shirtlength :input[type='radio']:checked").val();
   /* alert(proid);
    alert(productname);
    alert(productprice);
    alert(productimage);
    alert(listcollar);
    alert(listsleeve);
    alert(listshirt);*/

 

        var selectedValue = $(".radioDiv input[type='radio']:checked");
        var attributes = [];
        for (var i = 0; i < selectedValue.length; i++) {
            attrname[i] = selectedValue[i].getAttribute('value1');
            attrvalue[i] = selectedValue[i].getAttribute('value');
            attributes[i] = {name: selectedValue[i].getAttribute('value1'), value: selectedValue[i].getAttribute('value')}
        //console.log(attributes);
    }
        /*$('.customize-cart-alert').css("display", "block");
        $("#addToCart").prop("disabled", true);*/
        var cart_array = [proid,productname,productpricepromo,productprice,productimage,listcollar,listsleeve,listshirt,type];
        $('#alertadded').html()
        $.ajax({

           url:'/add-to-cart/'+cart_array+'/'+attrvalue+'/'+attrname,

           success:function(data){
             //var obj = JSON.parse(data);
            var var_name = data[0];

            $("#product-name-model").html(var_name);
            $("#myModal").modal('show');
            setTimeout(function(){
              $('#myModal').modal('hide')
            }, 2000);
            $("[data-id=cartBadg]").html('CART('+data[1]+')');
           }

        });

});

    // Standard product

$('#addToCartStandard').click(function(){
    var proid = $('#addToCartStandard').val();

    var productname = document.getElementById('productName').innerHTML;
    var productprice = document.getElementById('productPrice').getAttribute('value');
    var type = document.getElementById('types').getAttribute('value');
    var productpricepromo = document.getElementById('productPricepromo').getAttribute('value');
   // var promoprice = document.getElementById('productPricec').innerHTML;
    var productimage = document.getElementById('productImage').getAttribute('value');

    var attrname = [];
    var attrvalue = [];

    var listcollar = $("#stncollarsize :input[type='radio']:checked").val();


    var listsleeve = $("#sleevelength :input[type='radio']:checked").val();
    var selectedValue = $(".radioDiv input[type='radio']:checked");
        var attributes = [];
        for (var i = 0; i < selectedValue.length; i++) {
            attrname[i] = selectedValue[i].getAttribute('value1');
            attrvalue[i] = selectedValue[i].getAttribute('value');
            attributes[i] = {name: selectedValue[i].getAttribute('value1'), value: selectedValue[i].getAttribute('value')}
        //console.log(attributes);
    }

        if(listsleeve){
           var cart_array = [proid,productname,productpricepromo,productprice,productimage,listcollar,listsleeve,type]; 
        }
        else{
            listsleeve = 0;
            var cart_array = [proid,productname,productpricepromo,productprice,productimage,listcollar,listsleeve,type]; 
        }
        $('#alertadded').html()
        $.ajax({

           url:'/add-to-cart-standard/'+cart_array+'/'+attrvalue,

           success:function(data){
             //var obj = JSON.parse(data);
            var var_name = data[0];

            $("#product-name-model").html(var_name);
            $("#myModal").modal('show');
            setTimeout(function(){
              $('#myModal').modal('hide')
            }, 2000);
            $("[data-id=cartBadg]").html('CART('+data[1]+')');
           }

        });
        $.ajax({

           type:'POST',

           url:'/ajaxs/add-to-cart-standard/',

           data:{productid:proid, productname:productname, productprice:productprice, productimage:productimage, listcollar:listcollar,listsleeve:listsleeve, attrname:attrname,attrvalue:attrvalue,type:type},

           success:function(data){
             //var obj = JSON.parse(data);
             /*console.log(data[2]);*/
            var var_name = data[0];

            $("#product-name-model").html(var_name);
            $("#myModal").modal('show');
            setTimeout(function(){
              $('#myModal').modal('hide')
            }, 2000);
            $("[data-id=cartBadg]").html('CART('+data[1]+')');
           }

        });


    
   
});

$('#balanceCheck').click(function(){
    var card_code = $('#cardcode').val();
    var card_pin = $('#cardpin').val();
    

    var combine = [card_code,card_pin];
    console.log(combine);
    
        $('#balance').html('')
        $('#expiry').html('')
        $.ajax({

           url:'/checkbalance/'+combine,

           success:function(data){
             //var obj = JSON.parse(data);
             $('#balance').append(data[0]+data[1]);
             $('#expiry').append(data[2]);

            /*var var_name = data[0];

            $("#product-name-model").html(var_name);
            $("#myModal").modal('show');
            setTimeout(function(){
              $('#myModal').modal('hide')
            }, 2000);
            $("[data-id=cartBadg]").html('CART('+data[1]+')');*/
           }

        });

});

$(document).ready(function() {
//12-12-2019 size attribute
    $('#addToCartStandard').attr("disabled", "true");
    $('.customized-product-option').hide();

    $("#standard-product-btn").click(function(event){
        var btn_active = $(event.target);
        $('.standard-product-option').show();
        $('.customized-product-option').hide();
        $('#standard-product-btn').addClass('dark-btn');
        $('#standard-product-btn').removeClass('dark-outline-btn');
        $("#customized-product-btn").removeClass('dark-btn');
        $("#customized-product-btn").addClass('dark-outline-btn');
    });

    $("#customized-product-btn").click(function(){
        $('.standard-product-option').hide();
        $('.customized-product-option').show();
        $('#standard-product-btn').removeClass('dark-btn');
        $('#standard-product-btn').addClass('dark-outline-btn');
        $("#customized-product-btn").addClass('dark-btn');
        $("#customized-product-btn").removeClass('dark-outline-btn');
    });

    $('.radio-attr').click(function () {
        $('.radio-attr:not(:checked)').parent().closest('div').removeClass("selected");
        $('.radio-attr:checked').parent().closest('div').addClass("selected");
    });
    $('.radio-attr:checked').parent().closest('div').addClass("selected");

    $('.standard-fittype').click(function() {
      $('.standard-fittype').removeClass("active");
      $(this).addClass("active");

    });

    $('.custom-fittype').click(function() {
      $('.custom-fittype').removeClass("active");
      $(this).addClass("active");
    });
   //
   //  $(".sleevelength-radio").attr('disabled', true);
   //  $(".shirtlength-radio").attr('disabled',true);
   //  $(".collarsize-radio").click(function(){
   //      $(".sleevelength-radio").attr('disabled', false);
   //      $(".shirtlength-radio").attr('disabled',false);
   // })
});


    // $("button.dark-outline-btn").click(function(){

    //     // alert(this);
    //     console.log(this);
    //     $('#addToCartStandard').attr("disabled", "true");
    //     $("button.test").removeClass('dark-btn');
    //     $("button.test").addClass('dark-outline-btn');
    //     $(this).removeClass('dark-outline-btn');
    //     $(this).addClass('dark-btn');
    // });

    // $("button.subtest").click(function(){

    //     alert('here');
    //     $('#addToCartStandard').removeAttr("disabled");
    //     console.log(this);
    //     $("button.subtest").removeClass('dark-btn');
    //     $("button.subtest").addClass('dark-outline-btn');
    //     $(this).removeClass('dark-outline-btn');
    //     $(this).addClass('dark-btn');
    // });

    $(".stncol").click(function(){
        // alert('here');
        $('#addToCartStandard').removeAttr("disabled");
    });

function enablestnaddtocart(){
    $('#addToCartStandard').removeAttr("disabled");
    $('.st-info').hide();
}
// for standard
function fittype(id){
    // alert('you in standard');
    $('#addToCartStandard').attr("disabled", "true");
    $('.st-info').show();
    $.ajax({
        url: '/getfittypecollar/'+id,
        success: data => {
        $('#stncollarsize').html('');

        var html= '<div class="btn-group-toggle" data-toggle="buttons">';
            data.forEach(function(item){
            html+= '<div class="btn-group stncollarsizeuseroption" style="margin:1px;">';
            html+= '<label onclick="slvrange(';
            html+= item['id'];
            html+= ')" class="btn dark-outline-btn btn-sm collarsize-radio">';
            html+= '<input value="';
            html+= item['id'];
            html+= '" type="radio" name="collarsize-options" autocomplete="off" >';
            html+= item['name'];
            html+='</label>';
            html+= '</div>';
            });
            html+='</div>';
        $('#stncollarsize').html(html);
        }
    });
    $('.st-info').show();
 
  
} 
function fittypet(id){
    console.log(id);
    // alert('you in standard');
    $('#addToCartStandard').attr("disabled", "true");
    $('.st-info').show();
    $.ajax({ 
        url: '/getfittypecollart/'+id,
        success: data => {
            console.log(data);
        $('#stncollarsize').html('');

        var html= '<div class="btn-group-toggle" data-toggle="buttons">';
            data.forEach(function(item){
            html+= '<div class="btn-group stncollarsizeuseroption" style="margin:1px;">';
            html+= '<label onclick="slvrangetype(';
            html+= item['collarsize'];
            html+= ');enablestnaddtocart()" class="btn dark-outline-btn btn-sm collarsize-radio">';
            html+= '<input value="';
            html+= item['collarsize'];
            html+= '" type="radio" name="collarsize-options" autocomplete="off" >';
            html+= item['collar_name'];
            html+='</label>';
            html+= '</div>';
            });
            html+='</div>';
        $('#stncollarsize').html(html);
        }
    });
    $('.st-info').show();


}
$('.st-info').show();
$('.stncol').click(function(){
    $('.st-info').hide();
});
// customize collar sizes
function fittypetc(id){
    console.log(id);
    // alert('you in standard');
    $('#addToCartStandard').attr("disabled", "true");
    $('.st-info').show();
    $.ajax({ 
        url: '/getfittypecollart/'+id,
        success: data => {
            console.log(data);
        $('#collarsizecustomize').html('');

        var html= '<div class="btn-group-toggle" data-toggle="buttons">';
            data.forEach(function(item){
            html+= '<div class="btn-group stncollarsizeuseroption" style="margin:1px;">';
            html+= '<label onclick="slvrangetypec(';
            html+= item['collarsize'];
            html+= ');enablestnaddtocart()" class="btn dark-outline-btn btn-sm collarsize-radio">';
            html+= '<input value="';
            html+= item['collarsize'];
            html+= '" type="radio" name="collarsize-options" id="custcollarsize" autocomplete="off" >';
            html+= item['collar_name'];
            html+='</label>';
            html+= '</div>';
            });
            html+='</div>';
        $('#collarsizecustomize').html(html);
        }
    });
    $('.st-info').show();


}
$('.st-info').show();
$('.stncol').click(function(){
    $('.st-info').hide();
});

function slvrangetype(id){
 $('#addToCart').removeAttr("disabled");
    var slv = id;
    console.log(slv);
    $.ajax({
        url: '/getsleevesizerange/'+id,
        success: data => {

        $('#sleevelength').html('');
        console.log(data);
        var html= '<div class="btn-group-toggle" data-toggle="buttons">';
            data.forEach(function(item){
            html+= '<div class="btn-group" style="margin:1px;">';
            html+= '<label onclick="enablestnaddtocart()" class="btn dark-outline-btn btn-sm stncol">';
            html+= '<input value="';

            html+= item['id'];

            html+= '" type="radio" name="cust-sleevesize-options"';
            if(item['id'] == id)
            {
                html+= ' active';
            }
            html+= 'autocomplete="off" >';
            html+= item['sleeve_length'];
            html+='</label>';
            html+= '</div>';
            });
            html+='</div>';
        $('#sleevelength').html(html);
        }
    });

    
    
}
//sleeve range for customize
function slvrangetypec(id){
 $('#addToCart').removeAttr("disabled");
    var slv = id;
    console.log(slv);
    $.ajax({
        url: '/getsleevesizerange/'+id,
        success: data => {

        $('#sleevelengthc').html('');
        var html= '<div class="btn-group-toggle" data-toggle="buttons">';
            data.forEach(function(item){
            html+= '<div class="btn-group" style="margin:1px;">';
            html+= '<label onclick="shirtrange(';
            html+= item['sleeve_length'];
            html+= ')" class="btn dark-outline-btn btn-sm stncol">';
            html+= '<input value="';

            html+= item['id'];

            html+= '" type="radio" name="cust-sleevesize-options"';
            if(item['id'] == id)
            {
                html+= ' active';
            }
            html+= 'autocomplete="off" >';
            html+= item['sleeve_length'];
            html+='</label>';
            html+= '</div>';
            });
            html+='</div>';
        $('#sleevelengthc').html(html);
        }
    });

    
    
}
function slvrange(id){
 $('#addToCart').removeAttr("disabled");
    var slv = id;
    console.log(slv);
    $.ajax({
        url: '/getsleevesizerange/'+id,
        success: data => {
            console.log(data);
        $('#sleevelengthc').html('');
        var html= '<div class="btn-group-toggle" data-toggle="buttons">';
            data.forEach(function(item){
            html+= '<div class="btn-group" style="margin:1px;">';
            html+= '<label onclick="shirtrange(';
            html+= item['sleeve_length'];
            html+= ')" class="btn dark-outline-btn btn-sm stncol">';
            html+= '<input value="';

            html+= item['id'];

            html+= '" type="radio" name="cust-sleevesize-options"';
            if(item['id'] == id)
            {
                html+= ' active';
            }
            html+= 'autocomplete="off" >';
            html+= item['sleeve_length'];
            html+='</label>';
            html+= '</div>';
            });
            html+='</div>';
        $('#sleevelengthc').html(html);
        }
    });
 
    
    
}
function shirtrange(id){

    $.ajax({
        url: '/getshirtrangesize/'+id,
        async: false,
        success: data => {
            
            accounts = data.filter(function (n) { return n.shirt_length !== null });
            console.log(accounts);
        $('#shirtlength').html('');
        var html= '<div class="btn-group-toggle" data-toggle="buttons">';
           
            accounts.forEach(function(item){
            html+= '<div class="btn-group" style="margin:1px;">';
            html+= '<label class="btn dark-outline-btn btn-sm stncol">';
            html+= '<input value="';
            html+= item['id'];
            html+= '" type="radio" name="cust-shirtsize-options" autocomplete="off" >';
            html+= item['shirt_length'];
            html+='</label>';
            html+= '</div>';
            });
            html+='</div>';
        $('#shirtlength').html(html);
            //  var citydd = $("#slvshow").html('');
            //     $('#slvshow').append(data);
            //     $("#slvshow").prop("disabled", false);
           /* console.log(data);*/

        }
    });
}

// for customize
function fittypecustomize(id){
  $('#addToCart').attr("disabled", "true");
    $.ajax({
        url: '/getsleevesize/'+id,
        success: data => {
        console.log(data);
        $('#collarsizecustomize').html('');
        var html= '<div class="btn-group-toggle" data-toggle="buttons">';
            data.forEach(function(item){
            html+= '<div class="btn-group" style="margin:1px;">';
            html+= '<label onclick="enablestnaddtocart()" class="btn dark-outline-btn btn-sm stncol">';
            html+= '<input value="';

            html+= item['id'];

            html+= '" type="radio" name="collarsize-options"';
            if(item['id'] == id)
            {
                html+= ' active';
            }
            html+= 'autocomplete="off" >';
            html+= item['sleeve_length'];
            html+='</label>';
            html+= '</div>';
            });
            html+='</div>';
        $('#collarsizecustomize').html(html);
        //
        // $(".sleevelength-radio").attr('disabled', true);
        // $(".shirtlength-radio").attr('disabled',true);

        $(".info").show();
        $(".collarsize-radio").click(function(){
            // alert('enable radio');
            $(".info").hide();
        });

        // $('#sleevelength').html('');
        // var html= '<div class="btn-group-toggle" data-toggle="buttons">';
        //     data[1].forEach(function(item){
        //     html+= '<div class="btn-group custsleevesizeuseroption" style="margin:1px;">';
        //     html+= '<label class="btn dark-outline-btn btn-sm">';
        //     html+= '<input  value="';
        //     html+= item['id'];
        //     html+= '" type="radio" class="sleevelength-radio" name="cust-sleevesize-options" autocomplete="off" disabled="disabled">';
        //     html+= item['sleeve_length'];
        //     html+='</label>';
        //     html+= '</div>';
        //     });
        //     html+= '</div>';
        // $('#sleevelength').html(html);

        // $('#shirtlength').html('');
        // var html= '<div class="btn-group-toggle" data-toggle="buttons">';
        //     data[1].forEach(function(item){
        //     html+= '<div class="btn-group custshirtsizeuseroption" style="margin:1px;">';
        //     html+= '<label class="btn dark-outline-btn btn-sm">';
        //     html+= '<input  value="';
        //     html+= item['id'];
        //     html+= '" type="radio" class="shirtlength-radio" name="cust-shirtsize-options" autocomplete="off" disabled="disabled">';
        //     html+= item['shirt_length'];
        //     html+='</label>';
        //     html+= '</div>';
        //     });
        //     html+= '</div>';
        // $('#shirtlength').html(html);

        }
    });

   //  $(".sleevelength-radio").attr('disabled', true);
   //  $(".shirtlength-radio").attr('disabled',true);
   //  $(".collarsize-radio").click(function(){
   //      $(".sleevelength-radio").attr('disabled', false);
   //      $(".shirtlength-radio").attr('disabled',false);
   // })

}
    function suggestedsleeve(id,fittypeid)
    {
        // alert('Collar size:'+id);
        // alert('fittype: '+ fittypeid);
        $('#addToCart').removeAttr("disabled");
        // $('.st-info').hide();
    $.ajax({
        url: '/getsleevesize/'+fittypeid,
        success: data => {
        console.log(data);

        $('#sleevelength').html('');
        var html= '<div class="btn-group-toggle" data-toggle="buttons">';
            data[1].forEach(function(item){
            html+= '<div class="btn-group custsleevesizeuseroption" style="margin:1px;">';
            html+= '<label class="btn dark-outline-btn btn-sm';
            if(item['fitcollarsizes_id'] == id)
            {
                html+= ' active';
            }
            html+= '">';
            html+= '<input  value="';
            html+= item['id'];
            html+= '" type="radio" class="sleevelength-radio" name="cust-sleevesize-options" autocomplete="off" ';
            if(item['fitcollarsizes_id'] == id)
            {
                html+= 'checked="checked"';
            }
            html+= ' >';

            html+= item['sleeve_length'];
            html+='</label>';
            html+= '</div>';
            });
            html+= '</div>';
        $('#sleevelength').html(html);

        $('#shirtlength').html('');
        var html= '<div class="btn-group-toggle" data-toggle="buttons">';
            data[1].forEach(function(item){
            html+= '<div class="btn-group custshirtsizeuseroption" style="margin:1px;">';
            html+= '<label class="btn dark-outline-btn btn-sm'
            if(item['fitcollarsizes_id'] == id)
            {
                html+= ' active';
            }
            html+= '">';
            html+= '<input  value="';
            html+= item['id'];
            html+= '" type="radio" class="shirtlength-radio" name="cust-shirtsize-options" autocomplete="off" ';
            if(item['fitcollarsizes_id'] == id)
            {
                html+= 'checked="checked"';
            }
            html+= '>';
            html+= item['shirt_length'];
            html+='</label>';
            html+= '</div>';
            });
            html+= '</div>';
        $('#shirtlength').html(html);

        }
    });
  }


    $(".sleevelength-radio").attr('disabled', true);
    $(".shirtlength-radio").attr('disabled',true);
    $(".collarsize-radio").click(function(){
        // alert('enable radio');
        $(".info").hide();
        $(".sleevelength-radio").attr('disabled', false);
        $(".shirtlength-radio").attr('disabled',false);
   });


/*
    function suggestedsleeve(id,fittypeid)
    {
        alert('Collar size:'+id);
        alert('fittype: '+ fittypeid);
    $.ajax({
        url: '/getsleevesize/'+fittypeid,
        success: data => {
        console.log(data);

        $('#sleevelength').html('');
        var html= '';
            // alert('You are in success.');
            data[1].forEach(function(item){
            // alert(item['id']);
            html+= '<div class="btn-group" style="margin:1px;">';
            html+= '<button type="button" class="btn ';
            if(item['fitcollarsizes_id']==id)
            {
                html+= 'dark-btn rounded-0 btn-sm">';
            }
            else
            {
                html+= 'dark-outline-btn rounded-0 btn-sm">';
            }
            html+= item['sleeve_length'];
            html+='</button>';
            html+= '</div>';
            });
        $('#sleevelength').html(html);

        $('#shirtlength').html('');
        var html= '';
            // alert('You are in success.');
            data[1].forEach(function(item){
            // alert(item['id']);
            html+= '<div class="btn-group" style="margin:1px;">';
            html+= '<button type="button" class="btn ';
            if(item['fitcollarsizes_id']==id)
            {
                html+= 'dark-btn rounded-0 btn-sm">';
            }
            else
            {
                html+= 'dark-outline-btn rounded-0 btn-sm">';
            }
            html+= item['shirt_length'];
            html+='</button>';
            html+= '</div>';
            });
        $('#shirtlength').html(html);

        }
    });
    }
    */
