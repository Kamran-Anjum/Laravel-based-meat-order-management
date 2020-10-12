$(document).ready(function(){

    $(".sa-confirm-delete").click(function () {
    	
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
            	window.location.href="/admin/"+deleteFunction+"/"+id;
            }
        })
    }); 

    $("#subcategory").select2();
    $("#suppproducts").select2();
    $("#purchaseproduct").select2();
    $("#purchaseproducted").select2();
    

//Coding For Halal Meat
$('#product_category_id').on('change', function() { 
   var category_id = $(this).val();
   
    $.ajax({
            url: '/admin/getproductsubcategories/'+category_id,
            success: data => {
                var citydd = $("#subcategory").html('');
                $('#subcategory').append(data);
                $("#subcategory").prop("disabled", false);
                console.log(data);
            }

        }); 
});

// select supplier product for purchase order
$('#supplierPO').on('change', function() { 
   var supplier_id = $(this).val();
   
    $.ajax({
            url: '/admin/getsupplierproductpo/'+supplier_id,
            success: data => {
                var citydd = $("#purchaseproduct").html('');
                $('#purchaseproduct').append(data);
                $("#purchaseproduct").prop("disabled", false);
                console.log(data);
            }

        }); 
});

//Add Purchase Order
$('#purchaseproduct').on('change', function() { 
   var supplie_id = $(this).val(); 
 var selected = $('#purchaseproduct option:selected').toArray().map(item => item.text);
   
   var x = 1;
   var html = '';
   
   for (var i = 0; i < selected.length; i++) {
       $('#dynamicqty').html('');
       html +='<div class="row">';
       html +='<div class="col-md-4 mb-0">';
       html +='<div class="form-group">';
       html +='<label  for="">Product Name</label>';
       html +='<input readonly required type="text"  value="';
       html +=selected[i];
       html +='" class="form-control">';
       html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
       html +='<div class="col-md-4 mb-0">';
       html +='<div class="form-group">';
       html +='<label  for="">Price</label>';
       html +='<input required type="number" name="price[]" class="form-control">';
       html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
       html +='<div class="col-md-4 mb-0">';
       html +='<div class="form-group">';
       html +='<label  for="">Quantity</label>';
       html +='<input required type="number" name="quantity[]" class="form-control">';
       html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
       html +='</div>';

       x = x+1;
   }
     
   
   $('#dynamicqty').html(html);
    //alert(supplier_id);
});

//Edit Purchase Order
$('#purchaseproducted').on('change', function() { 
   var productids = $(this).val();
   //var selected = this.selectedIndex;
    var selected = $('#purchaseproducted option:selected').toArray().map(item => item.text);
    var selectedid = $('#purchaseproducted option:selected').toArray().map(item => item.value);
    var newproduct = new Array; 
   var poid = document.getElementById('poid').value;
   //alert(poid);
   var newproductids = productids;
   //alert(productids);
   /*var x = 1;
   var i = 0;*/
   var html = '';
   
   $.ajax({
        url: '/admin/getpoproductdata/'+productids+'/'+poid,
        success: data => {
        $('#dynamicqtyed').html('');
        console.log(data);
        
            data.forEach(function(item){
            html +='<div class="row">';
            html +='<div class="col-md-4 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Product Name</label>';
            html +='<input readonly required type="text" value="';
            html +=item['prodName'];    
            html +='" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='<div class="col-md-4 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Product Price</label>';
            html +='<input required type="number" name="price[]" value="';
            html +=item['price'];
            html +='" class="form-control">';
            html +='<input type="hidden" name="pod_id[]" value="';
            html +=item['id'];
            html +='" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='<div class="col-md-4 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Product Quantity</label>';
            html +='<input required type="number" name="quantity[]" value="';
            html +=item['demand_quantity'];
            html +='" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='</div>';
                for (var i = 0; i < selected.length; i++) {
                    if (selected[i] == item['prodName']) {
                    removeA(selected, item['prodName']);
                    
                    }
                    
                }
                //var b = Array.from(selectedid.split(','),Number);
                //selectedid.split(',').map(function(el){ return +el;});

                for (var x = 0; x < selectedid.length; x++) {
                    if (parseInt(selectedid[x]) == item['product_id'].toString()) {
                    removeB(selectedid, item['product_id'].toString());
                    
                    }
                }
               /*if (newproductids[i] != item['product_id'][i]) {
                    removeA(newproductids, item['product_id'][i]);
                    //newproduct.push(newproduct);
               }*/
               
               /*i++;*/
            });
            /*alert(selectedid);
            alert(selected);*/
            for (var y = 0; y < selected.length; y++) {
            if (data.length < productids.length) {
               
            html +='<div class="row">';
            html +='<div class="col-md-4 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Product Name</label>';
            html +='<input readonly type="text" value="';
            html += selected[y];
            html +='" class="form-control">';
             html +='<input type="hidden" name="productidnew[]" value="';
            html += selectedid[y];
            html +='" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='<div class="col-md-4 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Product Price</label>';
            html +='<input required type="number" name="pricenew[]" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='<div class="col-md-4 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Product Quantity</label>';
            html +='<input required type="number" name="quantitynew[]" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='</div>';
            }
            }
            $('#dynamicqtyed').html(html);
        }

    });
     
   
   
    //alert(supplier_id);
});

