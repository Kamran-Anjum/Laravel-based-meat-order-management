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

$('#purchaseproduct').on('change', function() { 
   var supplie_id = $(this).val();
   
   var x = 1;
   var html = '';
   
   for (var i = 0; i < supplie_id.length; i++) {
       $('#dynamicqty').html('');
       html +='<div class="row">';
       html +='<div class="col-md-4 mb-0">';
       html +='<div class="form-group">';
       html +='<label  for="">Quantity Product-';
       html += x ;
       html +='</label><input type="number" name="quantity[]" class="form-control">';
       html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
       html +='</div>';

       x = x+1;
   }
     
   
   $('#dynamicqty').html(html);
    //alert(supplier_id);
});



$('#ponumber').on('change', function() { 
   var po_id = $(this).val();
   
   var x = 1;
   var html = '';
   $.ajax({
            url: '/admin/recievepodetail/'+po_id,
            success: data => {
                
                console.log(data);
        $('#dynamicqty').html('');

        
            data.forEach(function(item){
            html +='<div class="row">';
            html +='<div class="col-md-3 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Product Name</label>';
            html +='<input type="text" readonly name="productname[]" value="';
            html +=item['productName'];
            html +='" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='<div class="col-md-2 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Demand Quantity</label>';
            html +='<input type="number" readonly name="dquantity[]" value="';
            html +=item['demand_quantity'];
            html +='" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='<div class="col-md-2 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Recieve Quantity</label>';
            html +='<input type="number" id="recieveqty" name="rquantity[]" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='<div class="col-md-2 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Price</label>';
            html +='<input type="number" id="price" name="price[]" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='<div class="col-md-2 mb-0">';
            html +='<div class="form-group">';
            html +='<label  for="">Total Amount</label>';
            html +='<input type="number" onclick="getTotal('
            html +=x;
            html +=')" id="tamount" readonly name="price[]" id="totalamount" value="0" class="form-control">';
            html +='<div class="invalid-feedback">Example invalid custom select feedback</div></div></div>';
            html +='</div>';
            });
        $('#dynamicqty').html(html);
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

function getTotal(id) {

alert(id);

    /*$('#tamount').each(function(index){
    alert(id);
});*/
   /*var supplie_id = document.getElementById("price").value;
    alert(supplier_id);*/

}