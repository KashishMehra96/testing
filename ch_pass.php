
<?php
include "sidebar.php";
include "topbar.php";
?>


<?php
//session_start();
include('connection.php');

$varold="";
$varnew="";
$varconfrim="";
if (isset($_POST['btn3'])) 
{ 

  $varold=$_POST['oldPassword'];
$varnew=$_POST['newPassword'];
$varconfrim=$_POST['confirmPassword'];


	$SQL="SELECT * FROM faculty_registration where Login_Id ='".$_SESSION['fid']."' and Password='".$varold."'";
	$result=mysqli_query($con,$SQL);
 $count=mysqli_num_rows($result);
 if($count!=0)
 {	


 $sqlupd= "UPDATE faculty_registration set Password='" . $_POST["newPassword"] . "' , status='Active'
  WHERE Login_Id='".$_SESSION['fid']."'";
	  mysqli_query($con,$sqlupd);
	  
	  echo "<script>
                alert('Change Password Succesfully.');
              
                </script>";
                
   // header("Location:index.php");
    } else
      echo "<script>
                alert('Given Old Password is not correct');
              
                </script>";


      //  $message = "New Password is not correct";
			
}

?>






<div class="modal fade" id="orangeModalSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header text-center">
        <h4 class="modal-title white-text w-100 font-weight-bold py-2" style="color:#03C;">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      
          <form name="frmChange" autocomplete="off" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

      <div class="modal-body">
          <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text" style="color:#333;"></i>&nbsp;&nbsp;
                     <label data-error="wrong" data-success="right" for="form3" style="color:#009;">Old Password</label>                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="password" name="oldPassword" id="oldPassword"
                        class="txtField" autocomplete="off" required/>
        </div>
        
      
      
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text" style="color:#333;" ></i>&nbsp;&nbsp;
                     <label data-error="wrong" data-success="right" for="form3" style="color:#009;">New Password</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="password" name="newPassword" id="newPassword"
                        class="txtField" autocomplete="off" required/>
        </div>
        
        
                <div class="md-form">
          <i class="fas fa-user prefix grey-text" style="color:#333;"></i>&nbsp;&nbsp;
                <label data-error="wrong" data-success="right" for="form2" style="color:#009;">Confirm Password</label>&nbsp;&nbsp;
                <input type="password" name="confirmPassword"
                    class="txtField"  id="confirmPassword"  required  onblur="matchPassword()" /><br/><br/>
                    
               <div class="md-form" style="text-align:center;">
                   <input type="submit" name="btn3"
                        value="Submit" class="btn btn-primary">
            
        </div>
        
        
<!--        
          <input type="text" id="form3" class="form-control validate">
          <label data-error="wrong" data-success="right" for="form3">Your name</label>
        </div>


          <input type="email" id="form2" class="form-control validate">
          <label data-error="wrong" data-success="right" for="form2">Your email</label>-->
        </div>
      </div>
</form>
      <!--Footer-->
      <div class="modal-footer justify-content-center">
    <!--    <a type="button" class="btn btn-outline-warning waves-effect">Send <i class="fas fa-paper-plane-o ml-1"></i></a>-->
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>

<div class="text-center">
  <a href="" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#orangeModalSubscription">Change Password</a>
</div>
<br/><br/>



<script>  
function matchPassword() {  
  var pw1 = document.getElementById("newPassword").value;  
  var pw2 = document.getElementById("confirmPassword").value;  
  if(pw1 != pw2)  
  {   
    alert("Passwords did not match");  
  } 
}  
</script>  



<?php
include "footer.php";

?>
