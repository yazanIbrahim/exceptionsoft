<!DOCTYE html>
<html>
    <?php
    include "includes/header.php";
    ?>

    <body ng-app="analytics" ng-controller="analyticsCtr" ng-init="costVsIncome()">
        
        <?php
            include "assets/templates/sideNav.php";
        ?>
        <div class="page home-page">
           <!-- Identify where the chart should be drawn. -->
           <div id="chartdiv">
               
           </div>
 
        </div>
        
        
        <script src="assets/js/analyticsCtr.js"></script>
       
    </body>
</html>