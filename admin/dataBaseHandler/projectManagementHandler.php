<?php

include '../includes/classes.php';
$db = new connection();
if (isset($_GET['case'])) {

    switch ($_GET['case']) {
        case 1://get all projects
            $select = "Select project_id,client_id,project_name,price FROM project";
            $result = $db->fetchData($select);
            echo json_encode($result);
            break;
        case 2:// get the selected project payments details
            $projectID = json_decode(file_get_contents("php://input"))->projectID;
            $clientID = json_decode(file_get_contents("php://input"))->clientID;
            $select = "SELECT project_name,end_date,start_date,price,client_name,client_phone FROM project right join client "
                    . "on project.client_id = client.client_id WHERE project_id = $projectID";
            $result = $db->fetchData($select);
           // echo strtotime($result[0]['end_date']);
            $result[0]['time_left'] = (int)strtotime($result[0]['end_date']) -(int)strtotime($result[0]['start_date']);
            $result[0]['time_left'] = date('d',$result[0]['time_left']);
            echo json_encode($result);
            break;
        case 3:
            $res;
            $projectID = json_decode(file_get_contents("php://input"))->proID;
            $payments = json_decode(file_get_contents("php://input"))->payments;
            for ($i = 0; $i < sizeof($payments); $i++) {
                $insert = "insert into project_payment (project_id,payment_amount) values (?,?)";
                $result = $db->sqlStatmentWithPrepare($insert, array($projectID, $payments[$i]->payment));
            }
            if ($result) {
                echo 'done';
            } else {
                echo 'failed';
            }
            
        case 4:{
            $projectID = $_GET['p_id'];
            
            $stmt = "SELECT month(payment_date) as m, day(payment_date) as d,year(payment_date) as y,payment_amount "
                    . "FROM project_payment WHERE project_id = ?";
            
            $res = $db->fetchDataWithCondition($stmt, array($projectID));
          
            echo json_encode($res);
        }
    }
}


























    /* if ($tableName == "project"){
      $select = "SELECT * FROM $tableName";
      $result = $db->fetchData($select);
      echo json_encode($result);

      }elseif ($tableName == "client"){

      }elseif ($tableName == "project_payment"){
      $projectID = json_decode(file_get_contents("php://input"))->projectID;
      $select = "SELECT * FROM $tableName WHERE project_id=".$projectID;
      $result=$db->fetchData($select);
      echo json_encode($result);
      } */

    