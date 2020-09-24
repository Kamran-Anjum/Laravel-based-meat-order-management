
$(window).on('scroll', function (event) {
    var scrollValue = $(window).scrollTop();
    if (scrollValue > 150) {
        $('.stick-bar').addClass('affix');
    } else{
        $('.stick-bar').removeClass('affix');
    }
});


// Search Bar & Toggle
$('.toggle-search').on('click', function() {
  $('#search-box').toggle('display: inline-block');
});

$("#storeamount").change(function() {
    if(this.checked) {
        var subtotal = document.getElementById('subtotals').value;
        var storeamountss = document.getElementById('storeamounts').value;
        var balance = subtotal - storeamountss;

        document.getElementById('subttlt').innerHTML = "$"+balance;
        document.getElementById('subtotals').value = balance;
        $('#storeamounts').attr("name", "storeamount");
        console.log(balance);
    }
    else{
      var subtotal = document.getElementById('subtotals').value;
        var storeamountss = document.getElementById('storeamounts').value;
        var balance = parseInt(subtotal) + parseInt(storeamountss);

        document.getElementById('subttlt').innerHTML = "$"+balance;
        document.getElementById('subtotals').value = balance;
        $('#storeamounts').removeAttr("name");
        console.log(balance);
    }
});

function openCart(id) {
  document.getElementById("cartSidebar").style.width = "350px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  $('body').addClass("fixedPosition");
  $(".page-content").css({"pointer-events": "none", "cursor": "not-allowed", "filter": "brightness(0.5)"});
  // setToCart();
  var user_id = id;
  $.ajax({
        url: '/getshowcart/'+user_id,
        success: data => {
         $('#cartItem').html('');
          $('#cartItem').append(data);
        }

    });
  var totalPrice = 0;
  $.ajax({
        url: '/gettotalcart/'+user_id,
        success: data => {

           $('#subTotal').html('');
          $('#subTotal').append(data[0]);

          $('#subTotalhid').html('');
          $('#subTotalhid').val(data[1]);

          $("#checkoutBtn").html('Proceed To Checkout -'+data[0]);
          //console.log(data);

        /* $('#cartIem').html('');
          $('#cartIem').append(data);*/
       
        }

    });
  
}

function openCartc(id) {
  document.getElementById("cartSidebarr").style.width = "350px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  $('body').addClass("fixedPosition");
  $(".page-content").css({"pointer-events": "none", "cursor": "not-allowed", "filter": "brightness(0.5)"});
  // setToCart();
  var user_id = id;
  $.ajax({
        url: '/getshowgiftcart/'+user_id,
        success: data => {
         $('#cartIem').html('');
          $('#cartIem').append(data);
        }

    });
  var totalPrice = 0;
  $.ajax({
        url: '/gettotalgiftcart/'+user_id,
        success: data => {

           $('#subTotal').html('');
          $('#subTotal').append(data);

          $("#checkoutBtnn").html('Proceed To Checkout -'+data);
          console.log(data);

        /* $('#cartIem').html('');
          $('#cartIem').append(data);*/
       
        }

    });
  
}

function openCartec(id) {
  document.getElementById("cartSidebarr").style.width = "350px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  $('body').addClass("fixedPosition");
  $(".page-content").css({"pointer-events": "none", "cursor": "not-allowed", "filter": "brightness(0.5)"});
  // setToCart();
  var user_id = id;
  $.ajax({
        url: '/getshowegiftcart/'+user_id,
        success: data => {
         $('#cartIem').html('');
          $('#cartIem').append(data);
        }

    });
  var totalPrice = 0;
  $.ajax({
        url: '/gettotalegiftcart/'+user_id,
        success: data => {

           $('#subTotal').html('');
          $('#subTotal').append(data);

          $("#checkoutBtnn").html('Proceed To Checkout -'+data);
          console.log(data);

        /* $('#cartIem').html('');
          $('#cartIem').append(data);*/
       
        }

    });
  
}

function closeCart() {
  document.getElementById("cartSidebar").style.width = "0";
  document.body.style.backgroundColor = "white";
  $('body').removeClass("fixedPosition");
  $(".page-content").css({"pointer-events": "auto", "cursor": "default", "filter": "none"});
}

function closeCartc() {
  document.getElementById("cartSidebarr").style.width = "0";
  document.body.style.backgroundColor = "white";
  $('body').removeClass("fixedPosition");
  $(".page-content").css({"pointer-events": "auto", "cursor": "default", "filter": "none"});
}

function closeCartec() {
  document.getElementById("cartSidebarr").style.width = "0";
  document.body.style.backgroundColor = "white";
  $('body').removeClass("fixedPosition");
  $(".page-content").css({"pointer-events": "auto", "cursor": "default", "filter": "none"});
}


// cartSidebar
// function incrementValue(e) {
//   e.preventDefault();
//   var fieldName = $(e.target).data('field');
//   var parent = $(e.target).closest('div');
//   var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

//   if (!isNaN(currentVal)) {
//     parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
//   } else {
//     parent.find('input[name=' + fieldName + ']').val(0);
//   }
// }

// function decrementValue(e) {
//   e.preventDefault();
//   var fieldName = $(e.target).data('field');
//   var parent = $(e.target).closest('div');
//   var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

//   if (!isNaN(currentVal) && currentVal > 0) {
//     parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
//   } else {
//     parent.find('input[name=' + fieldName + ']').val(0);
//   }
// }

// $('.input-group').on('click', '.button-plus', function(e) {
//   incrementValue(e);
// });

// $('.input-group').on('click', '.button-minus', function(e) {
//   decrementValue(e);
// });

var colorchek = document.getElementsByClassName('colorfiltercls');
for(var k=0; k<colorchek.length; k++)
{
// alert('Color check: '+colorchek[0].val);
//console.log(colorchek);
}
/*
// alert('hhh'+colorfilterarray);
    $.each($("#colorfiltercls input"), function(){
        //this//debbgger laga yanha 
        this.id;
        // alert(this.id);
        debugger;
        var retrievedcolor = localStorage.getItem("localcolorfilter");
        var retrievedcolorarray = JSON.parse(retrievedcolor);
        if(typeof retrievedcolorarray != 'undefined' && retrievedcolorarray!=null ){
        var colorskeys = Object.keys(retrievedcolorarray);
        colorskeys.forEach(function(key){
        colors.push(retrievedcolorarray[key]);
        });

        }   
        // console.log(); 
        var testing = parseInt(this.defaultValue);
        if(colors.includes(testing)){
          // alert('pagal');
        }

    });
    */




/* Category product page */
var currentab ='';