function removeA(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}
function removeB(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}


$('#ponumber').on('change', function() { 
   var po_id = $(this).val();
   
   var x = 1;
   var html = '';
   var htmlm = '';
   $.ajax({
            url: '/admin/recievepodetail/'+po_id,
            success: data => {
                
                //console.log(data);
                var product = data[0];
                var po = data[1];
                var po_drop = data[2];
        $('#dynamicqty').html('');

        
            for (var i = 0; i < product.length; i++){
            html +='<div class="row">';
            html +='<div class="col-md-2 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Product Name</label>';
            html +='<input type="text" readonly name="productname[]" value="';
            html +=product[i]['productName'];
            html +='" class="form-control">';
            html +='<input type="hidden" readonly name="productid[]" value="';
            html +=product[i]['productid'];
            html +='" class="form-control">';
            html +='<input type="hidden" readonly name="pod_id[]" value="';
            html +=product[i]['id'];
            html +='" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='<div class="col-md-2 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Demand Quantity</label>';
            html +='<input type="number" readonly name="dquantity[]" value="';
            html +=product[i]['demand_quantity'];
            html +='" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='<div class="col-md-2 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Price</label>';
            html +='<input type="number" id="price'+i+'" name="price[]" value="';
            html +=product[i]['price'];
            html +='" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='<div class="col-md-2 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Rec. Quantity</label>';
            html +='<input type="number" id="recieveqty'+i+'" name="rquantity[]" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='<div class="col-md-2 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Product Amount</label>';
            html +='<input type="number" onclick="getvalues('
            html +=i;
            html +=')" id="tamount'+i+'" readonly name="tamount[]" id="totalamount" value="0" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='</div>';
            };

            htmlm +='<div class="row">';
            htmlm +='<div class="col-md-4 mb-0">';
            htmlm +='<div class="form-group">';
            htmlm +='<label  for="">Status</label>';
            htmlm +='<select name="status" class="form-control" >';
            htmlm +=data[2];
            htmlm +='</select>';
            htmlm +='<div class="invalid-feedback">Example invalid custom select feedback</div>'
            htmlm +='</div>';
            htmlm +='</div>';
/*            htmlm +='<div class="col-md-1 mb-0">';
            htmlm +='</div>';*/
            htmlm +='<div class="col-md-3 mb-0">';
            htmlm +='<div class="form-group">';
            htmlm +='<label  for="">Periority Status</label>';
            htmlm +='<input name="prority" class="form-control" type="text" value="'
            htmlm +=po['prStatus'];
            htmlm +='" readonly>';
            htmlm +='<div class="invalid-feedback">Example invalid custom select feedback</div>'
            htmlm +='</div>';
            htmlm +='</div>';
            
            
            htmlm +='<div class="col-md-3 mb-0">';
            htmlm +='<div class="form-group">';
            htmlm +='<label  for="">Total Amount</label>';
            htmlm +='<input type="number" id="totalamount" onclick="gettotal()" readonly name="totalamount" value="0" class="form-control">';
            htmlm +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            htmlm +='</div>';
            htmlm +='<div class="row">';
            htmlm +='<div class="col-md-5 mb-0">';
            htmlm +='<div class="form-group">';
            htmlm +='<label  for="">Order Note</label>';
            htmlm +='<textarea readonly name="order_note" class="form-control cols="4" rows="5">';
            htmlm +=po['order_note'];
            htmlm +='</textarea>';
            htmlm +='<div class="invalid-feedback">Example invalid custom select feedback</div>'
            htmlm +='</div>';
            htmlm +='</div>';
            htmlm +='<div class="col-md-5 mb-0">';
            htmlm +='<div class="form-group">';
            htmlm +='<label  for="">Recieve Note</label>';
            htmlm +='<textarea name="recieve_note" class="form-control cols="4" rows="5">';
            htmlm +='</textarea>';
            htmlm +='<div class="invalid-feedback">Example invalid custom select feedback</div>'
            htmlm +='</div>';
            htmlm +='</div>';
            htmlm +='</div>';
        $('#dynamicqty').html(html);
        $('#dynamic').html(htmlm);
        }
    });
    
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
