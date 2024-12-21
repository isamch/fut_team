<?php 
  include '../backend/db_conn.php';


  $players = [];


  $query = "SELECT players.id, name, photo, position, rating, status, logo_url, flag_url,
              diving, handling, kicking, reflexes, speed, positioning, 
              pace, shooting, passing, dribbling, defending, physical
              FROM players
              LEFT JOIN goolkeeper ON goolkeeper.id_player = players.id
              LEFT JOIN normal_player ON normal_player.id_player = players.id
              LEFT JOIN clubs ON clubs.id = players.club_id
              LEFT JOIN nationality ON nationality.id = players.nationality_id;";


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
  <title>IcFut | Squad Builder</title>

  <link rel="shortcut icon" href="./assets//images//logo//favicon.png" type="image/x-icon">
  <!-- links -->
  <link rel="stylesheet" href="assets/styles/style.css">

  <!-- cdn -->
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;700&display=swap" rel="stylesheet">

  <!-- flowbits -->
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />


</head>

<body>

  <div class="container-native">
    <header class="item header px-8">
      <a href="index.html">
        <img src="assets/images/logo/banner.png" alt="">
      </a>
      <a href="./pages/admin.php" class="ml-auto">
        <svg className="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" strokeLinecap="round" strokeWidth="2" d="M20 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6h-2m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4"/>
        </svg>

      </a>
    </header>

    <div class="lp"></div>





    <!-- substitutes -->
    <div class="item substitutes">
      <div class="title">
        substitutes
      </div>
      <!-- card players to drop -->
      <div id="substitutes-zone" class="card-substitutes">

        <!-- player for substitues -->


        

        <?php foreach($players as $player): ?>
          <?php if($player["status"] == 'substitutes'): ?>
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

            <!-- players -->
            <div id="<?= htmlspecialchars($player["id"]) ?>" class="empty-card p-card side-card drop-zone" data-pos="<?= htmlspecialchars($player["position"]) ?>" data-status="<?= htmlspecialchars($player["status"]) ?>" draggable="true">
                <img src="assets/images/card/badg_bg_champions.png" alt="" class="empty-image" draggable="false">
                <!-- inside card info -->
                <div class="card-info-empty">
                    <!-- player-img-empty -->           
                    <img src="<?= htmlspecialchars($player["photo"]) ?>" alt="" class="player-img-empty" draggable="false">
                    <!-- rating -->
                    <div class="rating-empty">
                      <p><?= htmlspecialchars($player["rating"]) ?></p>
                      <span><?= htmlspecialchars($player['position'])?></span>
                    </div>
                    <div class="info-down-emprt">
                        <!-- name -->
                        <h3 class="name-empty">
                            <?= htmlspecialchars($player["name"]) ?>
                        </h3>
                        <!-- stats -->
                        <div class="power-stats-empty">
                          <?php foreach($playerstats as $playerstat => $value): ?>
                            <div class="stats-empty pac">
                              <span><?= $playerstat ?></span>
                              <p><?= $value ?></p>
                            </div>
                          <?php endforeach ?>
                        </div>
                        <!-- country -->
                        <div class="countr-team-empty">
                          <img src="<?= htmlspecialchars($player["flag_url"]) ?>" alt="">
                          <img src="<?= htmlspecialchars($player["logo_url"]) ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
          <?php endif ?>
        <?php endforeach ?>




      </div>
    </div>










    <!-- tactic -->
    <div class="item tactic">
      <!-- 3 -->
      <div id="team-zone" class="image-container">
        <div class="title flex items-center justify-between gap-4 px-5 py-2">
          <div>team</div>

          <div class="formation-team">

           
              
            <select 
              style="color: black;"
            id="teamformation" name="teamformation" class="w-full p-3 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="433">4-3-3</option>
                <option value="442">4-2-2</option>
            </select>
            

          </div>
        </div>


        <img src="assets/images/bg/default_pitch_v2.svg" alt="" class="pitch-image" draggable="false">

        <?php
        $cb_counter = 3;
        $cm_counter = 6;
        ?>

        <?php foreach($players as $player): ?>
          <?php if($player["status"] == 'main'): ?>
            <?php
            $class = "empty-card p-card team-card drop-zone ";

            if ($player["position"] == "GK") {
              $class .= "empty-card-1"; 

              $playerstats = [
                'DIV' => $player['diving'],
                'HAN' => $player['handling'],
                'KIC' => $player['kicking'],
                'REF' => $player['reflexes'],
                'SPD' => $player['speed'],
                'POS' => $player['positioning']
              ];


            }else{

              if ($player["position"] == "LB") {
                  $class .= "empty-card-2";
              } elseif ($player["position"] == "CB") {
                  $class .= "empty-card-" . $cb_counter;
                  $cb_counter++;
              } elseif ($player["position"] == "RB") {
                  $class .= "empty-card-5";
              } elseif ($player["position"] == "CM") {
                  $class .= "empty-card-" . $cm_counter;
                  $cm_counter++;
              } elseif ($player["position"] == "LW") {
                  $class .= "empty-card-9";
              } elseif ($player["position"] == "ST") {
                  $class .= "empty-card-10";
              } elseif ($player["position"] == "RW") {
                  $class .= "empty-card-11";
              }


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

            <!-- players -->
            <div id="<?= htmlspecialchars($player["id"]) ?>" class="<?= $class ?>" data-pos="<?= htmlspecialchars($player["position"]) ?>" data-status="<?= htmlspecialchars($player["status"]) ?>" draggable="true">
                <img src="assets/images/card/badg_bg_champions.png" alt="" class="empty-image" draggable="false">
                <!-- inside card info -->
                <div class="card-info-empty">
                    <!-- player-img-empty -->           
                    <img src="<?= htmlspecialchars($player["photo"]) ?>" alt="" class="player-img-empty" draggable="false">
                    <!-- rating -->
                    <div class="rating-empty">
                      <p><?= htmlspecialchars($player["rating"]) ?></p>
                      <span><?= htmlspecialchars($player['position'])?></span>
                    </div>
                    <div class="info-down-emprt">
                        <!-- name -->
                        <h3 class="name-empty">
                            <?= htmlspecialchars($player["name"]) ?>
                        </h3>
                        <!-- stats -->
                        <div class="power-stats-empty">
                          <?php foreach($playerstats as $playerstat => $value): ?>
                            <div class="stats-empty pac">
                              <span><?= $playerstat ?></span>
                              <p><?= $value ?></p>
                            </div>
                          <?php endforeach ?>
                        </div>
                        <!-- country -->
                        <div class="countr-team-empty">
                          <img src="<?= htmlspecialchars($player["flag_url"]) ?>" alt="">
                          <img src="<?= htmlspecialchars($player["logo_url"]) ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
          <?php endif ?>
        <?php endforeach ?>

                

      </div>

    </div>












    <!-- players sidebar -->
    <div class="item players flex flex-col justify-start">
      <div class="title">
        players
      </div>


      <div class="filter-search m-2 w-full px-5">


        <div  class="max-w-lg mx-auto" style="min-width: 250px;">
          <div class="flex items-center">


            <button id="dropdown-button" data-dropdown-toggle="dropdown"
              class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium rounded-s-lg text-center text-gray-900 bg-gray-100 border border-gray-300 hover:bg-gray-200 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
              type="button">All
              <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 4 4 4-4" />
              </svg>
            </button>

            <div id="dropdown"
              class="z-10  hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
              <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                <li>
                  <button type="button"
                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">ALL</button>
                </li>
                <li>
                  <button type="button"
                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">GK</button>
                </li>
                <li>
                  <button type="button"
                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">RB</button>
                </li>
                <li>
                  <button type="button"
                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">LB</button>
                </li>
                <li>
                  <button type="button"
                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">CB</button>
                </li>
                <li>
                  <button type="button"
                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">CM</button>
                </li>
                <li>
                  <button type="button"
                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">LW</button>
                </li>
                <li>
                  <button type="button"
                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">RW</button>
                </li>
                <li>
                  <button type="button"
                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">ST</button>
                </li>
              </ul>
            </div>

            <div class="relative w-full">

              <input style="min-width: 80px;" type="search" id="search-dropdown"
                class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                placeholder="Search" required />
            </div>
          </div>
        </div>


      </div>

      <!-- card players to drop -->
      <div id="side-zone" class="card-player-side">






        <?php foreach($players as $player): ?>
          <?php if($player["status"] == 'inactive'): ?>
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

            <!-- players -->
            <div id="<?= htmlspecialchars($player["id"]) ?>" class="empty-card p-card side-card drop-zone" data-pos="<?= htmlspecialchars($player["position"]) ?>" data-status="<?= htmlspecialchars($player["status"]) ?>" draggable="true">
                <img src="assets/images/card/badg_bg_champions.png" alt="" class="empty-image" draggable="false">
                <!-- inside card info -->
                <div class="card-info-empty">
                    <!-- player-img-empty -->           
                    <img src="<?= htmlspecialchars($player["photo"]) ?>" alt="" class="player-img-empty" draggable="false">
                    <!-- rating -->
                    <div class="rating-empty">
                      <p><?= htmlspecialchars($player["rating"]) ?></p>
                      <span><?= htmlspecialchars($player['position'])?></span>
                    </div>
                    <div class="info-down-emprt">
                        <!-- name -->
                        <h3 class="name-empty">
                            <?= htmlspecialchars($player["name"]) ?>
                        </h3>
                        <!-- stats -->
                        <div class="power-stats-empty">
                          <?php foreach($playerstats as $playerstat => $value): ?>
                            <div class="stats-empty pac">
                              <span><?= $playerstat ?></span>
                              <p><?= $value ?></p>
                            </div>
                          <?php endforeach ?>
                        </div>
                        <!-- country -->
                        <div class="countr-team-empty">
                          <img src="<?= htmlspecialchars($player["flag_url"]) ?>" alt="">
                          <img src="<?= htmlspecialchars($player["logo_url"]) ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
          <?php endif ?>
        <?php endforeach ?>




      </div>
    </div>





    <div class="rp"></div>


    <footer class="item footer">
      <p>
        © 2014-2024 Copyright <a href="index.html">IcFut.com</a> All FIFA assets are property of EA Sports.
      </p>
    </footer>



  </div>








  <!-- link scripts -->
  <script src="./assets/scripts/main.js"></script>
  <!-- <script type="module" src="assets/scripts/htmlComponent.js"></script> -->
  <!-- flowbits -->
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>

</html>