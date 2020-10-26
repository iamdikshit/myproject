<?php
require("includes/common.php");
?>
<?php
        $sql_query = "SELECT post_id, MAX(total_vote) as total_vote FROM polls ";
        $sql_result = mysqli_query($con, $sql_query) or die(mysqli_error($con));  
        $sql_row = mysqli_fetch_array($sql_result, MYSQLI_ASSOC);
        $id = $sql_row['post_id'];

        echo $id;
        $sql_query1 = "SELECT * FROM post WHERE id = '$id' ";
        $sql_result1 = mysqli_query($con, $sql_query1) or die(mysqli_error($con));  
        $sql_row1 = mysqli_fetch_array($sql_result1, MYSQLI_ASSOC);

        $trending_url = $sql_row1['title'];


         $sql_query3 = "SELECT * FROM headlines WHERE post_id ='" . $id . "'";
          $sql_result3 = mysqli_query($con, $sql_query3) or die(mysqli_error($con)); 
          $sql_row3 = mysqli_fetch_array($sql_result3,MYSQLI_ASSOC);
          print_r($sql_row1);
     ?>