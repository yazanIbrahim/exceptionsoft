
var app = angular.module('newProject',[]);
app.controller('newProjectCtr',['$scope','$http',function($scope,$http){
        
        $scope.alerts = [];
        $scope.regex ="\\d{10}";
        // save project details to the database  
        $scope.save = function(){
            
            $scope.formData =[$scope.project,$scope.client];
            $http.post("dataBaseHandler/newProjectHandler.php",$scope.formData).then(function(response){
                $scope.showNewProjectAlert = true;
                $scope.alerts["addnewproject"] = response.data;
                $scope.project = {};
                $scope.client  = {};
              
            });
        };
        
        
}]);
