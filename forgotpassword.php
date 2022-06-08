<?php
 // session_start();
 // ob_start();
include'header.php';

?>

<?php
  include 'connection.php';


 $varlogin="";




  function random_password( $length = 8 ) 
        {
                $chars = "abcdefghjklmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ123456789";
                $password = substr( str_shuffle( $chars ), 0, $length );
                return $password;
        }

        function email_send($to,$sub,$msg)
        {
            $to_email=$to;
            $subject=$sub;
            $message=$msg;
            $heders="From: ";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

            if(mail($to_email,$subject,$message,$headers))
            {
              echo "<script> alert('E-Mail Send  To you , Check your inbox '); </script>";
            }
            else
              echo "<script> alert('Your Internet connection is not Working '); </script>";
        }


         if(isset ($_POST['btn2']))
 {
    
     $varlogin=$_POST['txtid'];
     $varpass=random_password(8);
      $varpass1=$varpass;
     // $Member_ID=$_POST['txtid'];

 $sqlchk="SELECT * FROM member_registrationtable where Login_ID='".$varlogin."'";
 
    $result=mysqli_query($con,$sqlchk);
    $rowcount= mysqli_num_rows($result);
    if($rowcount==1)
    {
       
       $sql="UPDATE member_registrationtable set Password='".$varpass1."' 
  WHERE Login_ID='".$varlogin."'";


       if(!mysqli_query($con, $sql))
       {
          die('error:'.mysqli_error($con));
       }
       //echo"1 record added";
         else
          {
              $msg1= " Hello <b style='color:red; '> $varlogin </b>,<br/><br/> Welcome to E-Media Library  ,<br/><br/> <b>Your login ID is :</b><b style='color:red;'> $varlogin </b> ,<br/><br/><b> Your login Password is :<b style='color:red; '>  $varpass1 </b>,<br/><br/> ";
                 email_send($varlogin," Your forgot Password for E-Media Library Login", $msg1);

       } 
   }
   
     else
   {
 echo "<h3> Kindly Enter Registered Email Id  !!!";
 }
     
 }
 ?>
   <section class="page-banner services-banner">
            <div class="container">
                <div class="banner-header">
                    <h2>Forgot Password</h2>
                    <span class="underline center"></span>
                   <!--  <p class="lead">Proin ac eros pellentesque dolor pharetra tempo.</p> -->
                </div>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="index-2.php">Home</a></li>
                        <li>Forgot Password</li>
                    </ul>
                </div>
            </div>
        </section>

  <div class="container-fluid "  >
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 div1"  >

           


       
        <form id="f1" name="f1" method="POST" action="<?php echo
        $_SERVER['PHP_SELF']; ?>" >
        <br/>
<!-- <h1 style="text-align: center;"><b><span class="glyphicon
    glyphicon-lock"></span> Login</b></h1><br/> -->
    <div class="form-group row">
       <label for="example-text-input" class=" col-form-label
       col-sm-3">Login </label>
       <div class="col-sm-9">
           <input class="form-control" name="txtid" type="email"
           id="txt1" required>
       </div>
   </div>
   <div class="form-group row">
       <label for="example-password-input" class="col-form-label
       col-sm-3">Password</label>
       <div class="col-sm-9">
        please provide valid email id. As your new password will be send on it

    </div>
</div><br>
<div class="form-group row">
   <div class="col-sm-12 text-center">
       <button type="submit" class="btn btn-info" name="btn2"
       style="height: 110%;">Forgot</button>
        <!--  <a href="forgotpassword.php">Forgot Password</a> -->
   </div>
</div><br>

</form>

</div>
</div>
</div>
<?php

include 'footer.php';

?>