function selectedmenu(categoryid){

  if(categoryid==localStorage.getItem("currenttab"))
  {
    // alert('this is the same categoryid: '+categoryid);

  }
  else
  {
    // alert('this is different the same categoryid: '+categoryid);
    localStorage.removeItem('localcolorfilter');
    localStorage.removeItem('localstylefilter');
    localStorage.removeItem('localcollarfilter');
    localStorage.removeItem('localfabricfilter');
    localStorage.removeItem('localcollectionfilter');
    localStorage.setItem("currenttab", JSON.stringify(categoryid));
  }
  // alert('this the categoryid'+categoryid);
}

function colorfilter(colorid)
{
    if(localStorage.getItem("localcolorfilter")!=null)
    {
        var colorfilterarray = [];
        var previouscolor = localStorage.getItem("localcolorfilter");
        var previousretrievedcolorarray = JSON.parse(previouscolor);
        if(typeof previousretrievedcolorarray != 'undefined' && previousretrievedcolorarray!=null )
        {
            var previouscolorskeys = Object.keys(previousretrievedcolorarray);
            previouscolorskeys.forEach(function(key){
            colorfilterarray.push(previousretrievedcolorarray[key]);
            });
        }
    }
    else
    {
        var colorfilterarray = [];
    }

    // Get the checkbox
    var checkBox = document.getElementById("color-"+colorid);
    // Get the output text
    var text = document.getElementById("text");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
        // alert('checked');
        colorfilterarray.push(colorid);
        localStorage.setItem("localcolorfilter", JSON.stringify(colorfilterarray));
    }
    else
    {
        var index = colorfilterarray.indexOf(colorid);
        if (index > -1) {
           colorfilterarray.splice(index, 1);
           localStorage.setItem("localcolorfilter", JSON.stringify(colorfilterarray));
        }
        // alert('unchecked');
    }
    // alert(colorid);
    var retrievedcolor = localStorage.getItem("localcolorfilter");
    var retrievedcolorarray = JSON.parse(retrievedcolor);
    var retrievedstyle = localStorage.getItem("localstylefilter");
    var retrievedstylearray = JSON.parse(retrievedstyle);
    var retrievedcollar = localStorage.getItem("localcollarfilter");
    var retrievedcollararray = JSON.parse(retrievedcollar);
    var retrievedfabric = localStorage.getItem("localfabricfilter");
    var retrievedfabricarray = JSON.parse(retrievedfabric);
    var retrievedcollection = localStorage.getItem("localcollectionfilter");
    var retrievedcollectionarray = JSON.parse(retrievedcollection);

    var colors = [];
    if(typeof retrievedcolorarray != 'undefined' && retrievedcolorarray!=null ){
        var colorskeys = Object.keys(retrievedcolorarray);
        colorskeys.forEach(function(key){
        colors.push(retrievedcolorarray[key]);
      });

    }
    var styles  = [];
    if(typeof retrievedstylearray != 'undefined' && retrievedstylearray!=null ){
        var styleskeys = Object.keys(retrievedstylearray);
        styleskeys.forEach(function(key){
        styles.push(retrievedstylearray[key]);
      });
    }

    var collars = [];
    if(typeof retrievedcollararray !== 'undefined' && retrievedcollararray !=null){
        var collarskeys = Object.keys(retrievedcollararray);
        collarskeys.forEach(function(key){
        collars.push(retrievedcollararray[key]);
      });
    }

    var fabrics = [];
    if(typeof retrievedfabricarray !== 'undefined' && retrievedfabricarray !=null){
        var fabricskeys = Object.keys(retrievedfabricarray);
        fabricskeys.forEach(function(key){
        fabrics.push(retrievedfabricarray[key]);
      });
    }

    var collections = [];
    if(typeof retrievedcollectionarray != 'undefined' && retrievedcollectionarray !=null){
        var collectionskeys = Object.keys(retrievedcollectionarray);
        collectionskeys.forEach(function(key){
        collections.push(retrievedcollectionarray[key]);
      });
    }

    var banda = this.ajaxcallmethod(colors,styles,collars,fabrics,collections);   
    // alert('Colors Array: '+colors);
    // alert('Styles Array: '+styles);
    // alert('Collars Array: '+collars);
    // alert('Fabrics Array: '+fabrics);
    // alert('Collections Array: '+collections);
}

/* Styles Filters */
// alert('start'+colorfilterarray);
function stylefilter(styleid)
{
    if(localStorage.getItem("localstylefilter")!=null)
    {
        var stylefilterarray = [];
        var previousstyle = localStorage.getItem("localstylefilter");
        var previousretrievedstylearray = JSON.parse(previousstyle);
        if(typeof previousretrievedstylearray != 'undefined' && previousretrievedstylearray!=null )
        {
            var previousstylesskeys = Object.keys(previousretrievedstylearray);
            previousstylesskeys.forEach(function(key){
            stylefilterarray.push(previousretrievedstylearray[key]);
            });
        }
    }
    else
    {
        var stylefilterarray = [];
    }
    // alert('STYLE ID: '+styleid);

    var checkBox = document.getElementById("style-"+styleid);
    if (checkBox.checked == true){
    stylefilterarray.push(styleid);
    localStorage.setItem("localstylefilter", JSON.stringify(stylefilterarray));
    } else {
    var index = stylefilterarray.indexOf(styleid);

    if (index > -1) {
       stylefilterarray.splice(index, 1);
       localStorage.setItem("localstylefilter", JSON.stringify(stylefilterarray));
    }
    }
    var retrievedcolor = localStorage.getItem("localcolorfilter");
    var retrievedcolorarray = JSON.parse(retrievedcolor);
    var retrievedstyle = localStorage.getItem("localstylefilter");
    var retrievedstylearray = JSON.parse(retrievedstyle);
    var retrievedcollar = localStorage.getItem("localcollarfilter");
    var retrievedcollararray = JSON.parse(retrievedcollar);
    var retrievedfabric = localStorage.getItem("localfabricfilter");
    var retrievedfabricarray = JSON.parse(retrievedfabric);
    var retrievedcollection = localStorage.getItem("localcollectionfilter");
    var retrievedcollectionarray = JSON.parse(retrievedcollection);

    var colors = [];
    if(typeof retrievedcolorarray != 'undefined' && retrievedcolorarray!=null ){
        var colorskeys = Object.keys(retrievedcolorarray);
        colorskeys.forEach(function(key){
        colors.push(retrievedcolorarray[key]);
      });

    }
    var styles  = [];
    if(typeof retrievedstylearray != 'undefined' && retrievedstylearray!=null ){
        var styleskeys = Object.keys(retrievedstylearray);
        styleskeys.forEach(function(key){
        styles.push(retrievedstylearray[key]);
      });
    }

    var collars = [];
    if(typeof retrievedcollararray !== 'undefined' && retrievedcollararray !=null){
        var collarskeys = Object.keys(retrievedcollararray);
        collarskeys.forEach(function(key){
        collars.push(retrievedcollararray[key]);
      });
    }

    var fabrics = [];
    if(typeof retrievedfabricarray !== 'undefined' && retrievedfabricarray !=null){
        var fabricskeys = Object.keys(retrievedfabricarray);
        fabricskeys.forEach(function(key){
        fabrics.push(retrievedfabricarray[key]);
      });
    }

    var collections = [];
    if(typeof retrievedcollectionarray != 'undefined' && retrievedcollectionarray !=null){
        var collectionskeys = Object.keys(retrievedcollectionarray);
        collectionskeys.forEach(function(key){
        collections.push(retrievedcollectionarray[key]);
      });
    }

    var banda = this.ajaxcallmethod(colors,styles,collars,fabrics,collections); 
}

