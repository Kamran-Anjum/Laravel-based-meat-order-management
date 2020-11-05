<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    
    
    <title>HalalMeat</title>
  
    <style type="text/css">
      
  #customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #bc0605;
  color: white;
}
      
    </style>
  </head>
  <body>
    <table class="table" id="customers">
    <thead>

   <tr>
      <th>S.No</th>
      <th>PO No.</th>
      <th>Supplier Name</th>
      <th>Total Quantity</th>
      <th>Total Amount</th>
      <th>Status</th>
                                                
  </tr>
</thead>
      <tbody>
<?php $i = 1; ?>
@foreach($purchase_orders as $order)
  <tr>
      <td>{{$i}}</td>
      <td>{{$order->id}}</td>
      <td>{{$order->suppName}}</td>
      <td>{{$order->total_amount}}</td>
      <td>{{$order->total_amount}}</td>
      <td>{{$order->status}}</td>
  </tr>
<?php $i = $i+1; ?>
@endforeach
</tbody>
<tfoot>

   <tr>
      <th>S.No</th>
      <th>PO No.</th>
      <th>Supplier Name</th>
      <th>Total Quantity</th>
      <th>Total Amount</th>
      <th>Status</th>
                                                
  </tr>
</tfoot>
</table>
  </body>
</html>