<?php
require("includes/common.php");
?>

<!-- ++++++++++++++++++++++++++++++++++++++++++++ google api +++++++++++++= -->

<?php

//index.php

//Include Configuration File
include('config.php');

$login_button = '';

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error']))
 {
  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();

  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
 $login_button = '<a href="'.$google_client->createAuthUrl().'"><img style = "width:50%; hieght:50%;" src="icon/googleicon.png" /></a>';
}

?>

<!-- +++++++++++++++++++++++++++++++++++++++ end +++++++++++++++++++++++++++++++ -->



<?php
function create_slug($string){
   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   return $slug;
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Home Page</title>
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

<script>
  $(document).ready(function(){
    $('#signup').modal('show');
  })
</script>

<style>
  
  .parallogram{
    width: auto;
  background-color: black;
  
  /*margin-right: 100px;*/
  /*position: absolute;*/
  transform: translate(-50%, -50%);
  transform: skew(20deg);

}

.reports{
   width: 50%;
  background-color: black;
  
  /*margin-right: 100px;*/
  /*position: absolute;*/
  transform: translate(-50%, -50%);
  transform: skew(20deg);
}

@media  (max-width: 768px) {
  .reports{
   width: auto;
  background-color: black;
  
  /*margin-right: 100px;*/
  /*position: absolute;*/
  transform: translate(-50%, -50%);
  transform: skew(20deg);
}
</style>

</head>


<?php
require("includes/head.php");
?>


<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" >

<div class="spinner-border" role="status">
  <span class="sr-only">Loading...</span>
</div>
<?php 
if(isset($_SESSION['email']))
{
   $command  = "";
}
else
{
  $command = "signup";
}
?>

<div class="modal fade" id="<?php echo $command ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  action="user_login" method="POST">
          <div class="form-group">
            <b>Email:</b> <input type="email" class="form-control"  placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title=" Use format: username@domain.com"  name="email" required = "true">
          </div>
          <div class="form-group">
             <b>Password:</b><input type="password" class="form-control" placeholder="Password" pattern=".{6,}" name="password" required = "true" autocomplete="of">
          </div>
          <div>
          <?php echo $login_button; ?>
          </div>
        <div class="container">Don't have an account?
        <a href="signup.php">Click here to Sign Up</a></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
      </form>
    </div>
  </div>
</div>

<br><br>
	<?php
			$activating = 1;
			$query = "SELECT * FROM headlines WHERE activation ='" . $activating . "'";
      $result = mysqli_query($con, $query) or die(mysqli_error($con));  
        	
	?>

<div class="container"  style="margin-top: 10px;">
  <center><h1 style=" font-weight: bold;color: black; text-shadow: 2px 5px 5px rgba(0,0,0,0.5);  ">Top Stories</h1></center>
</div>

<div class="container-fluid">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
   
<?php 
		$i = 0;
while ($row = mysqli_fetch_array($result) )
{
	  $i = $i + 1;

	  $url = $row['post_title'];
    $id = $row['post_id'];

    // ++++++++++++++++++++++++++++++++++++++++++++++++++

       $q = "SELECT * FROM post WHERE id ='" . $id . "'";
      $r = mysqli_query($con, $q) or die(mysqli_error($con)); 
      $row_head = mysqli_fetch_array($r, MYSQLI_ASSOC); 
      $brief = $row_head['brief'];


    // +++++++++++++++++++++++++++++++++++++++++++++++++


  	 ?>

  	

  		<?php 
  			if($i == 1)
  			{ 
  				
  		?>
  			

  			<div class="carousel-item active">
      			<!-- <a  href="posts/<?php echo(create_slug($url)) ;?>" class="thumbnail" ><img class="d-block w-100" src="headlines_image/<?php echo $row['headline_image']; ?>" alt="First slide" ></a> -->

<!-- +++++++111++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <div class="site-section" >
          <div class="container" >
            <div class="half-post-entry d-block d-lg-flex bg-light">
              <div class="img-bg" style="background-image: url('headlines_image/<?php echo $row['headline_image']; ?>')"></div>
              <div class="contents">
                <span class="caption">Editor's Pick</span>
                <h2><i><a href="posts/<?php echo(create_slug($url)) ;?>"><?php echo $row['post_title']; ?></a></i></h2>
                <p class="mb-3"><?php echo $brief; ?></p>
                
                <div class="post-meta">
                  <span class="date-read"><?php echo $row_head['date']." ".$row_head['upload_time']; ?>
                </div>

              </div>
            </div>
          </div>
        </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    		</div>
        
    		

  		<?php
  			}
  			 else 
  			 	{
  			 		
  		?>
  				
  			<div class="carousel-item">
     			<!--  <a  href="posts/<?php echo(create_slug($url)) ;?>"  class="thumbnail"><img class="d-block w-100" src="headlines_image/<?php echo $row['headline_image']; ?>" alt="<?php echo $i ?>"></a> -->

           <!-- +++++222++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <div class="site-section">
          <div class="container">
            <div class="half-post-entry d-block d-lg-flex bg-light">
              <div class="img-bg" style="background-image: url('headlines_image/<?php echo $row['headline_image']; ?>')"></div>
              <div class="contents">
                <span class="caption">Editor's Pick</span>
                <h2><i><a href="posts/<?php echo(create_slug($url)) ;?>"><?php echo $row['post_title']; ?></a></i></h2>
                <p class="mb-3"><?php echo $brief; ?></p>
                
                <div class="post-meta">
                  <span class="date-read"><?php echo $row_head['date']." ".$row_head['upload_time']; ?>
                </div>

              </div>
            </div>
          </div>
        </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    			</div>
       

  		<?php
  				} 
  		?>
  	<?php
  		}
  	?>


</div>

  </div>
</div>

<br><br>

<section>
<div class="container">
  <div class="row">
    <!-- ++++++++++++++++++++++++++Daily Stories++++++++++++++++++ -->
     <div class="col-lg-3 col-md-3 col-12" id="daily" >
      <br>
     <center><h4 style="color: black;"><strong>Daily Stories</strong></h4></center>
     <br>
     <?php
        // $sql_query = "SELECT post_id FROM polls WHERE total_vote =(SELECT MAX(total_vote) FROM polls)";
        // $sql_result = mysqli_query($con, $sql_query) or die(mysqli_error($con));  
        // $sql_row = mysqli_fetch_array($sql_result, MYSQLI_ASSOC);
        // $id = $sql_row['post_id'];

        $sql_query1 = "SELECT * FROM daily_update ORDER BY  id DESC LIMIT 3;  ";
        $sql_result1 = mysqli_query($con, $sql_query1) or die(mysqli_error($con));  
        

        // $trending_url = $sql_row1['title'];

        //  $sql_query3 = "SELECT * FROM headlines WHERE post_id ='" . $id . "'";
        //   $sql_result3 = mysqli_query($con, $sql_query3) or die(mysqli_error($con)); 
        //   $sql_row3 = mysqli_fetch_array($sql_result3,MYSQLI_ASSOC);
     ?>
     <div class="container">
            <ul>
      <?php 
          while ( $sql_row1 = mysqli_fetch_array($sql_result1)) {
           
       ?> 
            
              <li>
            <a href="<?php echo($sql_row1['source']) ?>"  ><?php echo $sql_row1['daily']; ?></a>
            </li>
          
      <?php
          }
        ?>
        </ul>
            </div>
            <center><a href="daily" style="font-weight: bold; font-size: 20px;">More..</a></center>
     </div>
     
      <div class="col-lg-1 col-md-1 col-12"></div>
     

    <!-- ++++++++++++++++++++++++++++++++Todays poll++++++++++++++++++++++++++++ -->
    <?php 
      $query3 = "SELECT *FROM polls ORDER BY  post_id DESC LIMIT 1;";
      $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
      $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC); 
      $title = $row3['poll_title'];
      $post_id = $row3['post_id'];

        $query4 = "SELECT * FROM poll_answer WHERE poll_id = '" . $post_id . "'";
        $result4 = mysqli_query($con, $query4) or die(mysqli_error($con));  

        $total_votes = 0;
        while ($row4 = mysqli_fetch_array($result4)) {
          
          $total_votes = $total_votes + $row4['vote'];
        }

      ?>

      <?php
          $query5 = "SELECT * FROM poll_answer WHERE poll_id = '" . $post_id . "'";
          $result5 = mysqli_query($con, $query5) or die(mysqli_error($con)); 
      ?>

    <div class="col-lg-4 col-md-4 col-12" id="poll" >
      <br>
     <center><h3 style="color: black;">Today's Poll</h3></center>
     <br>
     <div class="content poll-result">
  <center><h3 style="font-weight: bold;"><?php echo $row3['poll_title']; ?></h3></center>
  <br>
   <center><p>Description: <?php echo $row3['description']; ?></p></center>

    <div class="wrapper">
      <?php
          if($total_votes!=0)
          {
      ?>
       <?php  while ($row5 = mysqli_fetch_array($result5))

       {
       ?>
        <div class="poll-question">
            <p><?php echo $row5['title']?> <!-- <span>(<?php echo $row5['vote']?> Votes)</span> --></p>
            <div class="result-bar" style= "width:<?php echo round(( $row5['vote']/$total_votes)*100)?>%">
                <?php echo round(($row5['vote']/$total_votes)*100)?>%
            </div>
        </div>
        <?php
        } 
        ?>
        <!-- ++++++++++++++++++++ end of if ++++++++++++++++++++ -->
        <?php
        } 
        else
        {

        ?>

        <?php  while ($row5 = mysqli_fetch_array($result5))

       {
       ?>
        <div class="poll-question">
            <p><?php echo $row5['title']?> <!-- <span>(<?php echo $row5['vote']?> Votes)</span> --></p>
            <div  >

               0%
            </div>
        </div>

        <?php
        } 
        ?>
        <?php
        } 
        ?>

    </div>
    <!-- <br>
    <center><a href="home.php">Go to Home</a></center> -->
</div>
     
    </div>
<div class="col-lg-1 col-md-1 col-12"></div>
<!-- ++++++++++++++++++++++++++++++Recent Post++++++++++++++++++++++++++++++++ -->

    <?php 
      $query1 = "SELECT * FROM post WHERE type = 'Post'  ORDER BY  id DESC LIMIT 2";
      $result1 = mysqli_query($con, $query1) or die(mysqli_error($con)); 
?>
    <div class="col-lg-3 col-md-3 col-12" id="recent">
      <div>
        <center><h4 style="padding: 20px; color: #000;">Recent Post</h4></center>
      </div>
      
      <?php while($row1 = mysqli_fetch_array($result1))

      { ?>
        <?php 
          $url2 = $row1['title'];
          $post_id = $row1['id'];
        

          $query2 = "SELECT * FROM headlines WHERE post_id ='" . $post_id . "'";
          $result2 = mysqli_query($con, $query2) or die(mysqli_error($con)); 
          $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
        ?>
        <div class="thumbnail" style="width: 100; height:200px;" >
          <div>
            <center>
               <h7 style="color: #000; padding: 0px;"><?php echo($url2) ?></h7>
            </center>
           
          </div>
            
        <center>
          <a  href="posts/<?php echo(create_slug($url2)) ;?>" ><img class=" images-responsive"  src="headlines_image/<?php echo($row2['headline_image']) ?>" width = 250 hieght=40  id = "headline_image"></a>
        </div>
        </center>
        
    <?php  } ?>
    </div>
   
  </div>
</div>
</div>
</section>
<br>
<br>




<!-- ++++++++++++++++++++++++++ End 3  division ++++++++++++++++++ -->
<section>
<div class="container">
  <div class="reports">
    <h2 style="color: white;margin-left: 20px; transform:skew(-20deg);">Daily Reports</h2>
  </div>

  <?php

      $query3 = "SELECT * FROM post WHERE type = 'Report'  ORDER BY  id DESC LIMIT 4";
      $result3 = mysqli_query($con, $query3) or die(mysqli_error($con));
      
     

  ?>
  <div class="row">

    <?php

        
        while($row3 = mysqli_fetch_array($result3) ){

            $title = $row3['title'];
            $post_id = $row3['id'];
        

          $query2 = "SELECT * FROM headlines WHERE post_id ='" . $post_id . "'";
          $result2 = mysqli_query($con, $query2) or die(mysqli_error($con)); 
          $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);

    ?>
    <div class="col-md-3">
      <a href="posts/<?php echo(create_slug($title)) ;?>">
      <img src="headlines_image/<?php echo $row2['headline_image']; ?>" class="img-thumbnail" alt="Responsive image">
      </a>
      <div class="caption" style="text-transform: capitalize;">
        <center><p>
          Date: <?php echo $row3['date']?>
        </p>
        <p>
          Editor: <?php echo $row3['author']?>
        </p>
        </center>
      </div>
      <!-- <img src="..." alt="..." class="img-thumbnail"> -->
    </div>

    <?php } ?>
    
 

  </div>