/* Collars Filters */
// alert('start'+collarfilterarray);
function collarfilter(collarid)
{
    if(localStorage.getItem("localcollarfilter")!=null)
    {
        var collarfilterarray = [];
        var previouscollar = localStorage.getItem("localcollarfilter");
        var previousretrievedcollararray = JSON.parse(previouscollar);
        if(typeof previousretrievedcollararray != 'undefined' && previousretrievedcollararray!=null )
        {
            var previouscollarskeys = Object.keys(previousretrievedcollararray);
            previouscollarskeys.forEach(function(key){
            collarfilterarray.push(previousretrievedcollararray[key]);
            });
        }
    }
    else
    {
        var collarfilterarray = [];
    }
    var checkBox = document.getElementById("collar-"+collarid);
    if (checkBox.checked == true){
    collarfilterarray.push(collarid);
    localStorage.setItem("localcollarfilter", JSON.stringify(collarfilterarray));
    } else {
    var index = collarfilterarray.indexOf(collarid);

    if (index > -1) {
       collarfilterarray.splice(index, 1);
       localStorage.setItem("localcollarfilter", JSON.stringify(collarfilterarray));
    }
    }
  var retrievedcolor = localStorage.getItem("localcolorfilter");
  var retrievedcolorarray = JSON.parse(retrievedcolor);
  var retrievedstyle = localStorage.getItem("localstylefilter");
  var retrievedstylearray = JSON.parse(retrievedstyle);
  var retrievedcollar = localStorage.getItem("localcollarfilter");
  var retrievedcollararray = JSON.parse(retrievedcollar);
  var retrievedfabric = localStorage.getItem("localfabricfilter");
  var retrievedfabricarray = JSON.parse(retrievedfabric);
  var retrievedcollection = localStorage.getItem("localcollectionfilter");
  var retrievedcollectionarray = JSON.parse(retrievedcollection);

    var colors = [];
    if(typeof retrievedcolorarray != 'undefined' && retrievedcolorarray!=null ){
      var colorskeys = Object.keys(retrievedcolorarray);
      colorskeys.forEach(function(key){
          colors.push(retrievedcolorarray[key]);
      });

    }
    var styles  = [];
    if(typeof retrievedstylearray != 'undefined' && retrievedstylearray!=null ){
      var styleskeys = Object.keys(retrievedstylearray);
      styleskeys.forEach(function(key){
          styles.push(retrievedstylearray[key]);
      });
    }

    var collars = [];
    if(typeof retrievedcollararray !== 'undefined' && retrievedcollararray !=null){
      var collarskeys = Object.keys(retrievedcollararray);
      collarskeys.forEach(function(key){
          collars.push(retrievedcollararray[key]);
      });
    }

    var fabrics = [];
    if(typeof retrievedfabricarray !== 'undefined' && retrievedfabricarray !=null){
      var fabricskeys = Object.keys(retrievedfabricarray);
      fabricskeys.forEach(function(key){
          fabrics.push(retrievedfabricarray[key]);
      });
    }

    var collections = [];
    if(typeof retrievedcollectionarray != 'undefined' && retrievedcollectionarray !=null){
      var collectionskeys = Object.keys(retrievedcollectionarray);
      collectionskeys.forEach(function(key){
          collections.push(retrievedcollectionarray[key]);
      });
    }
    var banda = this.ajaxcallmethod(colors,styles,collars,fabrics,collections);
}

/* Fabric Filters */
// alert('start'+fabricfilterarray);
function fabricfilter(fabricid)
{
    if(localStorage.getItem("localfabricfilter")!=null)
    {
        var fabricfilterarray = [];
        var previousfabric = localStorage.getItem("localfabricfilter");
        var previousretrievedfabricarray = JSON.parse(previousfabric);
        if(typeof previousretrievedfabricarray != 'undefined' && previousretrievedfabricarray!=null )
        {
            var previouscfabricskeys = Object.keys(previousretrievedfabricarray);
            previouscfabricskeys.forEach(function(key){
            fabricfilterarray.push(previousretrievedfabricarray[key]);
            });
        }
    }
    else
    {
        var fabricfilterarray = [];
    }
    var checkBox = document.getElementById("fabric-"+fabricid);
    if (checkBox.checked == true)
    {
        fabricfilterarray.push(fabricid);
        localStorage.setItem("localfabricfilter", JSON.stringify(fabricfilterarray));
    }
    else
    {
        var index = fabricfilterarray.indexOf(fabricid);
        if (index > -1) {
           fabricfilterarray.splice(index, 1);
           localStorage.setItem("localfabricfilter", JSON.stringify(fabricfilterarray));
        }
    }
    var retrievedcolor = localStorage.getItem("localcolorfilter");
    var retrievedcolorarray = JSON.parse(retrievedcolor);
    var retrievedstyle = localStorage.getItem("localstylefilter");
    var retrievedstylearray = JSON.parse(retrievedstyle);
    var retrievedcollar = localStorage.getItem("localcollarfilter");
    var retrievedcollararray = JSON.parse(retrievedcollar);
    var retrievedfabric = localStorage.getItem("localfabricfilter");
    var retrievedfabricarray = JSON.parse(retrievedfabric);
    var retrievedcollection = localStorage.getItem("localcollectionfilter");
    var retrievedcollectionarray = JSON.parse(retrievedcollection);

    var colors = [];
    if(typeof retrievedcolorarray != 'undefined' && retrievedcolorarray!=null ){
      var colorskeys = Object.keys(retrievedcolorarray);
      colorskeys.forEach(function(key){
          colors.push(retrievedcolorarray[key]);
      });

    }
    var styles  = [];
    if(typeof retrievedstylearray != 'undefined' && retrievedstylearray!=null ){
      var styleskeys = Object.keys(retrievedstylearray);
      styleskeys.forEach(function(key){
          styles.push(retrievedstylearray[key]);
      });
    }

    var collars = [];
    if(typeof retrievedcollararray !== 'undefined' && retrievedcollararray !=null){
      var collarskeys = Object.keys(retrievedcollararray);
      collarskeys.forEach(function(key){
          collars.push(retrievedcollararray[key]);
      });
    }

    var fabrics = [];
    if(typeof retrievedfabricarray !== 'undefined' && retrievedfabricarray !=null){
      var fabricskeys = Object.keys(retrievedfabricarray);
      fabricskeys.forEach(function(key){
          fabrics.push(retrievedfabricarray[key]);
      });
    }

    var collections = [];
    if(typeof retrievedcollectionarray != 'undefined' && retrievedcollectionarray !=null){
      var collectionskeys = Object.keys(retrievedcollectionarray);
      collectionskeys.forEach(function(key){
          collections.push(retrievedcollectionarray[key]);
      });
    }

    var banda = this.ajaxcallmethod(colors,styles,collars,fabrics,collections);
}

