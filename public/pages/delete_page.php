<?php


include '../../backend/db_conn.php';


// DELETE FROM table_name WHERE condition;


if (isset($_GET['id']) && isset($_GET['status']) && isset($_GET['pos'])) {
  $del_id = $_GET['id'];
  $status_del = $_GET['status'];
  $position = $_GET['pos'];

  $query_1 = "DELETE FROM players WHERE id = $del_id;";

  $query_gk_2 = "DELETE FROM goolkeeper WHERE id_player = $del_id;";

  $query_np_2 = "DELETE FROM normal_player WHERE id_player = $del_id;";


  if ($status_del != 'main') {

   
    if ($position == 'GK') {
      mysqli_query($conn, $query_gk_2);

      mysqli_query($conn, $query_1);


    }else{
      mysqli_query($conn, $query_np_2);
      
      mysqli_query($conn, $query_1);
    
      
    }
    
    header('location:admin.php');

    

  }else{
    
    echo 'you cant delete main player';

  }
    


}



?>