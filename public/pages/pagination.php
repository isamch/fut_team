<?php 

  include '../../backend/db_conn.php';



  $query = "SELECT players.id , players.club_id, players.nationality_id
  FROM players
  LEFT JOIN goolkeeper ON goolkeeper.id_player = players.id
  LEFT JOIN normal_player ON normal_player.id_player = players.id
  LEFT JOIN clubs ON clubs.id = players.club_id
  LEFT JOIN nationality ON nationality.id = players.nationality_id
  order by players.id ASC;";



  $team_id = [];


  $startindx = 0;
  $row_per_page = 4;

  $row_number = 0;






  $result = mysqli_query($conn, $query);






  if ($result) {
  while ($row = mysqli_fetch_array($result)) {
    $row_number++;
    $team_id[] = $row['club_id'];
    $nationality_id[] = $row['nationality_id'];

    
  }
  } else {
  echo "error fetch : " . mysqli_error($conn);
  }

  $page_number = floor($row_number/$row_per_page);

  if (isset($_GET['page-nbr'])) {
    $startindx = $row_per_page * ($_GET['page-nbr']-1);
    if ($startindx + $row_per_page != $row_number && $_GET['page-nbr'] == $page_number) {
      $row_per_page = $row_number - $startindx;
    }
  }




  
  $number_team = count(array_unique($team_id));
  
  $nationality_team = count(array_unique($nationality_id));



?>