</div>
</section>

<br>
<br>

<!-- ++++++++++++++++++++++++++++++++++ ALL POST ++++++++++++++++ -->

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="container">
      <div class="parallogram"  id="parallogram">
        
            <h2 style="color: white;margin-left: 20px; transform:skew(-20deg);"><strong>Global News</strong> </h2>
    
      </div>
       </div>
      <br>
      <?php
      $global = "Global News";
      $query = "SELECT * FROM post WHERE category = '" . $global . "'";
      $result = mysqli_query($con, $query) or die(mysqli_error($con));  

    ?>

  
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
      
       <a href="posts/<?php echo(create_slug($url)) ;?>" data-toggle="tooltip" title="hello"><strong><p style="color: black;"><?php  echo $url; ?></p></strong></a>
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
   <!-- ++++++++++++++++++++++++++++++++++first col-md-6 end+++++++++ -->
   <div class="col-md-6">
            <div class="container">
      <div class="parallogram"  id="parallogram">
        
            <h2 style="color: white;margin-left: 20px; transform:skew(-20deg);"><strong>General</strong> </h2>
    
      </div>
       </div>
      <br>
      <?php
      $global = "General";
      $query = "SELECT * FROM post WHERE category = '" . $global . "'";
      $result = mysqli_query($con, $query) or die(mysqli_error($con));  

    ?>

  
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
      
       <a href="posts/<?php echo(create_slug($url)) ;?>" data-toggle="tooltip" title="hello"><strong><p style="color: black;"><?php  echo $url; ?></p></strong></a>
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
    <!-- ++++++++++++++++++++++++++++++++++second col-md-6 end+++++++++ -->
  </div>
</div>






<!-- +++++++++++++++++++++++++++++++++++++++++++++++All Post End+++++++++++++ -->


		
<?php
require("includes/footer.php");
?>

	
</body>
</html>