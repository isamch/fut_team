<?php
include './db_conn.php';


if (!$conn) {
    die(json_encode(['success' => false, 'error' => 'Database connection failed: ' . mysqli_connect_error()]));
}


// array(1) {
//     ["updates"]=>
//     array(1) {
//       [0]=>
//       array(4) {
//         ["cardPlayer1_id"]=>
//         string(2) "10"
//         ["cardPlayer1_status"]=>
//         string(8) "inactive"
//         ["cardPlayer2_id"]=>
//         string(2) "18"
//         ["cardPlayer2_status"]=>
//         string(8) "official"
//       }
//     }
//   }


$data = json_decode(file_get_contents('php://input'), true);
// echo json_encode($data);

if (isset($data['updates']) && is_array($data['updates'])) {


    $updates = $data['updates'];


    foreach ($updates as $update) {

        $cardPlayer1_id = $update['cardPlayer1_id'];
        $cardPlayer1_status = $update['cardPlayer1_status'];

        $cardPlayer2_id = $update['cardPlayer2_id'];
        $cardPlayer2_status = $update['cardPlayer2_status'];

        // Update player 1's status
        $query1 = "UPDATE players SET status = '$cardPlayer1_status' WHERE id = $cardPlayer1_id";

        // Update player 2's status
        $query2 = "UPDATE players SET status = '$cardPlayer2_status' WHERE id = $cardPlayer2_id";


        if (!mysqli_query($conn, $query1) || !mysqli_query($conn, $query2)) {
            echo json_encode(['success' => false, 'error' => 'Database update failed']);
            exit;
        }
    }


    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'No valid data received']);
}



mysqli_close($conn);
exit;
