<?php
session_start();
ob_start();
include('header.php');
?>
	<?php
	$varname="";
	$varloginid="";
	$varpassword="";
	$varmobileno="";
	$varactive="";
		
	include "connection.php";

		function random_password( $length = 8 ) 
        {
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
                $password = substr( str_shuffle( $chars ), 0, $length );
                return $password;
        }

        function email_send($to,$sub,$msg)
        {
            $to_email=$to;
            $subject=$sub;
            $message=$msg;
            $heders="From: ";

            if(mail($to_email,$subject,$message,$heders))
            {
              echo "<script> alert('E-Mail Send  To you , Check your inbox '); </script>";
            }
            else
              echo "<script> alert('Your Internet connection is not Working '); </script>";
        }
        function encrypt($string)
       {
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; 
        $secret_iv = '5fgf5HJ5g27'; // user define secret key
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
       
        $output = openssl_encrypt($string, $encrypt_method, $key, 0,$iv);
        $output = base64_encode($output);
      
       return $output;
       }

	if(isset($_POST['btnsub']))
	{
		$varuname= $_POST['txtuname'];
		$varloginid=$_POST['txtid'];
		 $pass1=random_password(8);
            $varpassword=encrypt($pass1);
		//$varpassword=$_POST['txtpass'];
		$varmobileno=$_POST['txtpno'];
		$varactive="yes";


		
		$dt=date("y-m-d ");
	
		
		$sqlins="INSERT INTO tab_user
		(user_name,login_id,password,mobile_no,active,creation_date)
		VALUE('$varuname','$varloginid','$varpassword','$varmobileno','$varactive','$dt')";
		if  (!mysqli_query($conn,$sqlins))
		{
			die('Error:'. mysqli_error($conn));
		}
		echo "1 record added ";
		 $msg1= " Hello $varuname,\n\n Welcome to Bloosom Bakery  ,  \n\nYour login Password is : $pass1  ";
         email_send($varloginid," Your Password for Bloosom Bakery Login", $msg1);

		

		mysqli_close($conn);
	}
	?>




 <section class="contact spad">
        <div class="container">
<div class="row">
                <div class="col-lg-4">
                    <div class="contact__text">
                        <h3>Contact With us</h3>
                        <ul>
                            <li>Representatives or Advisors are available:</li>
                            <li>Mon-Fri: 5:00am to 9:00pm</li>
                            <li>Sat-Sun: 6:00am to 9:00pm</li>
                        </ul>
                        <img src="img/cake-piece.png" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contact__form">
                            <div class="row">
            
            <div class="col-sm-12">
				<form active="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="txtname">User Name</label>
						<input type="text"  class="form-control" id="txtuname" name="txtuname" placeholder="enter the name" pattern="[A-Z a-z]{0,}">
					</div>
					<div class="form-group">
						<label for="email">login Id</label>
						<input type="email" class="form-control" id="txtid" name="txtid" placeholder="enter the email" required>
					</div>
					<div class="form-group">
						<label for="pass">Password</label><br/>
						Your System Genrated Password will be send to your given email id , So please provide us Verified Email ID  
					</div>
					<div class="form-group">
						<label for="pass">Mobile No</label>
						<input type="text" class="form-control" id="txtpno" name="txtpno" placeholder="enter the mobile no" required>
					</div>
					<!--  <div>
                        <fieldset class="">
                            <legend class="font-weight-bold"> Active</legend>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="r1" id="r1" value="yes" class="form-check-input" checked>
                                <label class="form-check-label" for="r1">Yes</label>
                            </div> &nbsp; &nbsp; &nbsp; &nbsp;
                            <div class="form-check form-check-inline ml-5">
                                <input type="radio" name="r1" id="r1" value="no" class="form-check-input">
                                <label class="form-check-label" for="r1"> No</label>
                            </div>
                        </fieldset>
                    </div > -->
                   
					
					
					
					 <div class="row">
					 	<div class="col-sm-6">
					 		<button type="sumbit" name="btnsub" class="btn btn-block btn-warning" id="btnsub" name="btnsub">Submit
					 		</button>
					 	</div>
					 		<div class="col-sm-6">
					 			<button type="cncel" name="btnsub" class="btn btn-block btn-primary">cancel
					 			</button>
					 		</div>
					 	</div>
					 </form>
					</div>
				</div>
		</div>
</section>

   
    
   

    <?php

include('footer.php');
?>