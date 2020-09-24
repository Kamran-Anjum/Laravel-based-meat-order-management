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