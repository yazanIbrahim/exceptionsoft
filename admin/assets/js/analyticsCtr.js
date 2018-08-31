var app = angular.module('analytics',[]);
app.controller('analyticsCtr',['$scope','$http',function($scope,$http){
        
        analytics = [];
        $scope.costVsIncome = function(){
           
           $http.get("dataBaseHandler/analyticsHandler.php?summary=1").then(function(response){
               console.log(response.data);
               
               for(var i=0;i<response.data.costs.length;i++){
                   analytics.push(
                                {
                                    ["a"]:i,
                                    ["b"]:response.data.costs[i],
                                    ["c"]:response.data.income[i]
                                    
                                }
                   );
               }
               
               console.log(analytics);
               
               
               var chart = AmCharts.makeChart("chartdiv", {
    "theme": "black",
    "type": "serial",
    "dataProvider": analytics,
    "valueAxes": [{
        "unit": "JD",
        "position": "left",
        "title": "Cost Vs Income",
    }],
    "startDuration": 1,
    "graphs": [{
        "balloonText": "cost  in [[category]] : <b>[[value]] JD</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "2004",
        "type": "column",
        "valueField": "b"
    }, {
        "balloonText": "income in [[category]] : <b>[[value]] JD</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "2005",
        "type": "column",
        "clustered":false,
        "columnWidth":0.5,
        "valueField": "c"
    }],
    "plotAreaFillAlphas": 0.5,
    "categoryField": "a",
    "categoryAxis": {
        "gridPosition": "start"
    },
    "export": {
    	"enabled": true
     }

});
           });
        };
       
}]);