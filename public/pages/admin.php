<?php 

  include '../../backend/db_conn.php';


  include './pagination.php';

  $players = [];


  $query = "SELECT players.id, name, photo, position, rating, status, name_clubs, name_nationality,
              diving, handling, kicking, reflexes, speed, positioning, 
              pace, shooting, passing, dribbling, defending, physical
              FROM players
              LEFT JOIN goolkeeper ON goolkeeper.id_player = players.id
              LEFT JOIN normal_player ON normal_player.id_player = players.id
              LEFT JOIN clubs ON clubs.id = players.club_id
              LEFT JOIN nationality ON nationality.id = players.nationality_id
              order by players.id ASC
              limit $startindx, $row_per_page;";


  $result = mysqli_query($conn, $query);

  if ($result) {
      while ($row = mysqli_fetch_array($result)) {
        $players[] = $row;
      }
  } else {
      echo "error fetch : " . mysqli_error($conn);
  }



?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <!-- link -->
  <link rel="stylesheet" href="../assets/styles/style-dash.css">
  <!-- link icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">


  <script src="https://cdn.tailwindcss.com"></script>


</head>

<body>


  <!-- dashboard -->
  <div class="dashboard-status">
    <div class=" flex justify-center items-center h-16 bg-[#123] shadow-md mb-3 rounded">
      <a href="../index.php" class="block">
      <img src="../assets/images/logo/banner.png" alt="Logo" class="max-h-12 max-w-full object-contain">
      </a>
    </div>

    
    <div class="head-dash">
      <p>dashboard</p>
      <img src="../assets/images/icon/icons8-positive-dynamic-50.png" alt="->-">
    </div>

    <!-- panels -->
    <div class="panels mt-2">
      <div class="panel-dashboard">
        <img src="../assets/images/icon/icons8-users-50.png" alt>
        <div>
          <p>Players</p>
          <span>100</span>
        </div>
      </div>

      <div class="panel-dashboard">
        <img src="../assets/images/icon/icons8-felt-pens-60.png" alt>
        <div>
          <p>Team</p>
          <span>35</span>
        </div>
      </div>

      <div class="panel-dashboard">
        <img src="../assets/images/icon/icons8-products-80.png" alt>
        <div>
          <p>Nationality</p>
          <span>325</span>
        </div>
      </div>



    </div>

    <!-- table title -->
    <div class="head-dash">
      <p>Players</p>
      <img src="../assets/images/icon/icons8-users-50.png" alt="->-">
    </div>

    <!-- table -->
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>photo</th>
            <th>positoin</th>
            <th>rating</th>
            <th>team</th>
            <th>nationality</th>
            <th>DIV-PAC</th>
            <th>han-sho</th>
            <th>kic-pas</th>
            <th>ref-dri</th>
            <th>spd-def</th>
            <th>pos-phy</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

        <!-- $query = "SELECT players.id, name, photo, position, rating, status, logo_url, flag_url,
              diving, handling, kicking, reflexes, speed, positioning, 
              pace, shooting, passing, dribbling, defending, physical -->

          
        <?php foreach($players as $player): ?>
          <?php 
             if ($player["position"] == "GK") {

              $playerstats = [
                'DIV' => $player['diving'],
                'HAN' => $player['handling'],
                'KIC' => $player['kicking'],
                'REF' => $player['reflexes'],
                'SPD' => $player['speed'],
                'POS' => $player['positioning']
              ];


            }else{

             
              $playerstats = [
                'PAC' => $player['pace'],
                'SHO' => $player['shooting'],
                'PAS' => $player['passing'],
                'DRI' => $player['dribbling'],
                'DEF' => $player['defending'],
                'PHY' => $player['physical']
              ];

            }
          ?>
          <tr>
            <td>

              <a href="update_page.php?id=<?= htmlspecialchars($player['id'])?>" class="inline-flex items-center text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                <i class="fas fa-edit text-blue-700 group-hover:text-white"></i>
              </a>

              <a href="delete_page.php?id=<?= htmlspecialchars($player['id'])?>&status=<?= htmlspecialchars($player['status'])?>&pos=<?= htmlspecialchars($player['position'])?>" class="group inline-flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                <i class="fas fa-trash text-red-700 group-hover:text-white"></i>
              </a>

            </td>
            <td><?= htmlspecialchars($player['id'])?></td>
            <td><?= htmlspecialchars($player['name'])?></td>
            <td><?= htmlspecialchars($player['photo'])?></td>
            <td><?= htmlspecialchars($player['position'])?></td>
            <td><?= htmlspecialchars($player['rating'])?></td>
            <td><?= htmlspecialchars($player['name_clubs'])?></td>
            <td><?= htmlspecialchars($player['name_nationality'])?></td>

            <?php foreach($playerstats as $stats): ?>
              <td><?= htmlspecialchars($stats)?></td>
            <?php endforeach ?>
      
          </tr>
        <?php endforeach ?>

        </tbody>
      </table>
    </div>

    <!-- page number -->
    <div class="flex flex-col items-center mt-5">
      <!-- Help text -->
      <span class="text-sm text-gray-500 dark:text-gray-400">
        Showing Page <span class="font-semibold text-white dark:text-white">
          <?php 
            if (isset($_GET['page-nbr'])) {
              echo $_GET['page-nbr'];
            }else{
              echo 1;
            }
          ?>
          </span> of <span class="font-semibold text-white dark:text-white"><?= htmlspecialchars($page_number) ?></span>
      </span>
    </div>
    <!-- pagination -->
    <nav aria-label="Page navigation example " class="mt-5 mx-auto">
      <ul class="inline-flex text-base h-10">
        <!-- last -->
        <li class="border-r border-gray-900">
          <a href="?page-nbr=1" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-white bg-[#123] rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            First
          </a>
        </li>

        <!-- previous -->
        <?php 
          if (isset($_GET['page-nbr']) && $_GET['page-nbr'] > 1) {
            ?>
                <li class="border-r border-gray-900">
                <a href="?page-nbr=<?= htmlentities($_GET['page-nbr'] - 1) ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-white bg-[#123] hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                  Previous
                </a>
              </li>

            <?php 
          }else{  
            ?>
              <li class="border-r border-gray-900">
                <a class="flex items-center justify-center px-4 h-10 leading-tight text-white bg-[#123] hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                  Previous
                </a>
              </li>
            <?php 
          }

        ?>
        <!-- numbers -->
        <?php 
          for ($counter=1; $counter <= $page_number; $counter++) { 
            ?>
              <li class="border-r border-gray-900">
                <a href="?page-nbr=<?= htmlspecialchars($counter) ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-white bg-[#123] hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <?= htmlspecialchars($counter) ?>
                </a>
              </li>
            <?php  
          }

        ?>
        <!-- Next -->
        <?php 
          if (isset($_GET['page-nbr']) && $_GET['page-nbr'] < $page_number) {
            ?>
                <li class="border-r border-gray-900">
                <a href="?page-nbr=<?= htmlentities($_GET['page-nbr'] + 1) ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-white bg-[#123] hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                  Next
                </a>
              </li>

            <?php 
          }else{  
            ?>
              <li class="border-r border-gray-900">
                <a class="flex items-center justify-center px-4 h-10 leading-tight text-white bg-[#123] hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                  Next
                </a>
              </li>
            <?php 
          }
        ?>
        <!-- last -->
        <li class="border-r-0">
          <a href="?page-nbr=<?= htmlspecialchars($page_number) ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-white bg-[#123] rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            Last
          </a>
        </li>

      </ul>
    </nav>


  </div>


</body>

</html>