/* Collections Filters */
// var collectionfilterarray = [];
// alert('start'+collectionfilterarray);
function collectionfilter(collectionid)
{
    if(localStorage.getItem("localcollectionfilter")!=null)
    {
        var collectionfilterarray = [];
        var previouscollection = localStorage.getItem("localcollectionfilter");
        var previousretrievedcollectionarray = JSON.parse(previouscollection);
        if(typeof previousretrievedcollectionarray != 'undefined' && previousretrievedcollectionarray!=null )
        {
            var previouscollectionskeys = Object.keys(previousretrievedcollectionarray);
            previouscollectionskeys.forEach(function(key){
            collectionfilterarray.push(previousretrievedcollectionarray[key]);
            });
        }
    }
    else
    {
        var collectionfilterarray = [];
    }
    // alert(collectionfilterarray);
    var checkBox = document.getElementById("collection-"+collectionid);
    if (checkBox.checked == true){
        collectionfilterarray.push(collectionid);
        localStorage.setItem("localcollectionfilter", JSON.stringify(collectionfilterarray));
    }
    else
    {
        var index = collectionfilterarray.indexOf(collectionid);

        if (index > -1) {
           collectionfilterarray.splice(index, 1);
           localStorage.setItem("localcollectionfilter", JSON.stringify(collectionfilterarray));
        }
    }
    var retrievedcolor = localStorage.getItem("localcolorfilter");
    var retrievedcolorarray = JSON.parse(retrievedcolor);
    var retrievedstyle = localStorage.getItem("localstylefilter");
    var retrievedstylearray = JSON.parse(retrievedstyle);
    var retrievedcollar = localStorage.getItem("localcollarfilter");
    var retrievedcollararray = JSON.parse(retrievedcollar);
    var retrievedfabric = localStorage.getItem("localfabricfilter");
    var retrievedfabricarray = JSON.parse(retrievedfabric);
    var retrievedcollection = localStorage.getItem("localcollectionfilter");
    var retrievedcollectionarray = JSON.parse(retrievedcollection);

    var colors = [];
    if(typeof retrievedcolorarray != 'undefined' && retrievedcolorarray!=null ){
      var colorskeys = Object.keys(retrievedcolorarray);
      colorskeys.forEach(function(key){
          colors.push(retrievedcolorarray[key]);
      });

    }
    var styles  = [];
    if(typeof retrievedstylearray != 'undefined' && retrievedstylearray!=null ){
      var styleskeys = Object.keys(retrievedstylearray);
      styleskeys.forEach(function(key){
          styles.push(retrievedstylearray[key]);
      });
    }

    var collars = [];
    if(typeof retrievedcollararray !== 'undefined' && retrievedcollararray !=null){
      var collarskeys = Object.keys(retrievedcollararray);
      collarskeys.forEach(function(key){
          collars.push(retrievedcollararray[key]);
      });
    }

    var fabrics = [];
    if(typeof retrievedfabricarray !== 'undefined' && retrievedfabricarray !=null){
      var fabricskeys = Object.keys(retrievedfabricarray);
      fabricskeys.forEach(function(key){
          fabrics.push(retrievedfabricarray[key]);
      });
    }

    var collections = [];
    if(typeof retrievedcollectionarray != 'undefined' && retrievedcollectionarray !=null){
      var collectionskeys = Object.keys(retrievedcollectionarray);
      collectionskeys.forEach(function(key){
          collections.push(retrievedcollectionarray[key]);
      });
    }
    var banda = this.ajaxcallmethod(colors,styles,collars,fabrics,collections);
}

