$(document).ready(function(){

    $(".sa-confirm-deletes").click(function () {
    	
    	var id = $(this).attr('param-id');
		var deleteFunction = $(this).attr('param-route');
		console.log(id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {

            if (result.value) {
            	window.location.href="/user/"+deleteFunction+"/"+id;
            }
        })
    }); 

    $("#subcategory").select2();
    $("#assetsubcategory").select2();
    $("#suppproducts").select2();
    $("#purchaseproduct").select2();
    $("#purchaseproducted").select2();


$('#category_user').on('change', function() { 
   var category_id = $(this).val();
   //alert(category_id);
   
    $.ajax({
            url: '/user/getproductsubcategories/'+category_id,
            success: data => {
                var citydd = $("#sub_category_user").html('');
                $('#sub_category_user').append(data);
                $("#sub_category_user").prop("disabled", false);
                console.log(data);
            }

        }); 
});

$('#sub_category_user').on('change', function() { 
   var sub_category_id = $(this).val();
   
    $.ajax({
            url: '/user/getsubcategoryproducts/'+sub_category_id,
            success: data => {
                var citydd = $("#product_id_user").html('');
                $('#product_id_user').append(data[1]);
                $("#product_id_user").prop("disabled", false);
                console.log(data[0]);
            }

        }); 
});

$('#product_id_user').on('change', function() { 
    var customer_id = document.getElementById("user_id").value;
   var product_id = $(this).val();

   //alert(customer_id);
   //alert(product_id);
   
    $.ajax({
            url: '/user/getproduct-stock-price/'+product_id+"/"+customer_id,
            success: data => {
                $("#stocks").html('');
                $("#sale_price").html('');
                $('#stocks').attr("value", data[0]);
                /*$('#stocks').value = data[0];*/
                $("#stocks").prop("readonly", true);
                $('#sale_price').attr("value", data[1]);
                /*$('#sale_price').value = data[1];*/
                $("#sale_price").prop("readonly", true);
                /*alert(data[0]);
                alert(data[1]);*/
            }

        }); 
});

 $('#qty').on('change keyup', function() {
        var quantity = $(this).val();
        var saleprice = document.getElementById("sale_price").value;

        document.getElementById("sub_total").value = quantity * saleprice;
        
        //alert(quantity * saleprice);

    });


});
function getSupplierDetails(id){
    var id = id;
    //alert(id);
    $.ajax({
        url: '/getsupplierdetail/'+id,
        success: data => {
            console.log(data);
            $('#ScheduleTable tbody').html('');
            
            
            $('#ScheduleTable tbody').html(data);
            $("#ScheduleTable").DataTable();
        }
    });
}

function getAssetDetails(id){
    var id = id;
    //alert(id);
    $.ajax({
        url: '/getassetdetail/'+id,
        success: data => {
            console.log(data);
            $('#ScheduleTable tbody').html('');
            
            
            $('#ScheduleTable tbody').html(data);
            $("#ScheduleTable").DataTable();
        }
    });
}

function getCustomerDetails(id){
    var id = id;
    //alert(id);
    $.ajax({
        url: '/getcustomerdetail/'+id,
        success: data => {
            console.log(data);
            $('#ScheduleTable tbody').html('');
            
            
            $('#ScheduleTable tbody').html(data);
            $("#ScheduleTable").DataTable();
        }
    });
}

function getRiderDetails(id){
    var id = id;
    //alert(id);
    $.ajax({
        url: '/getriderdetail/'+id,
        success: data => {
            console.log(data);
            $('#ScheduleTable tbody').html('');
            
            
            $('#ScheduleTable tbody').html(data);
            $("#ScheduleTable").DataTable();
        }
    });
}

function getPODetails(id){
    var id = id;
    //alert(id);
    $.ajax({
        url: '/admin/getpodetail/'+id,
        success: data => {
            console.log(data[1]);

            $('#Suppinfo tbody').html('');
            $('#productinfo tbody').html('');
            
            
            $('#Suppinfo tbody').html(data[0]);
            $("#Suppinfo").DataTable();

            $('#productinfo tbody').html(data[1]);
            $("#productinfo").DataTable();
        }
    });
}

