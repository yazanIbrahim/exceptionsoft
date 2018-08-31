<?php

include "../includes/classes.php";
$expenses = new Exspenses();
$month = date('m');
$db = new connection();
if(isset($_GET['action'])){
    
    $res = [];
    if($_GET['action'] == 'load'){//get records on load
         $stmt = "SELECT amount,expenses_date,paid_to,notes FROM expenses "
                . "WHERE month(expenses_date) = ? OR year(expenses_date)=? OR day(expenses_date) = ?";
       
   
        $count = $db->countRow($stmt,array($month,0,0));
        $count = ceil($count/15);
        $res['count'] = $count;
        
       
        
        $res['data'] = $expenses->getExpenses(0,$month,0,$_GET['num']);
        
        echo json_encode($res);
     
        
    }else{//get records when clicking on page number 
        
        $offset = $_GET['num']*15-15;
        $res['data'] = $expenses->getExpenses(0, $month, 0, $offset);
        echo json_encode($res);
    }
    
    
    
   
    
    
    
}else{
    //post data to the database
     // save data to the database
    $data = json_decode(file_get_contents("php://input"),true);
    
    $res ['data']= [];
    for($i = 0;$i<sizeof($data);$i++){
        extract($data[$i]);
        $x = $expenses->addNewExpense($amount, $paidTo, $notes);
        //array_push($res, $x);
        
    }
    $res ['data'] = $expenses->getExpenses(0,$month,0);
     echo(json_encode($res));
}

