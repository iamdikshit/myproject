<?php
require("includes/common.php");

?>


<?php 
 if(isset($_POST['edit']))
 {
 	$title  = mysqli_real_escape_string($con,$_POST['edit_post']);
 	$query1 = "SELECT * FROM post WHERE title = '" . $title . "'";
    $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));  
    $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
    $title = $row1['title'];
    $author = $row1['author'];
    $blog = html_entity_decode($row1['blog']);
    $code  = html_entity_decode($row1['code']);
    $source = html_entity_decode($row1['source']);
    $image_name = $row1['image_name'];
    $brief = $row1['brief'];
    $tags = $row1['tags'];

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

?>

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

<br><br><br><br>

 <div class="container" >
 	<div class="row">
 		<div class="col-lg-12" style="border-radius: 15px;box-shadow: 0 0 20px 0 rgba(0,0,0,0.3);"><br>
 			<form action="upload_post.php" method="POST" enctype="multipart/form-data">
 				<div class="container">
 					<center><h2>Write Post</h2></center>
 				</div>
				
				<div class="form-group">
					<label style="font-weight: bold;">Title</label>
   					<input type="text" name="title" value="<?php echo($title)?>">
				</div>

        <div class="form-group">
            <label style="font-weight: bold;">Type:</label>
          <select name="type" id="type">
              <option value="Post">Post</option>
              <option value="Report">Report</option>
          </select>
          </div>
<!-- *++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <div class="form-group">
          <label style="font-weight: bold;">Image Name:</label>
            <input type="text" name="image_name" value="<?php echo($image_name)?>"  pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$">
        </div>   
        <!-- ++++++++++++++++++++++++++++++++++++++ -->

    			<div class="form-group">
    				<label style="font-weight: bold;">author</label>
					<input type="text" name="author" value="<?php echo($author)?>">
    			</div>

    			<div class="form-group">
    				<label style="font-weight: bold;">Date:</label>
					<input type="Date" name="date" ><br><br>
    			</div>
    			<div class="form-group">
    				<label style="font-weight: bold;">Category:</label>
					<select name="category" id="category">
  						<option value="Global News">Global News</option>
  						<option value="Entertainment">Entertainment</option>
  						<option value="Sports">Sports</option>
 						<option value="Politics">Politics</option>
 						<option value="Science And Technology">Science And Technology</option>
 						<option value="General">General</option>
					</select>
    			</div>

                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->

          <div  class="form-group">
          <label for="tags" style="font-weight: bold;">Tags</label>
           
            <textarea id="tags" name="tags"  style="height:200px" ><?php echo $tags ; ?></textarea>
          </div>
          <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    
    			<div  class="form-group">

    				<!-- Addind CK editor -->

    				<label for="blog" style="font-weight: bold;">Blog</label>
    				<!--  <textarea name="editor1"></textarea> -->
    				<textarea id="summernote" name="editor1"  style="height:200px" ><?php echo $blog ; ?></textarea>
    			</div>

           <script>
                CKEDITOR.replace( 'editor1',{
                  // filebrowserUploadUrl:"upload.php",
                  //  filebrowserUploadMethod:"form" 
                } );
            </script>

          <!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->

              <div  class="form-group">
            <label for="Brief" style="font-weight: bold;">Brief Discription</label>
           
            <textarea id="brief" name="brief"  style="height:200px" ><?php echo $brief ; ?></textarea>
          </div>
          <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
          <div  class="form-group">
            <label for="Discussion_Code" style="font-weight: bold;">Discussion Code</label>
           
            <textarea id="code" name="code"  style="height:200px" ><?php echo $code ; ?></textarea>
          </div>
          <div  class="form-group">
            <label for="source" style="font-weight: bold;">News Source</label>
           
            <textarea id="source" name="source"  style="height:200px" placeholder='<p><a href="http://www.google.com" target="_blank">Google</a><br></p>'><?php echo $source ; ?></textarea>
          </div>
    		

    		

    			<div class="form-group">
    	 			<label style="font-weight: bold;">Upload Photo For Headlines:</label>
		 			<input type="file" name="headlineimage">
    			</div>

    			<div class="form-group">
    				<input type="submit" value="Submit">
   				 </div>

	<br><br>


  </form>
 			
 		</div>
 	</div>
