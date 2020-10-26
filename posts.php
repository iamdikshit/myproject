
<?php
require("includes/common.php");

?>
<?php 
        if(isset($_GET['post_url']))
        {
        $post_url =  mysqli_real_escape_string($con,$_GET['post_url']);
        // echo($post_url);
        $query = "SELECT * FROM post WHERE post_url ='" . $post_url . "'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $id = $row['id'];

        $query1 = "SELECT * FROM headlines WHERE post_id ='" . $id . "'";
        $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
        $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

           
      

        }
        else
        {
            echo("<script>location.href='index'</script>");
        }
 ?>


<!DOCTYPE html>
<html>
<head>
    <title>Stories</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
 -->

  <link href="https://fonts.googleapis.com/css?family=B612+Mono|Cabin:400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../fonts/icomoon/style.css">



  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/jquery-ui.css">
  <link rel="stylesheet" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" href="../css/owl.theme.default.min.css">
  <link rel="stylesheet" href="../css/owl.theme.default.min.css">

  <link rel="stylesheet" href="../css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="../css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="../css/aos.css">
  <link href="../css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../static/style.css">

<style>
  
#related{
  color: black;

}
#related:hover{

 color: green;
}

  .parallelogram{
    width: auto;
  background-color: black;
  
  /*margin-right: 100px;*/
  /*position: absolute;*/
  transform: translate(-50%, -50%);
  transform: skew(20deg);

}

#tags{
  padding-top: 0px;
  padding-bottom: 0px;
  padding-left: 5px;
  padding-right: 5px;
  border-radius: 15px;


}

 #top_container{
    margin-top: 100px;
  }

@media  (max-width: 768px) {
  h1,h2{
    font-size: 24px;
  }


  #top_container{
    margin-top: 10px;
  }


#post_img{
width: 100%;
}
}
</style>

</head>


<?php
require("includes/post_head.php");
?>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

<div class="container" id="top_container">
  <div class="row">
    
    <div class="col-md-8">
    <div class="container"  >
        <center><h1 style="color: black;"><?php echo  $row['title']?></h1></center>

        <p><i><?php echo $row['date']." ".$row['upload_time'] ?></i></p>
        <p><i><?php echo " By: ". $row['author']?></i></p>

        </div>
        <div class="container" >
         <img class="img-fluid" src="../headlines_image/<?php echo($row1['headline_image'])?>" id = 'post_img' width = 50% style = 'float: left; margin-right: 10px ; margin-bottom: 10px;' >
         <?php echo html_entity_decode($row['blog'])?>
        

        </div>
        
        
    
    </div>

    <div class="col-md-4">

      <br>
      <br>

      <div class = 'container' >
        <div class="parallelogram"  >
      <h2  style="color: white;margin: 10px; transform:skew(-20deg);">Tags</h2>
      </div>
      <br>
      <?php 
      $myString = $row['tags'];
      $tags = explode(',', $myString);
      ?>
      <?php 
      foreach ($tags as $tag) { ?>
      
      <?php 
        if (!empty($tag))

         { ?>

          <a id = 'tags' href = '../search.php?search=<?php echo $tag ?>' class = 'btn btn-primary' style="margin: 2px; text-transform: capitalize;" >
            <span style="font-size:10px; "><?php echo $tag; ?></span></a>

         
    <?php    }

      else{

      ?>     
       <p style="color: black;">No Tags.......</p>
    <?php 

     } 
      ?>


      <?php  } 
      ?>
      </div>
       <hr style="width:100%; height: 2px;text-align:left;margin-left:0; color:black;"> 
      <br>
            <!-- +++++++++++++++++++++++++++++++++++++++ -->
                   
<?php
            $query1 = "SELECT * FROM polls WHERE post_id = '$id' ";
            $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
            $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result1); 
   
