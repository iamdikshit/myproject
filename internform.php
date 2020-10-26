<?php
require("includes/common.php");

?>
<?php

if(isset($_POST['submit']))
{
  $full_name = mysqli_real_escape_string($con, filter_input(INPUT_POST,'full_name'));
  $email = mysqli_real_escape_string($con, filter_input(INPUT_POST,'email')); 
  $phone = mysqli_real_escape_string($con, filter_input(INPUT_POST,'phone')); 
  $dob = mysqli_real_escape_string($con, filter_input(INPUT_POST,'dob'));
  $address = mysqli_real_escape_string($con, filter_input(INPUT_POST,'address'));
  $college = mysqli_real_escape_string($con, filter_input(INPUT_POST,'college'));
  $graduation_year = mysqli_real_escape_string($con, filter_input(INPUT_POST,'graduation_year'));

  $resume = mysqli_real_escape_string($con, filter_input(INPUT_POST,'resume'));
  $photo = mysqli_real_escape_string($con, filter_input(INPUT_POST,'photo'));
  $field = mysqli_real_escape_string($con, filter_input(INPUT_POST,'field'));
  $course = mysqli_real_escape_string($con, filter_input(INPUT_POST,'course'));
  $view_on_internship = mysqli_real_escape_string($con, filter_input(INPUT_POST,'view_on_internship'));
  $social_media = mysqli_real_escape_string($con, filter_input(INPUT_POST,'social_media'));
  $t_and_c = mysqli_real_escape_string($con, filter_input(INPUT_POST,'t_and_c'));



// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


$query5 = "SELECT * FROM interns WHERE email = '" . $email . "'";
$result5 = mysqli_query($con, $query5) or die(mysqli_error($con));  
$row5 = mysqli_fetch_array($result5, MYSQLI_ASSOC);
$count5 = mysqli_num_rows($result5); 

 $targetfolder = "intern_resume/";

 $targetfolder = $targetfolder . basename( $_FILES['resume']['name']) ;

 $file_type=$_FILES['resume']['type'];

if ($file_type=="application/pdf"){

  move_uploaded_file($_FILES['resume']['tmp_name'], $targetfolder);

}
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  
     function GetImageExtension($imagetype){
    if(empty($imagetype)) return false;
    switch($imagetype){
    case 'image/bmp': return '.bmp';
    case 'image/gif': return '.gif';
    case 'image/jpeg': return '.jpg';
    case 'image/png': return '.png';
    
    default: return false;
    }
    }

   if (!empty($_FILES["photo"]["name"])) {
      $file_name=$_FILES["photo"]["name"];
      $temp_name=$_FILES["photo"]["tmp_name"];
      $imgtype=$_FILES["photo"]["type"];
      $ext= GetImageExtension($imgtype);
      $imagename=$full_name.$ext;
      $target_path = "intern_resume/".$imagename;


      if(move_uploaded_file($temp_name, $target_path)){
        // Make a query to save data to your database.

       $query4 = "INSERT INTO interns (id,$full_name,email,phone,dob,address,college) VALUES('" . $post_id . "','" . $title . "','". $imagename ."','". $activation ."')";
      mysqli_query($con, $query4) or die(mysqli_error($con));

      echo"<script>alert('Post is Uploaded in database successfully')</script>";
        echo("<script>location.href='admin.php'</script>");

      }
    }
      
      
   


}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Internship form</title>
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

<?php
require("includes/head.php");
?>


<body >



