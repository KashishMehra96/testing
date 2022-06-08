<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Example of Bootstrap Four Column Convertible Layout</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

<style type="text/css">
.required{
	
	
	color:#09C;
	font-weight:bold;
	font-size:40px;
	text-decoration:underline;
}
</style>

<script>


function get_parent(idd)
{
	if(idd=="")
	{
		document.getElementById("pdiv").innerHTML="";
		return;
	}
	if(window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	  xmlhttp.onreadystatechange= function()
	  {
		  if(xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
		  document.getElementById("pdiv").innerHTML=xmlhttp.responseText;
	    }
	  }
	  
xmlhttp.open("GET","get_parent.php?mid="+idd,true);
xmlhttp.send();
//alert(idd);
}
</script>
</head>
<body>
<?php
session_start();
?>
<?php
include 'connection.php';
if(isset($_POST['btn']))
{
	
	 $sql="INSERT INTO Shipping(name,house_no.,street,city,status,creation_date)
values('$_POST[txtname]','$_POST[txthouse_no.]','$_POST[txtstreet]','$_POST[ddlcity]','available','$dt')";
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
         
         
          <form class="form-horizontal"  name="f1"  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
     		<div class="form-group">
      	        <div class="col-sm-12 ">
  
  						 <h1>Shipping Address</h1>
                </div>
   			</div>
            
   			<div class="form-group">
      			<label for="txtname" class="label-control col-xs-5"> Name</label>
      			<div class="col-xs-7">
      				<input type="text" class="form-control" id="txtname"  name="txtname" placeholder="Enter name" required/>
      			</div>
         	</div>
  
   			<div class="form-group">
    				<label for="txtdescription" class="label-control col-xs-5">Houes No.</label>
    			<div class="col-xs-7">
         			 <textarea class="form-control" id="txtdescription" name="txtdescription" row="5" ></textarea>
 				</div>
         	</div>
            
    		<div class="form-group">
     			<label for="ddlmain " class="label-control col-xs-5">Street</label>
  				<div class="col-xs-7">
   					 <select class="form-control" id="txtstreet" name="txtstreet" onchange="get_parent(this.value);">
 						<option value="selectmain">--Select main--</option>
  						<option value="Main">Main</option>
  						<?php
  							$sqlmain="select * from Shipping where main_cat='Main' and parent_cat='None'";
  							$result=mysqli_query($con,$sqlmain);
  							while($row=mysqli_fetch_array($result))
  							{
	  							echo"<option value='".$row['id']."' >".$row['name']."</option>";
  							}
  						?>
  					</select>
  				</div>
         	</div>
  
  			<div class="form-group">
  					<label for="ddlparent" class="label-control col-xs-5">City</label>
 			 <div class="col-xs-7">
  					<div id="pdiv">
  						<select class="form-control" id="ddlcity" name="ddlcity">
  						<option value="selectparent">--Select parent category--</option>
  						<option value="none">None</option>
  						</select>
  					</div>
          	</div>
        	</div> 
            
 			
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
    

  
</body>
</html>