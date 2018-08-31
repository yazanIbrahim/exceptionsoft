<?php

include "../includes/classes.php";

$data = json_decode(file_get_contents("php://input"),true);






$db = new connection();
$client =new Client($data[1]['clientName'],$data[1]['clientPhone']);
$project = new Project($client);



$project ->addNewProject($data[0]['projectName'], $data[0]['startDate'], $data[0]['endDate'], $data[0]['price']);