function ajaxcallmethod(colors,styles,collars,fabrics,collections){
    // alert('colors: '+colors);
    // alert('styles: '+styles);
    // alert('collars: '+collars);
    // alert('fabrics: '+fabrics);
    // alert('collections: '+collections);
    // alert('length of fabrcs: '+fabrics.length)
    // alert('length of collections: '+collections.length)
    // alert(typeof fabrics);
    // alert(typeof collections);

    if(colors.length == '0')
    {
        colors = 0;
    }
    if(styles.length == '0')
    {
        styles = 0;
    }
    if(collars.length == '0')
    {
        collars = 0;
    }
    if(fabrics.length == '0')
    {
        fabrics = 0;
    }
    if(collections.length == '0')
    {
        collections = 0;
    }
    // alert('you are on right place if');
    $.ajax({
    url: '/getfiltercategoryproduct/'+colors+'/'+styles+'/'+collars+'/'+fabrics+'/'+collections,
    type: 'get',
    dataType: 'json',
    success: function(result){
        // alert(result.categoryname);
        // alert(result.allsubcategories[0]['id']);
        // alert('In success');
        // console.log(result.completearray);

    if(result.allsubcategories)
    {
        var base_url = window.location.origin;
        // alert('in if');
        for( var countersc =0; countersc<result.allsubcategories.length; countersc++)
        {
            var html = '';
            // alert('main loop'+countersc);
            $('#subcategoryproduct-'+countersc).html("");
            // alert('here we go');
            // alert('bakwass'+result.completearray[result.allsubcategories[countersc]['id']]);
            if(result.completearray[result.allsubcategories[countersc]['id']])
            {
                html +='<div class="">';
                html +='<div class="row">';
                html +='    <div class="col">';
                html +='        <p class="heading">';
                html += result.categoryname;
                html +=' | ';
                html += result.completearray[result.allsubcategories[countersc]['id']][countersc]['subcategoryname'];
                html += '</p>';
                html +='    </div>';
                html +='</div>';
            }
            if(typeof result.completearray[result.allsubcategories[countersc]['id']] != 'undefined')
            {
            for(var productcounter =0; productcounter<result.completearray[result.allsubcategories[countersc]['id']].length; productcounter++)
            {
                if(productcounter == 0)
                {
                    html += '<div class="row">';        
                }

                html += '<div class="col-6 col-sm-6 col-md-4 product-tile mb-4">';
                html += '<div class="img-box">';
                /*
                html += '<img src="{{ asset("/images/backend-images/liburtiimages/products/large/"';
                html += result.completearray[result.allsubcategories[countersc]['id']][productcounter]['image'];
                html += ') }}" class="product-image">';
                */
                html += '<a href="';
                html += base_url;
                html += '/productdetail/';
                html += result.completearray[result.allsubcategories[countersc]['id']][productcounter]['id'];
                html += '/';
                html += result.allsubcategories[countersc]['id'];
                html += '">';
                html += '<img src="';
                html +=  base_url;
                html +='/images/backend-images/liburtiimages/products/large/';
                html += result.completearray[result.allsubcategories[countersc]['id']][productcounter]['image'];
                html += '" class="product-image">';
                html += '</a>';

                html += '</div>';
                html += '<div class="product-top">';
                html += '<i id="whishlist" class="fa fa-heart-o add-to-whishlist"></i>';
                html += '</div>';
                html += '<div class="product-bottom">';
                html += '<div class="product-bottom-left">';
                html += '<h5 class="product-title"><a href=""> ';
                html += result.completearray[result.allsubcategories[countersc]['id']][productcounter]['name'];
                html += ' </a></h5>';
                html += '<div class="product-details hidden">';
                html += '<p class="mb-0"> ';
                html += result.completearray[result.allsubcategories[countersc]['id']][productcounter]['description'];
                html += ' </p>';
                html += '</div>';
                html += '</div>';

                html += '<div class="product-bottom-right">';
                html += '    <h5 class="product-price"> ';
                html += result.completearray[result.allsubcategories[countersc]['id']][productcounter]['price'];
                html += '  sek</h5>';
                html += '</div>';

                // <!-- Product Color -->
                html += '<div class="product-color hidden">';
                html += '    <div class="color-choose">';
                html += '        <ul class="list-group list-group-horizontal p-0 my-2 choose-img">';
                if(typeof result.relatedproductdetailsarray[result.completearray[result.allsubcategories[countersc]['id']][productcounter]['id']] !='undefined')
                {
                  for (var relatecounter = 0; relatecounter<result.relatedproductdetailsarray[result.completearray[result.allsubcategories[countersc]['id']][productcounter]['id']].length; relatecounter++)
                  {
                  html += '            <li style="list-style: none;" class="pr-1">';
                  html += '                <a href="';
                  html += base_url;
                  html += '/productdetail/';
                  html += result.relatedproductdetailsarray[result.completearray[result.allsubcategories[countersc]['id']][productcounter]['id']][relatecounter]['id'];
                  html += '/';
                  html += result.allsubcategories[countersc]['id'];
                  html += '" data-image="';
                  html += base_url;
                  html += '/images/backend-images/liburtiimages/products/large/';
                  html += result.relatedproductdetailsarray[result.completearray[result.allsubcategories[countersc]['id']][productcounter]['id']][relatecounter]['image'];
                  html += '" class="product-color-link">';
                  html += '                    <img src="';
                  html += base_url;
                  html += '/images/backend-images/liburtiimages/products/large/';
                  html += result.relatedproductdetailsarray[result.completearray[result.allsubcategories[countersc]['id']][productcounter]['id']][relatecounter]['image'];
                  html += '" class="product-color-container">';
                  html += '                </a>';
                  html += '            </li>';
                  }
                }
                /*
                html += '            <li style="list-style: none;" class="pr-1">';
                html += '                <a href="#" data-image="';
                html += base_url;
                html += '/images/frontend-images/shirt-dustblue.jpg" class="product-color-link">';
                html += '                    <img src="';
                html += base_url;
                html += '/images/frontend-images/dustblue.jpg" class="product-color-container">';
                html += '                </a>';
                html += '            </li>';
                html += '            <li style="list-style: none;" class="pr-1">';
                html += '                <a href="#" data-image="';
                html += base_url;
                html += '/images/frontend-images/shirt-monument.jpg" class="product-color-link">';
                html += '                   <img src="';
                html += base_url;
                html += '/images/frontend-images/monument.jpg" class="product-color-container">';
                html += '                </a>';
                html += '            </li>';
                */
                html += '        </ul>';
                html += '    </div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';


                // alert('you are in');
                // alert(result.completearray[result.allsubcategories[countersc]['id']][productcounter]['name']);
                // alert(result.completearray[result.allsubcategories[countersc]['id']]);
            }

            html += '</div>';
            // html += '</div>';
            html += '<div class="row mb-4">';
            html += '    <div class="col">';
            html += '        <center>';
            html += '<div class="animated-button-black m-auto" style="width:130px;">';
            html += '<a href="'
            html += base_url;
            html += '/allsubcategoryproducts/';
            html += result.categoryid;            
            html += '/';
            html += result.allsubcategories[countersc]['id'];
            html += '"';
            html += ' class="animated-button-link p-2"><div class="animated-button-text-black">View All</div></a>';
            html += '        </center>';
            html += '    </div>';
            html += '</div>';
            html += '</div>';
        }
            $('#subcategoryproduct-'+countersc).append(html);

        }

    }            


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
/*
<div class="container-fluid mt-2 px-5">
                <div class="row">
                    <div class="col">
                        <p class="heading">{{$categoryname->name}} | {{ $subcategory->name }}</p>
                    </div>
                </div>
        @foreach($completearray[$subcategory->id] as $complete)
            @if($rowconter == 0)
                <div class="row">
        <?php $rowconter = $rowconter+1; ?>
            @endif

        <div class="col-6 col-sm-6 col-md-4 product-tile mb-4">
            <div class="img-box">
                <img src="{{ asset('/images/backend-images/liburtiimages/products/large/'.$complete->image ) }}" class="product-image">
            </div>
            <div class="product-top">
                <i id="whishlist" class="fa fa-heart-o add-to-whishlist"></i>
            </div>
            <div class="product-bottom">
                <div class="product-bottom-left">
                    <h5 class="product-title"><a href="">{{ $complete->name }}</a></h5>
                    <div class="product-details hidden">
                        <p class="mb-0">{{ $complete->description }}</p>
                    </div>
                </div>

                <div class="product-bottom-right">
                    <h5 class="product-price">{{ $complete->price }} sek</h5>
                </div>

                <!-- Product Color -->
                <div class="product-color hidden">
                    <div class="color-choose">
                        <ul class="list-group list-group-horizontal p-0 my-2 choose-img">
                            <li style="list-style: none;" class="pr-1">
                                <a href="#" data-image="{{ asset('/images/frontend-images/shirt-pinegreen.jpg' ) }}" class="product-color-link">
                                    <img src="{{ asset('/images/frontend-images/pinegreen.jpg' ) }}" class="product-color-container">
                                </a>
                            </li>
                            <li style="list-style: none;" class="pr-1">
                                <a href="#" data-image="{{ asset('/images/frontend-images/shirt-dustblue.jpg' ) }}" class="product-color-link">
                                    <img src="{{ asset('/images/frontend-images/dustblue.jpg' ) }}" class="product-color-container">
                                </a>
                            </li>
                            <li style="list-style: none;" class="pr-1">
                                <a href="#" data-image="{{ asset('/images/frontend-images/shirt-monument.jpg' ) }}" class="product-color-link">
                                   <img src="{{ asset('/images/frontend-images/monument.jpg' ) }}" class="product-color-container">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
    </div>


    <div class="row mb-4">
        <div class="col">
            <center>
                <a href="#" class="animated-btn btn-view p-2"><span>View All</span></a>
            </center>
        </div>
    </div>
</div>    
    @endif
@endforeach  
@endif
*/

        },
    error: function (errormessage) {
                //alert('error!');
        }
    });

}

