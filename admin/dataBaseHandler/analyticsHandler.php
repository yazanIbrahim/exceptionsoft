<?php

include '../includes/classes.php';
if(isset($_GET['summary'])){
    $db = new connection();
    
    $res = array();
    $costVsIncome =[];
    switch ($_GET['summary']) {
        case 1:
            $d = date("Y");
           
            $stmt = "SELECT sum(amount) as sum,month(expenses_date) as m FROM expenses WHERE year(expenses_date) = ? Group by month(expenses_date)";
            $costVsIncome['costs'] = $db->fetchDataWithCondition($stmt,array($d));
            //echo json_encode($res);
            
            $stmt = "SELECT sum(payment_amount) as sum,month(payment_date) as m FROM project_payment WHERE year(payment_date) = ? Group by month(payment_date)";
            $costVsIncome['income'] = $db->fetchDataWithCondition($stmt, array($d));
            
            $res['costs']  = array(
                 "0"=>0,
                 "1"=>0,
                 "2"=>0,
                 "3"=>0,
                 "4"=>0,
                 "5"=>0,
                 "6"=>0,
                 "7"=>0,
                 "8"=>0,
                 "9"=>0,
                 "10"=>0,
                 "11"=>0,
                 
            );
            
            $res['income']  = array(
                 "0"=>0,
                 "1"=>0,
                 "2"=>0,
                 "3"=>0,
                 "4"=>0,
                 "5"=>0,
                 "6"=>0,
                 "7"=>0,
                 "8"=>0,
                 "9"=>0,
                 "10"=>0,
                 "11"=>0,
                
            );
            
            for($i=0;$i< sizeof($costVsIncome['costs']);$i++){
               
                $res['costs'][$costVsIncome['costs'][$i]['m']] = $costVsIncome['costs'][$i]['sum'];
                
            }
            
              for($i=0;$i< sizeof($costVsIncome['income']);$i++){
               
                $res['income'][$costVsIncome['income'][$i]['m']] = $costVsIncome['income'][$i]['sum'];
                
            }
           echo json_encode($res);
           
           //print_r($costVsIncome);
            

        
    }
}