?>

          
<?php
        if($count==1){

            $query2 = "SELECT * FROM poll_answer WHERE poll_id = '$id' ";
            $result2 = mysqli_query($con, $query2) or die(mysqli_error($con));


?>
    
                
                    <div class="pollbox" id="<?php echo $id ?>">
                        <div class="container">
                          
                            <center><h2   style="color: black;"> <?php echo $row1['poll_title']; ?> </h2></center>
                            
                            <br>
                            <center><p>Description: <?php echo $row1['description']; ?></p></center><br>
                            <center>
                              <div class="container">
                                  <form action="../vote.php" method="POST">
                                <?php 
                                     while($row2 = mysqli_fetch_array($result2)){ 
                                ?>
                                   
                                    
                                    <button type="submit" class="btn btn-primary" id="button" value="<?php echo $row2['id'] ?>" name="id" style="margin: 5px" ><?php echo $row2['title']; ?></button> 
                                   
                              <?php }?>
                                  </form>
                             </div>
                            </center>
                        </div>
                        <br><br>
                    </div>

                 
<?php 
}
?>         
<!-- ++++++++++++++++++++++++++++ End  +++++++++++ -->
            <br>
             <?php if(!empty($row['code'])) 
          {
         ?>
          <div class="container" id="discussionbox">
            <center><h1 style="color: black;">Discussion</h1></center>
             <?php echo html_entity_decode($row['code'])?>
          </div>
        <?php
          }
          ?>


<!-- ++++++++++++++++++++ related topic +++++++++++ -->
          <?php 

            $myString = $row['tags'];
            $tags = explode(',', $myString);
           // echo $myString;

           $a=array();
           
           foreach ($tags as $tag) {
             $tag = "'%".$tag."%'";

              array_push($a,$tag);
           }
           // print_r($a);
           $word = '';
           for ($i=0; $i < count($a); $i++)  {
             
            if ($i < count($a)-1) {
            $word = $word."tags LIKE ".$a[$i]." OR ";
            }
            else{
              $word = $word."tags LIKE ".$a[$i];
            }
            
              // array_push($a,$tag);
           }
          


          ?>
            <div class="container">
              <div class="parallelogram">
              <h2 style="color: white;margin-left: 20px; transform:skew(-20deg);">Related</h2>
              </div>
              <br>
              <div class="container">

                <table>
                <?php 
                  $query5 = "SELECT * FROM post WHERE $word ";
                  $result5 = mysqli_query($con, $query5) or die(mysqli_error($con));
                  $count5 = mysqli_num_rows($result5); 
                 if ($count5 <=1) { ?>

                   <p>No related post....</p>
              <?php
                  } 

                  else
                  {

                
                 $num = 0;
            while ( $row5 = mysqli_fetch_array($result5)) { 
                      
                ?>
                <?php if ($row5['title']!= $row['title'])
                {
                     $num = $num +1;
                  ?>

                      <tr>
                        <td>
                           <a href="../posts/<?php echo($row5['post_url'])?>" id = 'related'><span><?php echo $num."-"; ?></span><?php echo $row5['title'];?></a>
                        </td>
                      </tr>
                     
               <?php } ?>  <!-- end if condition -->
              <?php  }   ?> <!-- end for loop -->
              <?php  }   ?> 
             </table>
              </div>
            </div>  





</div>
 </div>
 </div>  
 <br>



<br><br>
<?php
  
        $sql = "SELECT source FROM post WHERE post_url ='" . $post_url . "'";
        $res = mysqli_query($con, $sql) or die(mysqli_error($con));
        $rows = mysqli_fetch_array($res, MYSQLI_ASSOC);
        // $source = $rows['source'];

?>

 <div class="container" id="disclaimer">
  <center><h3>Disclaimer</h3></center>
   <p>The content and views shared by this post is purely unbiased and a editorial point of view, nothing more has been written on this platform other than that of which has been reported by various independent media sources. Anything that has been written can be backed up by various references given below.</p>

   <p>Sources:<br>
    <?php 
        $source = isset($rows['source']) ? explode(PHP_EOL, $rows['source']) : '';
     
        foreach ($source as $source) {
      
     ?>
     <a href="<?php echo $source; ?>"><p><?php echo $source; ?></p></a><br>
      <?php
    }
      ?>
   </p>
 </div>

<br><br><br>

<?php
require("includes/footer.php");
?>



</body>
</html>


     