//***Owais Work***

function removeFromCheckout(id)
{
  removeFromCart(id);
  document.location.reload();
}

function removeFromCart(id)
{

      $.ajax({
    url: '/removecartsesssion/'+id,
    type: 'get',
    dataType: 'json',
    success: function(result){
      console.log(result);
 
    if(localStorage.getItem("cartproductids")!=null)
    {
        var cartproductidsarray = [];
        var previouscartproductids = localStorage.getItem("cartproductids");
        var previousretrievedcartproductidsarray = JSON.parse(previouscartproductids);

        if(typeof previousretrievedcartproductidsarray != 'undefined' && previousretrievedcartproductidsarray!=null )
        {
            var previouscartproductidskeys = Object.keys(previousretrievedcartproductidsarray);
            previouscartproductidskeys.forEach(function(key){
            cartproductidsarray.push(previousretrievedcartproductidsarray[key]);
            });
        }

        var index = cartproductidsarray.indexOf(id.toString());
        if (index > -1) {
           cartproductidsarray.splice(index, 1);
           localStorage.setItem("cartproductids", JSON.stringify(cartproductidsarray));
        }
    }
    else
    {
        var cartproductidsarray = [];
    }

    localStorage.removeItem('productattributename'+id);
    // localStorage.removeItem('localcollarfilter'+id);

    localStorage.removeItem('productquantity-'+id);

    setToCartOnLoad();
    $("[data-id=cartBadge]").html('CART ('+cartproductidsarray.length+')');
    }
  });

}

function setToCart(proid)
{
    var cartproductidsarray = JSON.parse(localStorage.getItem('cartproductids'));
// alert('Cart ids:'+cartproductidsarray);
    var productattributenamearray = [];
    var productattributevaluearray = [];
    var collarlengtharray = [];
    var sleevelengtharray = [];
    var shirtlengtharray = [];
    var productinfoarray = [];

    var productqtyarray = [];

    $("#cartItem").html('');
    var totalPrice = 0;

      productattributenamearray[0] = JSON.parse(localStorage.getItem('productattributename-'+proid));
      productattributevaluearray[0] = JSON.parse(localStorage.getItem('productattributevalue-'+proid));
      // alert('HAHAHHAA: '+JSON.parse(localStorage.getItem('collarlength-'+proid)));
      // alert('HAHAHHAA: '+JSON.parse(localStorage.getItem('sleevelength-'+proid)));
      // alert('HAHAHHAA: '+JSON.parse(localStorage.getItem('shirtlength-'+proid)));
      collarlengtharray[0] = JSON.parse(localStorage.getItem('collarlength-'+proid));
      sleevelengtharray[0] = JSON.parse(localStorage.getItem('sleevelength-'+proid));
      shirtlengtharray[0] = JSON.parse(localStorage.getItem('shirtlength-'+proid));
      productinfoarray[0] = JSON.parse(localStorage.getItem('productinfo-'+proid));

    for (var i = 0; i < cartproductidsarray.length; i++) 
    {
      var productId = cartproductidsarray[i];
      var productInfo = JSON.parse(localStorage.getItem("productinfo-"+productId));
      var productName = productInfo[0];
      var productImage = productInfo[1];
      var productPrice = productInfo[2];

      productqtyarray[i] = localStorage.getItem('productquantity-'+productId);

      var qty = localStorage.getItem('productquantity-'+productId);
      if (qty == 0 || qty == null) 
      {
        qty = 1;
      }

      var number = Number(productPrice.replace(/[^0-9.-]+/g,""));
      var subTotal = number*qty;

      totalPrice += subTotal;

      var base_url = window.location.origin;
      var html = '';

      html += '<div class="row py-2">';
      html += '<div class="col-4 col-md-4">';
      html += '<div class="cart-product-image">';
      html += '<a href="'+/productdetail/+productId+'/">';
      html += '<img id="cartProductImage" src='+base_url+'/images/backend-images/liburtiimages/products/large/'+productImage+' class="cart-product-image">';
      html += '</a>';
      html += '</div>';
      html += '</div>';
      html += '<div class="col-8 col-md-8">';
      html += '<div class="cart-product-detail">';
      html += '<h6 id="cartProductName" class="cart-product-heading">'+productName+'</h6>';
      html += '<div class="cart-product-meta mb-0">';
      html += '<p id="cartProductDescription" class="cart-product-desc mb-0">Size Musab, untucked length</p>';
      html += '<p id="cartProductPrice" class="cart-product-price mb-1">'+productPrice+'</p>';
      html += '</div>';
      html += '<div class="float-right d-none carttotal" id="productsubTotal'+productId+'">'+subTotal+'</div>';
      html += '<div class="input-group w-50 float-left border">';
      html += '<button class="btn btn-sm border-0 rounded-0 btn-plus" onclick="QuanMinus('+productId+','+number+')" type="button">-</button>';
      html += '<input class="form-control form-control-sm border-0 text-center product-Quantity" type="number" id="product-Quantity'+productId+'" placeholder="0" min="1" value="1">';
      html += '<button class="btn btn-sm border-0 rounded-0 btn-plus" onclick="QuanPlus('+productId+','+number+')" type="button" >+</button>';
      html += '</div>';
      html += '<div class="remove-block">';
      html += '<a onClick="removeFromCart('+productId+');" href="#" class="remove-item">remove</a>';
      html += '</div>';
      html += '</div>';
      html += '</div>';
      html += '</div>';

      $("#cartItem").append(html);

      document.getElementById("product-Quantity"+productId).value = qty;
    }

    $("#subTotal").html('$'+totalPrice);
    $("#checkoutBtn").html('Proceed To Checkout - $'+totalPrice);

    // alert('Main issue:'+collarlengtharray);

    this.checkoutajaxcall(cartproductidsarray, productattributenamearray, productattributevaluearray, productinfoarray, productqtyarray,collarlengtharray,sleevelengtharray,shirtlengtharray);
}

