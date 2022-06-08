<?php
include "header.php";
?>
<!-- /banner_bottom_agile_info -->
<div class="page-head_agile_info_w3l">
		<div class="container">
			<h3>C<span>ontact Us </span></h3>
			<!--/w3_short-->
				 <div class="services-breadcrumb">
						<div class="agile_inner_breadcrumb">

						   <ul class="w3_short">
								<li><a href="index.php">Home</a><i>|</i></li>
								<li>Contact</li>
							</ul>
						 </div>
				</div>
	   <!--//w3_short-->
	</div>
</div><br>
   <!--/contact-->
    <!--<div class="banner_bottom_agile_info">-->
	    <div class="container">
		
          <div class="row">
        <div class="col-md-12" style="text-align:center; min-height:60px; background-color:#9FC;">
        <h1> Invoice </h1> 
            </div>
            </div>
            <div class="row" style="text-align:center; min-height:40px; background-color:#6CC;">
            <div class="col-md-6">
            <h4>Invoice No.</h4>
            </div>
             <div class="col-md-6">
            <h4> Invoice Date</h4>
            </div>
            <div class="col-md-6">
            <h4> Order #</h4>
            </div>
            <div class="col-md-6">
            <h4> Order Date</h4>
            </div>
            <div class="col-md-6">
            <h4> Payment mode</h4>
            </div>
             <div class="col-md-6">
             <h4>Order Status</h4>
             </div>
              <div class="col-md-6">
             <h4>Customer Name</h4>
             </div>
              <div class="col-md-6">
             <h4>Address</h4>
             </div>
              <div class="col-md-6">
             <h4>Email id</h4>
             </div>
              <div class="col-md-6">
             <h4>Mobile</h4>
             </div>
              <div class="col-md-6">
             </div>
             
             
             
             
             
             
           
            </div>
       </div><br>
        
        
        
        	<div class="col-md-12" style="text-align:center; min-height:60px; background-color:#099;">
           <h1> Detail</h1> 
            </div>
            </div>
            
        <div class="row" style="text-align:center; min-height:40px; background-color:#6CC;">
        <div class="col-md-3">
            <h4> Sr.no</h4>
            </div>
            </div>
                   <h6 style="text-align:center; min-height:40px;border-top:2px solid black;"></h6>
        
        
        
        	<div class="col-md-3">
            <h4> Product Detail</h4>
            </div>
             <div class="col-md-2">
            <h4> Quantity</h4>
            </div>
            <div class="col-md-2">
            <h4> Price</h4>
            </div>
            <div class="col-md-3">
            <h4> Amount</h4>
            </div>
            <div class="col-md-2">
            <h4> Delete</h4>
            </div>
      
       </div>

         

  
       
       
         <?php

include'connection.php';
if(isset($_POST['btncart']))
{

$dt= date('y/m/d');
$sql="INSERT into cart( customer_id,product_id,quantity, status, creation_date) values('$_SESSION[uid]', '$_POST[txtproid]', '$_POST[ddlqty]', 'pending', '$dt')";
	if(!mysqli_query($con,$sql))
	{
		die('ERROR:'.mysqli_error($con));
	}
}
$tax=0;
$tot=0;
$sql1="SELECT a.id,a.customer_id, a.product_id, a.quantity, a.status, b.product_name, b.product_image, b.product_price, a.quantity*b.product_price as amount from cart a left join product b on a.product_id=b.id where a.customer_id='". $_SESSION['uid']."' and a.status='pending'";
$result=mysqli_query($con,$sql1);
while($row= mysqli_fetch_array($result))
{
	echo '<div class="row" style="text-align:center; min-height:40px;border-top:2px solid black;">';
	echo '<div class="col-md-3">
            <h4> '.$row['product_name'].'</h4>
			<img src="'.$row['product_image'].'" width="50px" height="50px" />
            </div>
             <div class="col-md-2">
            '.$row['quantity'].'
            </div>
            <div class="col-md-2">
            '.$row['product_price'].'
            </div>
            <div class="col-md-3">
            '.$row['amount'].'
            </div>
            <div class="col-md-2">
            <h4> Delete</h4>
            </div>';
			
			echo '</div>';
	$tot+= $row['amount'];
}

$tax= $tot*18/100;

?>
<br><br>
       
           <h6 style="text-align:center; min-height:40px;border-top:2px solid black;"></h6>


  <h5 style="text-align:center; border:2px solid black;width:350px; margin-left:70%">

         <div class="row">
         	<div class="col-md-6">
            </div>
            <div class="col-md-6">
            <h4> Total</h4>
            </div>&nbsp;&nbsp;&nbsp;
            
         <div class="form-group">
      			<label for="txtname" class="label-control col-md-6">Offer Code</label>
      			<div class="col-md-6">
      				<input type="text" class="form-control" id="txtname"  name="txtname" placeholder="Enter name" required/>
      			 &nbsp;</div>
         	</div>
             <div class="col-md-offset-6 col-md-6" style="text-align:right;">
            <a href="#" class="btn btn-primary" >Apply  </a>
            &nbsp; </div>
            
            
            
            <div class="col-md-3">
            <h4><?php echo $tot;  ?></h4>
            </div>
            <div class="col-md-2">
            </div>
         </div>
         <div class="row">
             <div class="col-md-5">
            </div>
            <div class="col-md-2">
            <h4> GST 18%</h4>
            </div>&nbsp;&nbsp;&nbsp;
            <div class="col-md-3">
            <h4><?php echo $tax;  ?></h4>
            </div>
            <div class="col-md-2">
            
            </div>
         </div>
         <div class="row">
         	<div class="col-md-5">
            </div>
            <div class="col-md-2">
            <h4> Net Amount</h4>
            </div>&nbsp;&nbsp;&nbsp;
            <div class="col-md-3">
            <h4><?php echo $tot+$tax ;  ?></h4>
            </div>
            <div class="col-md-2">
            
            </div>
            </div>
            
		</div>
        </h5><br>
        
        <div class="row">
         	<div class="col-md-4">
             &nbsp; &nbsp;<a href="#" class="btn btn-success" >Countinue Shopping </a>
           
            </div>
            <div class="col-md-offset-4 col-md-4">
            <a href="#" class="btn btn-success" > Proceed to Order </a>
            </div>
            
            </div>
            
		</div><br>
        
  
        
<!--</div>-->
<!--grids-->
<?php
include "footer.php";
?>