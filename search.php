<?php
require("includes/common.php");
?>

<?php
function create_slug($string){
   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   return $slug;
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Search</title>
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
require("includes/head.php");
?>
<br><br><br>

 <?php
                if(isset($_GET['search']))
                { 

  ?>
  <?php
                    $search = mysqli_escape_string($con, $_GET['search']);
                    if($search == "")

                    {
                      header('loaction:index.php');
  ?>
                      
<?php
                    }
                    else
                    {
 ?>
 <?php
                      $query5 = "SELECT * FROM post WHERE title LIKE '%$search%' ";
                      $result5 = mysqli_query($con, $query5) or die(mysqli_error($con));  
                     
                      $count5 = mysqli_num_rows($result5); 

?>

                      <div class="container">
                        <h4 style="color: black;"><?php echo $count5; ?> Results found for <?php echo $search; ?></h4>
                        <br>
                     
 <?php

                    // +++++++++++++++++++++++++++++++++++ start of while loop +++++++++
                      while ( $row5 = mysqli_fetch_array($result5)) 
                      {
    ?>
                      <div class="newsbox">
                        <br>
                        <a href=""><p><?php echo $row5['title'];?> </p></a>
                        <br>
                   </div>



      <?php

          }
         ?>
                  </div>
                        
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++ end of while +++++++++++++++ -->
              <?php

                }
                ?>
          <?php
           }
          ?>
</body>
</html>