function checkoutajaxcall(cartproductids, productattributename, productattributevalue, productinfo, productqty, collarlengtharray, sleevelengtharray, shirtlengtharray)
{
  // alert('in ajax call cart product id:'+cartproductids);
  // alert('in ajax call collar product id:'+collarlengtharray);
  // alert('in ajax call sleeve product id:'+sleevelengtharray);
  // alert('in ajax call shirt product id:'+shirtlengtharray);
  if (productattributename == '') 
  {
    productattributename = 0;
  }
  
  if (productattributevalue == '') 
  {
    productattributevalue = 0;
  }

  if (productinfo == '') 
  {
    productinfo = 0;
  }

  if (productqty == '' || productqty == 0) 
  {
    productqty = 1;
  }
  if (collarlengtharray == '') 
  {
    collarlengtharray = 0;
  }
  if (sleevelengtharray == '') 
  {
    sleevelengtharray = 0;
  }
  if (shirtlengtharray == '') 
  {
    shirtlengtharray = 0;
  }
  
    $.ajax({
    url: '/getcheckoutproducts/'+cartproductids+'/'+productattributename+'/'+productattributevalue+'/'+productinfo+'/'+productqty+'/'+collarlengtharray+'/'+sleevelengtharray+'/'+shirtlengtharray,
    type: 'get',
    dataType: 'json',
    success: function(result){
      console.log(result);
      // alert('you in session success');
      // alert(result);
    }
  });
}


function setToCartOnLoad()
{
    var cartproductidsarray = JSON.parse(localStorage.getItem('cartproductids'));

    $("#cartItem").html('');
    var totalPrice = 0;
    
    for (var i = 0; i < cartproductidsarray.length; i++) 
    {
      var productId = cartproductidsarray[i];
      var productInfo = JSON.parse(localStorage.getItem("productinfo-"+cartproductidsarray[i]));
      var productName = productInfo[0];
      var productImage = productInfo[1];
      var productPrice = productInfo[2];
      //var promoPrice = productInfo[3];
      //var setprice;
      /*if(promoPrice == 0){
        setprice = productPrice;
      }
      else{
        setprice = promoPrice;
      }*/

      var qty = localStorage.getItem('productquantity-'+productId);
      if (qty == 0 || qty == null) 
      {
        qty = 1;
      }

      var number = Number(productPrice.replace(/[^0-9.-]+/g,""));
      var subTotal = number*qty;

      totalPrice += subTotal;

      var base_url = window.location.origin;
      var html = '';

        html += '<div class="row py-2">';
        html += '<div class="col-4 col-md-4">';
        html += '<div class="cart-product-image">';
        html += '<a href="/productdetail/'+productId+'/">';
        html += '<img id="cartProductImage" src='+base_url+'/images/backend-images/liburtiimages/products/large/'+productImage+' class="cart-product-image">';
        html += '</a>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-8 col-md-8">';
        html += '<div class="cart-product-detail">';
        html += '<h6 id="cartProductName" class="cart-product-heading">'+productName+'</h6>';
        html += '<div class="cart-product-meta mb-0">';
        html += '<p id="cartProductDescription" class="cart-product-desc mb-0">Size Musab, untucked length</p>';
        html += '<p id="cartProductPrice" class="cart-product-price mb-1">'+productPrice+'</p>';
        html += '</div>';
        html += '<div class="float-right d-none carttotal" id="productsubTotal'+productId+'">'+subTotal+'</div>';
        html += '<div class="input-group w-50 float-left border">';
        html += '<button class="btn btn-sm border-0 rounded-0 btn-plus" onclick="QuanMinus('+productId+','+number+')" type="button">-</button>';
        html += '<input class="form-control form-control-sm border-0 text-center product-Quantity" type="number" id="product-Quantity'+productId+'" placeholder="0" min="1" value="1">';
        html += '<button class="btn btn-sm border-0 rounded-0 btn-plus" onclick="QuanPlus('+productId+','+number+')" type="button" >+</button>';
        html += '</div>';
        html += '<div class="remove-block">';
        html += '<a onClick="removeFromCart('+productId+');" href="#" class="remove-item">remove</a>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';


      $("#cartItem").append(html);
      
      document.getElementById("product-Quantity"+productId).value = qty;

    }

    $("#subTotal").html('$'+totalPrice);
    $("#checkoutBtn").html("Proceed To Checkout");


}

function cartTotal()
{
  debugger;
  var sum = 0;
  $(".cartTotal").each(function(){
      sum += parseFloat($(this).text());
  })

  $("#subTotal").innerHTML(sum.toFixed(2));
  $("#checkoutBtn").innerHTML(sum.toFixed(2));

}
 
function checkoutTotal()
{

  var totalll = $("input[name=chkk]").val();
  var sum = 0;
  $(".tot").each(function(){
      sum += parseFloat($(this).text());
  });
 
  var tsum = sum-totalll;
  $("#total1").html(tsum.toFixed(2));
  $("#total2").html(tsum.toFixed(2));
  

}

function QuanPlus(id, price){

  document.getElementById("product-Quantity"+id).stepUp();
  var qty = document.getElementById("product-Quantity"+id).value;
  localStorage.setItem('productquantity-'+id, qty);

  var subtotal = price * qty;
  document.getElementById("productsubTotal"+id).innerHTML = subtotal;
  setToCart(id);

  cartTotal();

}

function QuanMinus(id, price){

  document.getElementById("product-Quantity"+id).stepDown();
  var qty = document.getElementById("product-Quantity"+id).value;
  localStorage.setItem('productquantity-'+id, qty);
  
  var subtotal = price * qty;
  document.getElementById("productsubTotal"+id).innerHTML = subtotal;
  setToCart(id);

  cartTotal();

}

/*function QuantityPlus(id, price){
  // alert(price);
  document.getElementById("product-Qty"+id).stepUp();
  var qty = document.getElementById("product-Qty"+id).value;
  localStorage.setItem('productquantity-'+id, qty);

  var subtotal = price * qty;
  document.getElementById("productTotal"+id).innerHTML = subtotal;
  checkoutTotal();

  setToCart(id);
  // alert(qty);
}*/
/*function QuantityMinus(id, price){
  document.getElementById("product-Qty"+id).stepDown();
  var qty = document.getElementById("product-Qty"+id).value;
  localStorage.setItem('productquantity-'+id, qty);

  var subtotal = price * qty;
  document.getElementById("productTotal"+id).innerHTML = subtotal;
  checkoutTotal();

  setToCart(id);
}*/

function removegiftcart(id,giftid){
  console.log(id);
  $.ajax({
        url: '/removegiftcarttchk/'+id+'/'+giftid,
        success: data => {
          document.location.reload();
         console.log(data);
        }

    });


}

