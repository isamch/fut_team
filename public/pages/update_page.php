<?php

  include '../../backend/db_conn.php';


  if (isset($_GET['id'])) { 

    $update_id = $_GET['id'];

    $query = "SELECT players.id, name, photo, position, rating, status, name_clubs,  
                name_nationality,
                diving, handling, kicking, reflexes, speed, positioning, 
                pace, shooting, passing, dribbling, defending, physical
                FROM players
                LEFT JOIN goolkeeper ON goolkeeper.id_player = players.id
                LEFT JOIN normal_player ON normal_player.id_player = players.id
                LEFT JOIN clubs ON clubs.id = players.club_id
                LEFT JOIN nationality ON nationality.id = players.nationality_id 
                WHERE players.id = $update_id;";


    $resault = mysqli_query($conn, $query);

    if (!$resault) {
      die("fetch for update error : " . mysqli_connect_error());

    }else {
      
      $row = mysqli_fetch_array($resault);
    }




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

<body class="flex-col">


  <!-- dashboard -->
  <div class="dashboard-status">
    <div class=" flex justify-center items-center h-16 bg-[#123] shadow-md mb-3 rounded">
      <a href="../index.php" class="block">
        <img src="../assets/images/logo/banner.png" alt="Logo" class="max-h-12 max-w-full object-contain">
      </a>
    </div>


    <div class="head-dash">
      <p>Update</p>
      <i class="fas fa-edit text-blue-700 group-hover:text-white"></i>
    </div>


  </div>


  <?php 

    if (isset($_POST['update_player'])) {
      $f_name = $_POST['f_name'];
      $photo_url = $_POST['photo_url'];
      $position = $_POST['position'];
      $rating = $_POST['rating'];
      $DIV_PAC = $_POST['DIV_PAC'];
      $HAN_SHO = $_POST['HAN_SHO'];
      $KIC_PAS = $_POST['KIC_PAS'];
      $REF_DRI = $_POST['REF_DRI'];
      $SPD_DEF = $_POST['SPD_DEF'];
      $POS_PHY = $_POST['POS_PHY'];



      $query_1 = " UPDATE players SET 
                    name = '$f_name',
                    photo = '$photo_url',
                    position = '$position',
                    rating = '$rating'
                    where id = $update_id;";

      $query_gk_2 = " UPDATE goolkeeper SET 
                      diving = '$DIV_PAC',
                      handling = '$HAN_SHO',
                      kicking = '$KIC_PAS',
                      reflexes = '$REF_DRI',
                      speed = '$SPD_DEF',
                      positioning = '$POS_PHY'
                      WHERE id_player = $update_id;";

      $query_np_2 = " UPDATE normal_player SET 
                      pace = '$DIV_PAC',
                      shooting = '$HAN_SHO',
                      passing = '$KIC_PAS',
                      dribbling = '$REF_DRI',
                      defending = '$SPD_DEF',
                      physical = '$POS_PHY'
                      WHERE id_player = $update_id;";                



      if (mysqli_query($conn, $query_1)) {

        if ($position == 'GK') {
          mysqli_query($conn, $query_gk_2);
        }else{
          mysqli_query($conn, $query_np_2);
        }

        header('location:admin.php');

      }else{
        die('error update data');
      }

    }


  
  
  ?>


  <!-- form update -->
  <div class="flex justify-center items-center m-3 py-5 rounded  h-auto bg-[#112233]">
    <form action="update_page.php?id=<?= htmlspecialchars($update_id)  ?>" method="post" class="w-full max-w-4xl mx-auto bg-[#112233] px-5">

      <div class="grid grid-cols-1">
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="f_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " required value="<?= htmlspecialchars($row['name']) ?>" />
          <label for="f_name" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Full name</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="photo_url" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " required value="<?= htmlspecialchars($row['photo']) ?>" />
          <label for="photo_url" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Photo Url</label>
        </div>
      </div>

      <div class="grid sm:grid-cols-2 sm:gap-6">
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="position" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " required value="<?= htmlspecialchars($row['position']) ?>"  />
          <label for="position" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Position</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="rating" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " required value="<?= htmlspecialchars($row['rating']) ?>"  />
          <label for="rating" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Rating</label>
        </div>
      </div>

      <div class="grid sm:grid-cols-2 sm:gap-6">
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="DIV_PAC" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " required value="<?php echo htmlspecialchars(($row['position'] == 'GK') ?  $row['diving'] : $row['pace'])?>"/>
          <label for="DIV_PAC" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">DIV-PAC</label>
        </div>
        
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="HAN_SHO" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " required value="<?php echo htmlspecialchars(($row['position'] == 'GK') ?  $row['handling'] : $row['shooting'])?>"/>
          <label for="HAN_SHO" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">HAN-SHO</label>
        </div>

      </div>  

      <div class="grid sm:grid-cols-2 sm:gap-6">
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="KIC_PAS" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " required value="<?php echo htmlspecialchars(($row['position'] == 'GK') ?  $row['kicking'] : $row['passing'])?>"/>
          <label for="KIC_PAS" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">KIC-PAS</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="REF_DRI" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " required value="<?php echo htmlspecialchars(($row['position'] == 'GK') ?  $row['reflexes'] : $row['dribbling'])?>"/>
          <label for="REF_DRI" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">REF-DRI</label>
        </div>
      </div>

      <div class="grid sm:grid-cols-2 sm:gap-6">
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="SPD_DEF" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " required value="<?php echo htmlspecialchars(($row['position'] == 'GK') ?  $row['speed'] : $row['defending'])?>"/>
          <label for="SPD_DEF" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">SPD-DEF</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="POS_PHY" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " required value="<?php echo htmlspecialchars(($row['position'] == 'GK') ?  $row['positioning'] : $row['physical'])?>"/>
          <label for="POS_PHY" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">POS-PHY</label>
        </div>
      </div>



      <button type="submit" name="update_player" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Update</button>
      </form>
    </div>



</body>

</html>