</div>
<br><br>
<!-- ------------------------- 	MANAGEMENT AREA 	------------------------------ -->
 		<div class="container">
 			<div class="row">
 		<div class="col-lg-12" style="border-radius: 15px;box-shadow: 0 0 20px 0 rgba(0,0,0,0.3);"><br>
 			<div class="container">
				<center><h2>Management Area</h2></center>
 			</div>
 			<!-- ------------------------DELETE POST -------------------- -->
 			<div class="container">
 				<!-- <br><h4>All POST</h4> -->
 				<h6 style="color: red">Delete Post</h6>

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

 			<!-- +++++++++++++++++++++++++++++++++++Delete or edit Poll+++++++++++++ -->
 			<div class="container">
 				<!-- <br><h4>All POST</h4> -->
 				<h5 style="color: green">Delete or Edit Poll</h5>
 			</div>
 			<div class="container">
 				<form action="edit_delete_pol.php" method="POST">
 				<select id="polls" name="poll" class="form-group">
     				<?php $query = "SELECT * FROM polls";
      					  $result = mysqli_query($con, $query) or die(mysqli_error($con));

       						while ($row = mysqli_fetch_array($result)){ ?>

								<option value="<?php echo $row['poll_title'] ?>"><?php echo $row['poll_title'] ?></option>
     				<?php } ?>
  
   				 </select>

   				 <div class="form-group">
    				
    				<input type="submit" value="Delete Poll" name="delete_poll">
   				 </div>
   				 
   				</form>
 			</div>
 				
 				
 				<!-- --------------------------------- create poll -----------------	 -->

 				<div class="container">
 				<!-- <br><h4>All POST</h4> -->
 				<h6 style="color: green; font-weight: bold;">Create Poll</h6>

 			</div>
 			<div class="container">
 				<form action="create_poll.php" method="POST">
 				<select id="create_poll" name="poll" class="form-group">
     				<?php $query_sql = "SELECT * FROM post";
      					  $result_sql = mysqli_query($con, $query_sql) or die(mysqli_error($con));

       						while ($row_sql = mysqli_fetch_array($result_sql)){ ?>

								<option value="<?php echo $row_sql['title'] ?>"><?php echo $row_sql['title'] ?></option>
     				<?php } ?>
  
   				 </select>

   				 <div class="form-group">
    				<input type="submit" value="Create Poll" name="create_poll">
   				 </div>
   				 
   				</form>
 			</div>

      <!-- ++++++++++++++++++++++++++++++ Delete Daily Stories ++++++++++++++++++++++++++ -->

        <div class="container">
        <!-- <br><h4>All POST</h4> -->
        <h6 style="color: green; font-weight: bold;">Delete Daily stories</h6>

      </div>
      <div class="container">
        <form action="delete_daily_stories.php" method="POST">
        <select id="" name="daily_stories_delete[]" multiple class="form-group">
            <?php $query_sql1 = "SELECT * FROM daily_update";
                  $result_sql1 = mysqli_query($con, $query_sql1) or die(mysqli_error($con));

                  while ($row_sql1 = mysqli_fetch_array($result_sql1)){ ?>

                <option value="<?php echo $row_sql1['daily'] ?>"><?php echo $row_sql1['daily'] ?></option>
            <?php } ?>
  
           </select>

           <div class="form-group">
            <input type="submit" value="Delete stories" name="delete_stories">
           </div>
           
          </form>
      </div>

<!-- +++++++++++++++++++++++++++++++++++++++++++++ End +++++++++++++++++++++++++++++++++++++ -->

 	</div>
</div> 
</div>
</div>

 	
<!-- ------------------------- 	HEADLINE ACTIVATION 	------------------------------ -->

<br><br>

 <div class="container">
 	<div class="row">
 		<div class="col-lg-12" style="border-radius: 15px;box-shadow: 0 0 20px 0 rgba(0,0,0,0.3);">

  <form action="activate_headlines.php" method="POST">
  	<br><h3>Activate Headlines</h3>
	<br>
	<div class="form-group">
    <label for="Headlines" style="font-weight: bold;">Headlines</label><br>
    <label for="instuctions" style="color: red;">ctrl + select</label>
  		<select id="Headlines" name="post_headlines[]" multiple class="form-group">
     <?php $query = "SELECT * FROM headlines";
       $result = mysqli_query($con, $query) or die(mysqli_error($con));

       while ($row = mysqli_fetch_array($result)){ ?>

			<option value="<?php echo $row['post_title'] ?>"><?php echo $row['post_title'] ?></option>
     <?php } ?>
  
    </select>
	</div>
  
	<div class="form-group">
    <input type="submit" name="submit" value="Activate Headlines">
 	</div>

  </form>

 		</div>
 		
 	</div>
</div> 
<br>
<!-- +++++++++++++++++++++++++++++++++++++ Daily Update +++++++++++++++++++++ -->

<div class="container">
  <div class="row">
    <div class="col-lg-12" style=" border-radius: 15px;box-shadow: 0 0 20px 0 rgba(0,0,0,0.3);">
     <br><h3>Daily updates</h3>
  <form action="daily_update.php" method="POST">
    
  <br>
  <div class="form-group">
          <label style="font-weight: bold;">Daily Headlines</label>
            <input type="text" name="daily" >
        </div>
    
          <div class="form-group">
            <label style="font-weight: bold;">Source</label>
          <input type="text" name="source" >
          </div>

          <div class="form-group">
           <input type="submit" name="submit" value="Daily Update">
        </div>

  </form>

    </div>
    
  </div>
</div> 


<!-- +++++++++++++++++ Daily Reports +++++++++++++++ -->

<br>
<div class="container">
  <div class="row">
    <div class="col-lg-12" style=" border-radius: 15px;box-shadow: 0 0 20px 0 rgba(0,0,0,0.3);">
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
            <input type="text" name="editor" >
        </div>
         <div class="form-group">
          <label style="font-weight: bold;">Date</label>
            <input type="Date" name="date" >
        </div>

          <div class="form-group">
           <input type="submit" name="submit" value="Daily Update">
        </div>

  </form>

    </div>
    
  </div>
</div> 


<?php } else
{ ?>
 echo("<script>location.href='admin_login.php'</script>");

<?php }?>


<br><br>		
<?php
require("includes/footer.php");
?>
<!-- <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script> -->

</body>
</html>