function removeegiftcart(id,giftid){
  console.log(id);
  $.ajax({
        url: '/removeegiftcartt/'+id+'/'+giftid,
        success: data => {
          document.location.reload();
         console.log(data);
        }

    });


}
 
function removecartitem(id){
  console.log(id);
  $.ajax({
        url: '/removecartitem/'+id,
        success: data => {
          document.location.reload();
         console.log(data);
        }

    });


}
 
function QuantityPlus(id, price){
  // alert(price);
  document.getElementById("product-Qty"+id).stepUp();
  var qty = document.getElementById("product-Qty"+id).value;
  
  var cprice = document.getElementById("sbttl").value;
  var sprice = parseInt(cprice) + parseInt(price);
  document.getElementById("sbttl").value = sprice;
  document.getElementById("subttl").innerHTML = "$"+sprice;

  $.ajax({
        url: '/addcartqty/'+id+'/'+qty,
        success: data => {
        //alert(data);
        location.reload();
        }
    });


  console.log(sprice);
  /*checkoutTotal();

  setToCart(id);*/
  // alert(qty);
}

function QuantityPlusc(id, price){
  // alert(price);
  document.getElementById("product-Qtyc"+id).stepUp();
  var qty = document.getElementById("product-Qtyc"+id).value;

  var cprice = document.getElementById("subTotalhid").value;
  var sprice = parseInt(cprice) + parseInt(price);
  document.getElementById("subTotalhid").value = sprice;
  document.getElementById("subTotal").innerHTML = "$"+sprice;
  document.getElementById("checkoutBtn").innerHTML = "Proceed to Checkout-$"+sprice;
  

  $.ajax({
        url: '/addcartqty/'+id+'/'+qty,
        success: data => {
        //alert(data);
        }
    });


  console.log(sprice);
  /*checkoutTotal();

  setToCart(id);*/
  // alert(qty);
}

function QuantityMinusc(id, price){
  

  if(document.getElementById("product-Qtyc"+id).value == 1){
    $('#minbtnc').attr('disabled');
  }
  else{

    document.getElementById("product-Qtyc"+id).stepDown();
     var qty = document.getElementById("product-Qtyc"+id).value;

     var cprice = document.getElementById("subTotalhid").value;
  var sprice = parseInt(cprice) - parseInt(price);
  document.getElementById("subTotalhid").value = sprice;
  document.getElementById("subTotal").innerHTML = "$"+sprice;
  document.getElementById("checkoutBtn").innerHTML = "Proceed to Checkout-$"+sprice;

  $.ajax({
        url: '/minuscartqty/'+id+'/'+qty,
        success: data => {
        //alert(data);
        }
    });
  }
}

function QuantityMinus(id, price){
  

  if(document.getElementById("product-Qty"+id).value == 1){
    $('#minbtn').attr('disabled');
  }
  else{

    document.getElementById("product-Qty"+id).stepDown();
     var qty = document.getElementById("product-Qty"+id).value;
    var cprice = document.getElementById("sbttl").value;
  var sprice = parseInt(cprice) - parseInt(price);
  document.getElementById("sbttl").value = sprice;
  document.getElementById("subttl").innerHTML = "$"+sprice;
  document.getElementById("subttlt").innerHTML = "$"+sprice;
  console.log(sprice);

  $.ajax({
        url: '/minuscartqty/'+id+'/'+qty,
        success: data => {
        //alert(data);
        location.reload();
        }
    });
  }
  
  checkoutTotal();

  setToCart(id);
}




function QuantityPlusgift(id, price){
  // alert(price);
  document.getElementById("product-Qty"+id).stepUp();
  var qty = document.getElementById("product-Qty"+id).value;
  
  var cprice = document.getElementById("sbttl").value;
  var sprice = parseInt(cprice) + parseInt(price);
  document.getElementById("sbttl").value = sprice;
  document.getElementById("subttl").innerHTML = "$"+sprice;

   $.ajax({
        url: '/addcartqtygift/'+id+'/'+qty,
        success: data => {
          location.reload();
        //alert(data);
        }
    });
  console.log(sprice);
  /*checkoutTotal();

  setToCart(id);*/
  // alert(qty);
}

function QuantityPlusegift(id, price){
  // alert(price);
  document.getElementById("product-Qty"+id).stepUp();
  var qty = document.getElementById("product-Qty"+id).value;
  
  var cprice = document.getElementById("sbttl").value;
  var sprice = parseInt(cprice) + parseInt(price);
  document.getElementById("sbttl").value = sprice;
  document.getElementById("subttl").innerHTML = "$"+sprice;

   $.ajax({
        url: '/addcartqtyegift/'+id+'/'+qty,
        success: data => {
          location.reload();
        //alert(data);
        }
    });
  console.log(sprice);
  /*checkoutTotal();

  setToCart(id);*/
  // alert(qty);
}

function QuantityMinusgift(id, price){
  

  if(document.getElementById("product-Qty"+id).value == 1){
    $('#minbtn').attr('disabled');
  }
  else{

    document.getElementById("product-Qty"+id).stepDown();
     var qty = document.getElementById("product-Qty"+id).value;
    var cprice = document.getElementById("sbttl").value;
  var sprice = parseInt(cprice) - parseInt(price);
  document.getElementById("sbttl").value = sprice;
  document.getElementById("subttl").innerHTML = "$"+sprice;

  $.ajax({
        url: '/minuscartqtygift/'+id+'/'+qty,
        success: data => {
        //alert(data);
        location.reload();
        }
    });
  console.log(sprice);
  }
  
}

function QuantityMinusegift(id, price){
  

  if(document.getElementById("product-Qty"+id).value == 1){
    $('#minbtn').attr('disabled');
  }
  else{

    document.getElementById("product-Qty"+id).stepDown();
     var qty = document.getElementById("product-Qty"+id).value;
    var cprice = document.getElementById("sbttl").value;
  var sprice = parseInt(cprice) - parseInt(price);
  document.getElementById("sbttl").value = sprice;
  document.getElementById("subttl").innerHTML = "$"+sprice;

  $.ajax({
        url: '/minuscartqtyegift/'+id+'/'+qty,
        success: data => {
        //alert(data);
        location.reload();
        }
    });
  console.log(sprice);
  }
  
}

$(document).ready(function(){

      // alert('Ajeeb: '+JSON.parse(localStorage.getItem('collarlength-27')));
      // alert('Ajeeb: '+JSON.parse(localStorage.getItem('sleevelength-27')));
      // alert('Ajeeb: '+JSON.parse(localStorage.getItem('shirtlength-27')));
    var cartproductidsarray = JSON.parse(localStorage.getItem('cartproductids'));
      $("[data-id=cartBadge]").html('CART ('+cartproductidsarray.length+')');
      setToCartOnLoad();
      checkoutTotal();
});
