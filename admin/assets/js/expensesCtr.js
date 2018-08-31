var app = angular.module('expenses',[]);
app.controller('expensesCtr',['$scope','$http',function($scope,$http){
        //variables 
        $scope.alerts = [];
        $scope.expensesForm = [];
        $scope.fetchedExpenses ;
        
        /*----------functions----------*/
        
        $scope.addExpenses =function(){
            // add dynamic forms
             $scope.expensesForm.push({});
        };
       
        $scope.close = function(index){
             // remove forms 
            if($scope.expensesForm.length > 1)
                $scope.expensesForm.splice(index,1);
        };
        
        $scope.saveExpenses = function(){
            // save data to the database
            $http.post("dataBaseHandler/expensesHandler.php",$scope.expensesForm).then(function(response){
                 $scope.showNewExpenseAlert = true;
                 
                 console.log(response.data);
                 $scope.fetchedExpenses = response.data; 
            });
        };
        
        $scope.pageNumber = [];
        
        $scope.showExpenses = function(str,num){
            requestStr = str;
            $http.get("dataBaseHandler/expensesHandler.php?action="+requestStr+"&num="+num).then(function(response){
              
                console.log(response.data.count);
                for(i=0;i<response.data.count;i++){
                    $scope.pageNumber.push(i+1);
                }
                
                 $scope.fetchedExpenses = response.data.data ;
                
                //$scope.fetchedExpenses = response.data;
                
            });
        };
        
        
       
}]);