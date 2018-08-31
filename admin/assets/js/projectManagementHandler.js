var appName = angular.module('test', []);
appName.controller('myCtrl', function ($scope, $http) {
    $scope.getter = function () {
        $http.get("dataBaseHandler/projectManagementHandler.php?case=1").then(function (response) {
            
            $scope.projects = response.data;
            //console.log($scope.projects);
           
        });
    };
    
    $scope.getPayments = function (p_id,c_id) {
        if (p_id === '0')
            return;
        $http({
            method: "POST",
            url: "dataBaseHandler/projectManagementHandler.php?case=2",
            data: {projectID: p_id,clientID: c_id}
        }).then(function (response) {
            $scope.payments = response.data;
            
            $http.get('dataBaseHandler/projectManagementHandler.php?case=4&p_id='+p_id).then(function(response){
                console.log(response.data);
                $scope.paymentDetails = response.data;
            });
            
            
            
             //console.log($scope.payments);
        });
    };
    $scope.add = [];
    
    $scope.addField = function () {
        $scope.add.push({});
    };
    
    $scope.addPayments = function (projectID) {
        $http({
            method: "POST",
            url: "dataBaseHandler/projectManagementHandler.php?case=3",
            data: {payments: $scope.add, proID: projectID}
        }).then(function (response) {
            $scope.getPayments(projectID);
            $scope.add = [];
        });
    };
    
    $scope.removeField = function (index) {
        
        if($scope.add.length >1)
         $scope.add.splice(index,1);
    };
});