function getSODetails(id){
    var id = id;
    //alert(id);
    $.ajax({
        url: '/admin/getsodetail/'+id,
        success: data => {
            console.log(data[1]);

            $('#Suppinfo tbody').html('');
            $('#productinfo tbody').html('');
            
            
            $('#Suppinfo tbody').html(data[0]);
            $("#Suppinfo").DataTable();

            $('#productinfo tbody').html(data[1]);
            $("#productinfo").DataTable();

            $('#forwardinfo tbody').html(data[2]);
            $("#forwardinfo").DataTable();
        }
    });
}

function getvalues(id){
var recqty = document.getElementById('recieveqty'+id).value;
var price = document.getElementById('price'+id).value;
var total = price * recqty;

document.getElementById('tamount'+id).value = total;

    //alert(inps);
}

function gettotal(){
var inps = document.getElementsByName('tamount[]');
var sum = 0;
for (var i = 0; i <inps.length; i++) {
var inp=inps[i];
     sum += +inp.value;
    //alert("tamount["+i+"].value="+inp.value);
}

document.getElementById('totalamount').value = sum;
    //alert(sum);
}

    var list = new Array();
    var totalprice = 0;
    /*var subcategory = new Array();
    var productid = new Array();
    var unit = new Array();
    var qty = new Array();
    var saleprice = new Array();
    var subtotal = new Array();
    var productnames = new Array();*/
    
    function getcurrentRow(){

    var x = [];

    x[0] = $('#product_id_user option:selected').toArray().map(item => item.text);
    x[1] = document.getElementById("unit").value;
    x[2] = document.getElementById("qty").value;
    x[3] = document.getElementById("sale_price").value;
    x[6] = document.getElementById("sub_total").value;
    x[7] = document.getElementById("product_id_user").value;

    list.push(x);

    makerow();
    document.getElementById("qty").value = "";
    document.getElementById("sub_total").value = "";
    document.getElementById("discount").value = "";
    document.getElementById("discount_amount").value = "";
    /*productnames[x] =  $('#product_id option:selected').toArray().map(item => item.text);
    //productid[x] = document.getElementById("product_id").value;
    unit[x] = document.getElementById("unit").value;
    qty[x] = document.getElementById("qty").value;
    saleprice[x] = document.getElementById("sale_price").value;
    subtotal[x] = document.getElementById("sub_total").value;

    alert("Element: " + productnames[x] + " Added at index " + x);
    x++;
    */
    /*var tdata = document.getElementById('product_id').value;
    array[x].push(tdata);
    x = x++;
    console.log(array);*/
    //console.log(list);
    
    
}
var y = 0;

function makerow(){

    document.getElementById("total_price").value = totalprice;
    
    var html = '';
   
   for (var i = 0; i < list.length; i++) {
       $('#dataTable2 tbody').html('');
       
       html +='<tr>';
       html +='<td><input required type="text" class="form-control" value="'
       html +=list[i][0];
       html +='"><input type="hidden" name="product_ids[]" value="'
       html +=list[i][7];
       html +='" </td>'
       html +='<td><input required type="text" name="unit[]" class="form-control" value="'
       html +=list[i][1];
       html +='"> </td>'
       html +='<td><input required type="text" name="quantity[]" class="form-control" value="'
       html +=list[i][2];
       html +='"> </td>'
       html +='<td><input required type="text" name="sale_price[]" class="form-control" value="'
       html +=list[i][3];
       html +='"> </td>'
       html +='<td><input required type="text" name="subtotal[]" class="form-control" value="'
       html +=Math.trunc(list[i][6]);
       html +='"> </td>'
       html +='<td><button type="button" onclick="deletearray('
       html +=i;
       html +=')" class="btn waves-effect waves-light btn-danger">delete</button></td>';
       html +='</tr>';
   }
   $('#dataTable2 tbody').html(html);
   totalprice = totalprice+Math.trunc(list[y][6]); 
   document.getElementById("total_price").value = totalprice;
   
    //alert(totalprice);
    y++;
}

function deletearray(id) {

    totalprice = totalprice-Math.trunc(list[id][6]);
    list.splice(id,1);
    y--;
    makerow();
    
    //alert(id);
}

