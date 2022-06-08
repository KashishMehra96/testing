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
           <h1> Shopping Cart </h1> <br><br>
            </div>
            </div>
            
        <div class="row" style="text-align:center; min-height:40px; background-color:#9FC;">
       
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
	echo '<div class="row" style="text-align:center; min-height:40px;border-top:2px solid black;"><br>';
	echo '<div class="col-md-3">
            <h4> '.$row['product_name'].'</h4>
			<img src="'.$row['product_image'].'" width="50px" height="50px" />
            </div><br>


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
           <h4><a href="cart_delete.php?id='.$row['id'].'">  Delete </a> </h4>
            </div><br>';
			
				echo '</div>';

	$tot+= $row['amount'];
	
}
	
	
$tax= $tot*18/100;

$_SESSION['total']= $tot+ $tax;



?>
<h6 style="text-align:center; min-height:40px;border-top:2px solid black;"></h6>
  <h5 style="text-align:center; border:2px solid black;width:300px; margin-left:70%">

         <div class="row" >
         	<div class="col-md-5">
            </div>
            <div class="col-md-2">
            <h4> Total</h4>
            </div>&nbsp;&nbsp;&nbsp;
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
		 &nbsp;&nbsp;<a class="btn btn-success" href="products.php">CONTINUE SHOPPING</a>
       </div>
            <div class="col-md-offset-4 col-md-4">
  <a class="btn btn-success" href="order_detail.php?check=y"> 
  CONFIRM ORDER </a>
        </div>
            
		</div><br>
        
       <!-- <div class="row">
         	<div class="col-md-4">
     <a href="products.php" class="button button-primary" <button type="button" class="btn btn-success" name="sub" > Countinue Shopping </a>
           
            </div>
            <div class="col-md-offset-4 col-md-4">
            <a href="order_detail.php?check=y" class="button button-primary" > Proceed to Order </a>
            </div>
            
            </div>
            
		</div>-->
        
        
<!--</div>-->
<!--grids-->
<?php
include "footer.php";
?>