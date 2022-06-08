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
</div>
   <!--/contact-->
   
   
   <?php
include 'connection.php';
	
if(isset($_GET['check']))
{
$dt=date("y-m-d");
 $sqlselect= "Select * from tab_order where Customer_Id='".$_SESSION['uid']."'  and Status='In process'";
$resultselect=mysqli_query($con,$sqlselect);
$count=mysqli_num_rows($resultselect);
	if($count==0)	
	{
$dt=date("y-m-d");

	$sqlins="INSERT INTO tab_order(Customer_Id,order_date,order_Amount,Status,creation_date) Values('$_SESSION[uid]','$dt', '$_SESSION[total]',  'In process','$dt')";
	if(!mysqli_query($con,$sqlins))
	{
		die('error:'.mysqli_error($con));
	}
	}
}

$sql3="select max(id) from tab_order where Customer_Id='".$_SESSION['uid']."'  and Status='In process'";
	$result1=mysqli_query($con,$sql3);
	while($row=mysqli_fetch_array($result1))
	{
		$_SESSION['Order_Id']=$row[0];
	}
	
	 $sqlcart="SELECT a.id,a.customer_id, a.product_id, a.quantity, a.status, b.product_name, b.product_image, b.product_price, a.quantity*b.product_price as amount from cart a left join product b on a.product_id=b.id where a.customer_id='". $_SESSION['uid']."' and a.status='pending'";


	$result=mysqli_query($con,$sqlcart);
	$dt=date("y-m-d");
	while($row = mysqli_fetch_array($result))
	{ 
	 $q="INSERT into order_item(Order_Id,Product_Id,Quantity,Status,creation_date) 
	 values('$_SESSION[Order_Id]', '".$row['product_id']."', '".$row['quantity']."','In process','$dt')";
    if(!mysqli_query($con,$q))
	{
		die('ERROR:'.mysqli_error($con));
	}
}
	
	
$sql11= "update  cart set Status='ordered' where Customer_Id='".$_SESSION['uid']."'  and Status='pending'";
    if(!mysqli_query($con,$sql11))
	{
		die('ERROR:'.mysqli_error($con));
	}
	
	
	//header('location:confirm.php');



?>	

    <!--<div class="banner_bottom_agile_info">-->
    
    
	    <div class="container-fluid">
		<?php
		
		
		$dt=date("y-m-d");
$sqlselect= "Select a.id,a.customer_id,a.order_date,a.order_amount,b.name,b.mobile from tab_order a left join registration b on a.customer_id=b.uid  where a.Customer_Id='".$_SESSION['uid']."'  and a.Status='In process'";
		$resultselect=mysqli_query($con,$sqlselect);
		
		while($row= mysqli_fetch_array($resultselect))
		{
		echo ' <div class="row">';
       	echo ' <div class="col-md-12" style="text-align:center; min-height:60px; background-color:#9FC;">';
        echo '<h1> Order Detail </h1> ';
        echo '  </div>';
        echo '  </div>';
            
            
         echo '   <div class="row" style="text-align:center; min-height:40px; background-color:#9FC;">';
          echo '  <div class="col-md-6">';
          echo '  <h4> Order no:</h4> <h3> '.$row['id'].' </h3> ';
          echo '  </div>';
          echo '   <div class="col-md-6">';
          echo '  <h4> Order Date:</h4><h3> '.$row['order_date'].' </h3>';
          echo '  </div>';
          echo '  <div class="col-md-6">';
           echo ' <h4> Customer Name:</h4> <h3> '.$row['name'].' </h3>';
           echo ' </div>';
          echo '  <div class="col-md-6">';
          echo '  <h4> Customer Id:</h4><h3> '.$row['customer_id'].' </h3>';
           echo ' </div>';
          echo '  <div class="col-md-6">';
           echo ' <h4> Mobile no.:</h4> <h3> '.$row['mobile'].' </h3>';
           echo ' </div>';
           echo '  <div class="col-md-6">';
           
           echo ' </div>';
     echo '  </div>';
	   
		}
        ?>
        
        	<div class="col-md-12" style="text-align:center; min-height:60px; background-color:#099;">
           <h1> Order List</h1> 
            </div>
            </div>
            
        <div class="row" style="text-align:center; min-height:40px; background-color:#6CC;">
        
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

$tax=0;
$tot=0;
 $sql1="SELECT a.id, a.product_id, a.quantity, a.status, b.product_name, b.product_image, b.product_price, a.quantity*b.product_price as amount from order_item  a left join product b on a.product_id=b.id left join tab_order c on a.order_id=c.id where c.customer_id='". $_SESSION['uid']."' and c.status='In process'";
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
         <div class="row" style="text-align:center;">
         	<div class="col-md-5">
            </div>
            <div class="col-md-2">
            <h4> Total</h4>
            </div> 
            
            <div class="col-md-3">
            <h4><?php echo $tot;  ?></h4>
            </div>
      	</div> 
        
        
        <div class="row" style="text-align:center;">
         	<div class="col-md-5">
            </div>
            <div class="col-md-2">
            <h4> Offer Code</h4>
            </div> 
        	<div class="col-md-3">
            	<div class="col-md-6">
      				<input type="text" class="form-control input-sm" id="txtoffer"  name="txtoffer" placeholder="Offer Code"  />
                    </div>
                    <div class="col-md-3">
                    <a href="#" class="button button-primary" >Apply </a>
                    </div>
      			</div>
         	</div>
            
            
         
         <div class="row" style="text-align:center;">
             <div class="col-md-5">
            </div>
            <div class="col-md-2">
            <h4> GST 18%</h4>
            </div>
            <div class="col-md-3">
            <h4><?php echo $tax;  ?></h4>
            </div>
            <div class="col-md-2">
            
            </div>
         </div>
         <div class="row" style="text-align:center;">
         	<div class="col-md-5">
            </div>
            <div class="col-md-2">
            <h4> Net Amount</h4>
            </div>
            <div class="col-md-3">
            <h4><?php echo $tot+$tax ;  ?></h4>
            </div>
            <div class="col-md-2">
            
            </div>
            </div>
            
		</div>
        
        
        <div class="row" style="text-align:center;">
         	<div class="col-md-4">
            <a href="#" class="button button-primary" > Countinue Shopping </a>
           
            </div>
            <div class="col-md-offset-4 col-md-4">
            <a href="Shipping.php" class="button button-primary" > Confirm Order </a>
            </div>
            
            </div>
            
		</div>
        
        
<!--</div>-->
<!--grids-->
<?php
include "footer.php";
?>