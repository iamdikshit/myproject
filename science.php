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
	<title>Science & Technology</title>
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

<br><br><br>
<center><h1 style="color: black; font-weight: bold;">Science & Technology</h1></center>
<br>
<?php
  $global = "Science And Technology";
  $query = "SELECT * FROM post WHERE category = '" . $global . "'";
  $result = mysqli_query($con, $query) or die(mysqli_error($con));  




  ?>

<div class="container">
  <?php
        while (  $row = mysqli_fetch_array($result)) {
          $id = $row['id'];
          $url = $row['title'];
          // $blog = html_entity_decode($row['blog']);
         
          $query1 = "SELECT * FROM headlines WHERE post_id = '" . $id . "'";
          $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
          $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

    ?>
  <div class="newsbox">
     <div class="categoryimages" >

      <a href="posts/<?php echo(create_slug($url)) ;?>"><img id="images" src="headlines_image/<?php echo $row1['headline_image'] ?>" width = 150 height=85 class = 'img-responsive' ></a>
      
       <a href="posts/<?php echo(create_slug($url)) ;?>"><h5 style="color: black;"><?php  echo $url; ?></h5></a>
       <p>Date: <?php  echo $row['date']; ?></p>
        <p>Author: <?php  echo $row['author']; ?></p>
        <a href="posts/<?php echo(create_slug($url)) ;?>">Read more..</a>
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