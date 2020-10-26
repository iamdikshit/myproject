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
	<title>Daily News</title>
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
<body>

<br><br><br><br>
<center><h1 style="color: black; font-weight: bold;">Daily Stories</h1></center>
<br><br><br>
<?php
 
  $query = "SELECT * FROM daily_update  ORDER BY  id DESC";
  $result = mysqli_query($con, $query) or die(mysqli_error($con));  




  ?>

<div class="container">
  <?php
        while (  $row = mysqli_fetch_array($result)) {
          
          $title= $row['daily'];
          $url = $row['source'];
          // $blog = html_entity_decode($row['blog']);
         

    ?>
  <div class="newsbox">
    <div class="categoryimages" >
      
      
       <a href="<?php echo($url) ;?>"><h5 ><?php  echo $title; ?></h5></a>
       <p>Date: <?php  echo $row['date']; ?></p>
        
        
        <br>
     
    </div>

  </div>
  <br>
<?php 
}
 ?>
</div>

<br><br><br>

<?php
require("includes/footer.php");
?>
</body>
</html>