<?php
require("includes/common.php");

?>
<?php
function create_slug($string){
   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   return $slug;
}
?>

<!-- <?php 
 if(isset($_POST['daily_update']))
 {  
    date_default_timezone_set("Asia/Kolkata"); 

 
  $title = mysqli_real_escape_string($con, filter_input(INPUT_POST,'title'));
  $editor = mysqli_real_escape_string($con, filter_input(INPUT_POST,'editor')); 
  $category = mysqli_real_escape_string($con, filter_input(INPUT_POST,'category'));
  $tags = mysqli_real_escape_string($con, filter_input(INPUT_POST,'tags'));  
  $date = mysqli_real_escape_string($con, filter_input(INPUT_POST,'date'));
  $blog = mysqli_real_escape_string($con, filter_input(INPUT_POST,'editor1'));
  $code = mysqli_real_escape_string($con, filter_input(INPUT_POST,'code'));
  $source = mysqli_real_escape_string($con, filter_input(INPUT_POST,'source'));

  $image_name = mysqli_real_escape_string($con, filter_input(INPUT_POST,'image_name'));
  $brief = mysqli_real_escape_string($con, filter_input(INPUT_POST,'brief'));



  $post_url = create_slug($title);
  $blog = htmlentities($blog);
  $code = htmlentities($code);
  $source = htmlentities($source);

 	  

 }
 else
 {
 	$title = "";
    $author = "";
    $blog = "";
    $code  = "";
    $source = "";
    $image_name = "";
    $brief = "";
    $tags = "";
 }

?> -->

<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
  <script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


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
<body>
	<?php include 'includes/adminheader.php'; ?>

<?php
if (isset($_SESSION['email_id']))
{ ?>


<!-- +++++++++++++++++ Daily Reports +++++++++++++++ -->

<br>
<div class="container">
  <div class="row">

    <div class="col-lg-4" style="border-radius: 15px;box-shadow: 0 0 20px 0 rgba(0,0,0,0.3);">
        <br>
        <div class="container">
        <center><h2>Management Area</h2></center>
      </div>
      <!-- ------------------------DELETE POST -------------------- -->
      <br>
      <div class="container">
        <!-- <br><h4>All POST</h4> -->
        <h6 style="color: red">Delete Post (ctrl + select)</h6>

      </div>
      <div class="container">
        <form action="delete_post_script.php" method="POST">
        <select id="post_delete" name="post_delete[]" multiple class="form-group">
            <?php $query = "SELECT * FROM post";
                  $result = mysqli_query($con, $query) or die(mysqli_error($con));

                  while ($row = mysqli_fetch_array($result)){ ?>

                <option value="<?php echo $row['title'] ?>"><?php echo $row['title'] ?></option>
            <?php } ?>
  
           </select>

           <div class="form-group">
            <input type="submit" value="Delete" name="delete">
           </div>
           
          </form>
      </div>

      <!-- +++++++++++++++++++++++++++++EDIT POST+++++++++++++++++++++ -->
        <br>
      <div class="container">
        <!-- <br><h4>All POST</h4> -->
        <h5 style="color: green">Edit Post</h5>
      </div>
      <div class="container">
        <form action="" method="POST">
        <select id="edit_post" name="edit_post" class="form-group">
            <?php $query = "SELECT * FROM post";
                  $result = mysqli_query($con, $query) or die(mysqli_error($con));

                  while ($row = mysqli_fetch_array($result)){ ?>

                <option value="<?php echo $row['title'] ?>"><?php echo $row['title'] ?></option>
            <?php } ?>
  
           </select>

           <div class="form-group">
            <input type="submit" value="Edit" name="edit">
           </div>
           
          </form>
      </div>
      <!-- ++++++++++++++++++++++++++end edit reports++++++ -->
    </div>
<!-- +++++++++++++++++++++++ end col +++++++++++ -->
    <div class="col-lg-8" style=" border-radius: 15px;box-shadow: 0 0 20px 0 rgba(0,0,0,0.3);">
     <br><h3>Daily Reports</h3>
  <form action="daily_update.php" method="POST">
    
  <br>
  <div class="form-group">
          <label style="font-weight: bold;">Featured Image</label>
            <input type="file" name="img" >
        </div>
    
          <div class="form-group">
            <label style="font-weight: bold;">Discription</label>
          <textarea id="summernote" name="editor1"  style="height:200px" ><?php echo $blog ; ?></textarea>
          </div>

           <div class="form-group">
          <label style="font-weight: bold;">Editor</label>
            <input type="text" name="editor"  placeholder="First Name">
        </div>

         <script>
                CKEDITOR.replace( 'editor1',{
                  
                } );
            </script>

         <div class="form-group">
          <label style="font-weight: bold;">Tags</label>
            <input type="text" name="tag" placeholder="Saperated By Comma (,)" >
        </div>
         <div class="form-group">
          <label style="font-weight: bold;">Date</label>
            <input type="Date" name="date" >
        </div>

          <div class="form-group">
           <input type="submit" name="daily_update" value="Daily Update">
        </div>

  </form>

    </div>
    
  </div>
</div> 






<?php } 
 
 else {

  ?>
 echo("<script>location.href='admin_login.php'</script>");

  <?php } ?>