<!-- Modal -->
<div class="modal fade" id="termsandcondition" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Terms And Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- ++++++++++++++++++++++++++++++++++++++ -->
<div class="site-body">
<div class="container-fluid" id="container_form">
  <br>
  <!-- +++++++++++++++++++++++++ form +++++++++++++++ -->
  <form action="" method="post"  class="col-lg-6 offset-lg-3">
    <!-- ++++++++++++ Name ++++++++++++++++++++++++++= -->
  <div class="form-group">
    <label for="exampleFormControlInput1">Full Name:</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" required="true" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" required="true" name="full_name">
  </div>
  <!-- +++++++++++++++++++ Email ++++++++++++++++++++ -->
   <div class="form-group">
    <label for="exampleFormControlInput1">Email address:</label>
    <input type="text" id="eaddress" class="form-control form-control-lg" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  name="email" required = "true">
  </div>
  <!-- +++++++++++++++++++++++++++ Date++++++++++++++++ -->
  <div class="form-group">
    <label for="exampleFormControlInput1">Date of Birth:</label>
    <input type="date" class="form-control" id="exampleFormControlInput1" required="true"  name="dob">
  </div>
  <!-- +++++++++++++++++++++++++++ phone+++++++++++ -->
  <div class="form-group">
    <label for="exampleFormControlInput1">Phone:</label>
    <input type="tel" class="form-control" id="exampleFormControlInput1" required="true" pattern="^\d{10}$" name="phone">
  </div>
  <!-- ++++++++++++++++++++++++++++++++++++++++ -->
    <div class="form-group">
    <label for="exampleFormControlInput1">Address:</label>
    <textarea id="address" name="address" required="true"></textarea>
  </div>
  <!-- +++++++++++++++++++++++++++++ -->
   <div class="form-group">
    <label for="exampleFormControlInput1">Upload Resume:</label>
    <input type="file"  required="true" name="resume">
  </div>
  <!-- +++++++++++++++++++++++++++++++++++++++++ -->
  <div class="form-group">
    <label for="exampleFormControlInput1">Upload Photo:</label>
    <input type="file"  required="true" name="photo">
  </div>
  <!-- ++++++++++++++++++++++++++++++++++++++++ -->
  <div class="form-group">
  <label for="exampleFormControlInput1">Fields:</label><br>
  <input type="checkbox" id="Content Management Team" name="field" value="Content Management Team" checked>
  <label for="Content Management Team"> Content Management Team</label><br>

  <input type="checkbox" id="Website Development Team" name="field" value="Website Development Team" >
  <label for="Website Development Team">Website Development Team</label><br>

  <input type="checkbox" id="Graphics Designer Team " nname="field" value="Graphics Designer Team " >
  <label for="Graphics Designer Team ">Graphics Designer Team</label><br>

  <input type="checkbox" id="Social Media Team " name="field" value="Social Media Team" >
  <label for="Social Media Team ">Social Media Team </label><br>

  <input type="checkbox" id="Marketing Team " name="field" value="Marketing Team " >
  <label for="Marketing Team ">Marketing Team </label><br>
  </div>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="form-group">
    <label for="exampleFormControlInput1">College:</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" required="true" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="college">
  </div>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="form-group">
    <label for="exampleFormControlInput1">Graduation Year:</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" required="true" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="graduation_year">
  </div>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="form-group">
    <label for="exampleFormControlInput1">Degree/Course :</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" required="true" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="course">
  </div>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
  <div class="form-group">
     <label for="exampleFormControlInput1">Why do you want to intern for us ?:</label>
    <textarea id="address" name="view_on_internship" required="true"></textarea>
  </div>
  <!-- +++++++++++++++++++++++++++++++++++++++++++ -->
  <div class="form-group">
    <label for="exampleFormControlInput1">Social Media Handle :</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" required="true" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="social_media">
  </div>

  <input type="checkbox" id="terms" name="t_and_c" value="accept"  required="true">
  <label for="terms and conditions"><a data-toggle="modal" data-target="#termsandcondition">I agree to these terms and conditions (Click to view the T&C)</a></label><br>

    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
</button>
 -->
  <div class="form-group">
    <input type="submit" value="submit" id="apply_button" name="submit" class="btn btn-primary" disabled="disabled" >
  </div>

</form>
<br>
</div>

</div>
</body>
</html>
<script>
    var checker = document.getElementById('terms');
    var sendbtn = document.getElementById('apply_button');
    // when unchecked or checked, run the function
    checker.onchange = function(){
if(this.checked){
    sendbtn.disabled = false;
} else {
    sendbtn.disabled = true;

}

}
</script> 