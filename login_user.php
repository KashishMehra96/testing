<?php
session_start();
ob_start();
include('header.php');
?>
    <?php
    
        $login_id="";
        $password="";

include 'connection.php';
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

        function decrypt($string)
       {
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; 
        $secret_iv = '5fgf5HJ5g27'; // user define secret key
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
       
        $output = openssl_decrypt(base64_decode($string),$encrypt_method, $key, 0, $iv);
      
       return $output;
       }       
        if(isset($_POST['btn2']))
        {
            $login_id=$_POST['login_id'];
            $password=$_POST['password'];

                include 'connection.php';
echo $sqllogin="SELECT * FROM tab_user where login_id='".$login_id."'";
                $result=mysqli_query($conn,$sqllogin);
                $rowcount= mysqli_num_rows($result);
               if($rowcount!=0)
               {
                if($row=mysqli_fetch_array($result))
                {
                     if(decrypt($row['password'])== $password)
                    {
                    $_SESSION['cid']=$row['login_id'];
                    $_SESSION['cname']=$row['user_name'];
                   // $_SESSION['cimg']=$row['image'];
                    
                        header('location:index.php');
                   }
                   else
                    {
                       header('location:wrong_user.php');
                    }

                    
                }
            }

            else
            {
                       header('location:wrong_user.php');
            }
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
                <div class="border border-dark m-4 p-4 sm-6">
                <form id="f1" name="f1" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                    <h1 style="text-align: center;"><b>Login</b></h1><br/>
                    <div class="form-group row">
                        <label for="example-text-input" class=" col-form-label col-sm-2">Login Id</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="login_id" type="login_id" id="login_id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-password-input" class="col-form-label col-sm-2">Password</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="password" type="password" id="password">
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-info " name="btn2">Login</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
                    </div>
                </div>
            </div>

</div>
</section>

   
    
   

    <?php

include('footer.php');
?>