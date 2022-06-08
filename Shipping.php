<?php
include "header.php";
?>	


<?php
session_start();
?>
<?php
include 'connection.php';
if(isset($_POST['btn']))
{
	$dt=date('y-m-d');
	 $sql="INSERT INTO shipping(name,house_no,street,city,status,creation_date)
 values('$_POST[txtname]','$_POST[txthouse]','$_POST[txtstreet]','$_POST[txtcity]','available','$dt')";
	if(!mysqli_query($con,$sql))
	
	{
		 die ('error added:'.mysqli_error($con));
	}
	echo "1 record added";
}
	
//	mysqli_close($con);

?>
<?php
if(!isset($_SESSION['aid']))
{
	header('Location:admin_login.php');
}
include "admin_header.php";
?>


<div class="container">
    <div class="row">
       <div class="col-sm-2 ">
         </div>
         <div class="col-sm-6 ">
         <div class="form-group">
         <div class="row">
       <div class="col-sm-3 ">
       </div>
       
       <div class="col-sm-8">
         
          <form class="form-horizontal"  name="f1"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
     		<div class="form-group">
      	        <div class="col-sm-12 ">
  
  						 <h1>Shipping Address</h1>
                </div>
   			</br>
            
   			<div class="form-group">
      			<label for="txtname" class="label-control col-xs-5"> Name</label>
      			<div class="col-xs-7">
      				<input type="text" class="form-control" id="txtname"  name="txtname" placeholder="Enter name" required/>
      			</div>
         	</br>
  
   			<div class="form-group">
    				<label for="txthouse" class="label-control col-xs-5">Houes No.</label>
    			<div class="col-xs-7">
         			 <input tpye="text" class="form-control" id="txthouse" name="txthouse" row="5" />
         	</div></br>
            
    		<div class="form-group">
     			<label for="txtstreet " class="label-control col-xs-5">Street</label>
  				<div class="col-xs-7">
                 <input tpye="text" class="form-control" id="txtstreet" name="txtstreet" />
         	</div></br>
  
  			<div class="form-group">
  					<label for="txtcity" class="label-control col-xs-5">City</label>
 			 <div class="col-xs-7">
  					 <input tpye="text" class="form-control" id="txtcity" name="txtcity" />
        	</div>
             </br>
            
 			
  		 <div class="form-group">
			<div class="row">
			   <div class="col-xs-5"></div>
			   <div class="col-xs-3">
				  <button type="Save" name="btn" class="btn btn-block btn-primary">Save</button>
             	</div>
		   		<div class="col-xs-3">
      			<button type="Pay Now" name="btn2" class="btn btn-block btn-danger">Pay Now</button>
         		</div>
			</div>
 		</div>
	</form>
    </div>
    </div>
    </div>
    </div>
    </div></div>
    </div></div></div>
    

  
<?php
include "Footer.php";
?>	