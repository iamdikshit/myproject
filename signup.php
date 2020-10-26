
<?php

require("includes/common.php");

?>


<?php
if(isset($_POST['Submit']))
{
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con,$_POST['password']);
  $password = md5($password);
 
  // $password = md5($_POST['password']);
  $contact = mysqli_real_escape_string($con, $_POST['contact']);
   $regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
   $regex_num = "/^[789][0-9]{9}$/";
 
  $query = "SELECT * FROM user WHERE email='$email'";
  $result = mysqli_query($con, $query)or die(mysqli_error($con));
  $num = mysqli_num_rows($result);


  if ($num != 0) {

     echo"<script>alert('email already exist')</script>";
     echo("<script>location.href='signup.php'</script>");
  
  }

   else if (!preg_match($regex_email, $email)) {
     
     echo"<script>alert('email id not valid')</script>";
     echo("<script>location.href='signup.php'</script>");
  
  }
   
   else if (!preg_match($regex_num, $contact)) {
     
     echo"<script>alert('contact not valid')</script>";
     echo("<script>location.href='signup.php'</script>");
  
  }  
  
   elseif(strlen($password)<6){
    
     echo"<script>alert('length is too short')</script>";    
     echo("<script>location.href='signup.php'</script>");

  }

    
  else{
 
    // session_start();
    $query = "INSERT INTO user (name, email, password,contact) VALUES('" . $name . "','" . $email . "','" . $password . "','" . $contact . "')";
     mysqli_query($con, $query) or die(mysqli_error($con));



    $sql = "select * from user where email = '$email' and password = '$password'";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  


    // $_SESSION['email'] = $email;
    // $_SESSION['id'] = mysqli_insert_id($con);
    // $_SESSION['user_id']=$row['id'];

    header('location: login.php');
  }

}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Sign up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <link href="https://fonts.googleapis.com/css?family=B612+Mono|Cabin:400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">



  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="static/style.css">


</head>





<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" >
<?php

include 'includes/head.php';

?>
    <div class="container" style="margin-top: 100px;margin-bottom: 50px;">
                             <div class="row">
                                <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
                                         <div class="panel panel-default">
                                             <div class="panel-heading"><center><h3>SIGN UP</h3></center></div>
                                                        <div class="panel-body">
              
                             <form method="POST"  action="">
                           
                             
                            
                       <div class="form-group">
                        <b>Name:</b> <input class="form-control" placeholder="Name" name="name"  required="true" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$">

                        </div>
                            
                            
                            
                            
                            
                        <div class="form-group">
                            <b>Email:</b><input type="email" class="form-control"  placeholder="Enter Valid Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="username@domain.com "  name="email" required = "true">
                       </div>
                            
                            
                            
                        <div class="form-group">
                            <b>Password:</b><input type="password" class="form-control" placeholder="Password (Min. 6 characters)" minlength="6" name="password" required = "true">
 
                        
                        </div>
                                 
                                 
                                 
                                 
                        <div class="form-group"> 
                            <b>Contact:</b><input class="form-control"  placeholder="Enter Valid Phone Number (Ex: 9876543210)" minlength="10" maxlength="10" size="10" name="contact" required = "true">
                        </div>
                      
                         <div id="button">   
                         <button type="submit" name="Submit" class="btn btn-block btn-default"  style="background-color: #398a7b; color: white; ">Submit</a></button>
                         </div>
                                  
                    
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    
    <?php

include 'includes/footer.php';


?>
    
</body>
     
</html>