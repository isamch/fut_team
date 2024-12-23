<?php

  include '../../backend/db_conn.php';

  include './pagination.php';

  session_start();


  //action method post :
  
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_player'])) {
    $f_name = $_POST['f_name'];
    $photo_url = $_POST['photo_url'];
    $country_choose = $_POST['option_country'];
    $team_choose = $_POST['option_team'];

    $position = $_POST['option_position'];
    $rating = $_POST['rating'];

    $DIV_PAC = $_POST['DIV_PAC'];
    $HAN_SHO = $_POST['HAN_SHO'];
    $KIC_PAS = $_POST['KIC_PAS'];
    $REF_DRI = $_POST['REF_DRI'];
    $SPD_DEF = $_POST['SPD_DEF'];
    $POS_PHY = $_POST['POS_PHY'];



    
    $query_1 = "INSERT INTO players (name, photo, position, rating, status, club_id, nationality_id)
                VALUES
                ('$f_name', '$photo_url', '$position', $rating , 'inactive', $team_choose , $country_choose);";


    $query_gk_2 = "INSERT INTO goolkeeper (diving, handling, kicking, reflexes, speed, positioning, id_player)
                  VALUES
                  ($DIV_PAC, $HAN_SHO, $KIC_PAS, $REF_DRI, $SPD_DEF, $POS_PHY, );";

    $query_np_2 = "INSERT INTO normal_player (pace, shooting, passing, dribbling, defending, physical, id_player)
                  VALUES
                  ($DIV_PAC, $HAN_SHO, $KIC_PAS, $REF_DRI, $SPD_DEF, $POS_PHY, );";



    if (mysqli_query($conn, $query_1)) {

      $conn_id = mysqli_insert_id($conn);

      if ($position == 'GK') {
        $query_gk_2 = "INSERT INTO goolkeeper (diving, handling, kicking, reflexes, speed, positioning, id_player)
        VALUES
        ($DIV_PAC, $HAN_SHO, $KIC_PAS, $REF_DRI, $SPD_DEF, $POS_PHY, $conn_id);";

        mysqli_query($conn, $query_gk_2);

      }else{

        $query_np_2 = "INSERT INTO normal_player (pace, shooting, passing, dribbling, defending, physical, id_player)
          VALUES
          ($DIV_PAC, $HAN_SHO, $KIC_PAS, $REF_DRI, $SPD_DEF, $POS_PHY, $conn_id);";

        mysqli_query($conn, $query_np_2);
      }


      $_SESSION['success_add_msg'] = "$f_name has been successfully added.";

      header("location:admin.php?page-nbr=$page_number");
      exit;
          
    }else{
      die('error add data');

    }


  }
  

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <link rel="shortcut icon" href="../assets//images//logo//favicon.png" type="image/x-icon">

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



  
  

  <!-- form update -->
  <div class="flex justify-center items-center m-3 py-5 rounded  h-auto bg-[#112233]">
    <form action="add_player.php" method="post" class="w-full max-w-4xl mx-auto bg-[#112233] px-5">

      <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-6 items-center mb-5">
        <div class="flex flex-col gap-5">
          <div class="relative z-0 w-full group">
            <input type="text" name="f_name" id="" pattern="^[A-Za-z]+(?:\s[A-Za-z]+)+$" title="Enter a valide name"
                  class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" 
                  placeholder=" " required/>
            <label for="f_name" 
                  class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
              Full Name
            </label>
          </div>

          <div class="relative z-0 w-full group">
            <input type="text" name="photo_url" id="photo_url"
                  class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" 
                  placeholder=" " required/>
            <label for="photo_url" 
                  class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
              Photo Url
            </label>
          </div>
        </div>

        <div class="flex justify-center items-center">
          <img id="photoPreview" src="../assets/images/bg/bg_tiran.jpg" alt="Preview" 
              class="object-cover	 w-20 h-20 border border-gray-600 rounded-md"/>
        </div>
      </div>


          
      <div class="grid sm:grid-cols-2 sm:gap-6">

        <div class="relative z-0 w-full mb-5 group">
          <select name="option_country" id="option_country" class="block py-2.5 px-0 w-full text-2sm text-white bg-[#112233] border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" required>
            <option value="" disabled selected hidden>Country</option>
            <?php 
              $query_country = "SELECT id, name_nationality FROM nationality;";
              $result_country = mysqli_query($conn, $query_country);
            ?>
            <?php while ($row_country = mysqli_fetch_array($result_country)): ?>
            <option value="<?= htmlspecialchars($row_country['id']) ?>"><?= htmlspecialchars($row_country['name_nationality']) ?></option>
            <?php endwhile ?>

          </select>
          <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </div>
        </div>

        <div class="relative z-0 w-full mb-5 group">
          <select name="option_team" id="option_team" class="block py-2.5 px-0 w-full text-2sm text-white bg-[#112233] border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" required>
            <option value="" disabled selected hidden>Team</option>
            <?php 
              $query_clubs = "SELECT id, name_clubs FROM clubs;";
              $result_clubs = mysqli_query($conn, $query_clubs);
            ?>
            <?php while ($row_clubs = mysqli_fetch_array($result_clubs)): ?>
            <option value="<?= htmlspecialchars($row_clubs['id']) ?>"><?= htmlspecialchars($row_clubs['name_clubs']) ?></option>
            <?php endwhile ?>

          </select>
          <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </div>
        </div>
      </div>


      <div class="grid sm:grid-cols-2 sm:gap-6">
        <div class="relative z-0 w-full mb-5 group">
          <select name="option_position" id="option_position" class="block py-2.5 px-0 w-full text-2sm text-white bg-[#112233] border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" required>
            <option value="" disabled selected hidden>Position</option>
            <?php 
              $query_positopn = "SELECT DISTINCT position FROM players;";
              $result_positopn = mysqli_query($conn, $query_positopn);
            ?>
            <?php while ($row_positopn = mysqli_fetch_array($result_positopn)): ?>
            <option value="<?= htmlspecialchars($row_positopn['position']) ?>"><?= htmlspecialchars($row_positopn['position']) ?></option>
            <?php endwhile ?>

          </select>
          <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </div>
        </div>
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="rating" id="" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " pattern="^[1-9][0-9]$" title="Please enter a number between 10 and 99." required/>
          <label for="rating" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Rating</label>
        </div>
      </div>

      <div class="grid sm:grid-cols-2 sm:gap-6">
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="DIV_PAC" id="" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " pattern="^[1-9][0-9]$" title="Please enter a number between 10 and 99." required/>
          <label for="DIV_PAC" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">DIV-PAC</label>
        </div>
        
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="HAN_SHO" id="" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " pattern="^[1-9][0-9]$" title="Please enter a number between 10 and 99." required/>
          <label for="HAN_SHO" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">HAN-SHO</label>
        </div>

      </div>  

      <div class="grid sm:grid-cols-2 sm:gap-6">
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="KIC_PAS" id="" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " pattern="^[1-9][0-9]$" title="Please enter a number between 10 and 99." required/>
          <label for="KIC_PAS" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">KIC-PAS</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="REF_DRI" id="" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " pattern="^[1-9][0-9]$" title="Please enter a number between 10 and 99." required/>
          <label for="REF_DRI" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">REF-DRI</label>
        </div>
      </div>

      <div class="grid sm:grid-cols-2 sm:gap-6">
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="SPD_DEF" id="" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " pattern="^[1-9][0-9]$" title="Please enter a number between 10 and 99." required/>
          <label for="SPD_DEF" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">SPD-DEF</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
          <input type="text" name="POS_PHY" id="" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-600 appearance-none focus:outline-none focus:ring-0 focus:border-blue-500 peer" placeholder=" " pattern="^[1-9][0-9]$" title="Please enter a number between 10 and 99." required/>
          <label for="POS_PHY" class="absolute text-sm text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">POS-PHY</label>
        </div>
      </div>
      
  



      <button type="submit" name="add_player" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Update</button>
      </form>
    </div>




    



    <!-- script  -->
    <script>
      const photoUrlInput = document.querySelector('input[name="photo_url"]');
      const photoPreview = document.querySelector('#photoPreview');


      photoUrlInput.addEventListener('input', (event) => {
        const url_input = photoUrlInput.value.trim();

        if (url_input) {
          photoPreview.src = url_input;
        }


      });


    </script>

</body>

</html>