<!DOCTYPE html>
<html>
    <?php
    include "includes/header.php";
    ?>
    <link rel="stylesheet" href="assets/css/custom.css">
    <body ng-app="test" ng-controller="myCtrl" ng-init="getter()">
        <!-- Side Navbar -->
        <?php include 'assets/templates/sideNav.php'; ?>
        <div class="page home-page">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">
                            Project Management
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <select class="form-control" ng-model="projectIndex" ng-init="projectIndex = '0'" ng-change="getPayments(projects[projectIndex - 1].project_id, projects[projectIndex - 1].client_id)">
                                    <option disabled="" value="0">Choose Project Name Please:</option>
                                    <option ng-repeat="project in projects" value="{{$index + 1}}"> {{project.project_name}}</option>
                                </select>
                            </div>
                            <div class="row" ng-show="projectIndex != '0'">
                                <div class="col-sm-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Project Name</th>
                                                <th class="">End Date</th>
                                                <th>client phone</th>
                                                <th>client name</th>
                                                <th class="">Time Left</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr ng-repeat="record in payments">
                                                <th>{{record.project_name}}</th>
                                                <th>{{record.end_date}}</th>
                                                <th>{{record.client_phone}}</th>
                                                <th>{{record.client_name}}</th>

                                                <th>{{record.time_left}} Days</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <form name="addPayment" ng-show="projectIndex != '0'">
                                        <div class="row" ng-repeat="a in add">
                                            <div class="form-group col-sm-12">
                                                <label>Add a Payment</label>
                                                <input value="" required  type="number" min="1" ng-model="a.payment" class="myform-control"/>
                                                <i class="fa fa-window-close" aria-hidden="true" ng-click="removeField($index)"></i>
                                            </div>   
                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <input type="button" class="btn btn-success" style="float:left" ng-click="addField()" value="+"/>
                                        <input ng-show="add.length != 0 && addPayment.$valid" style="float:right    " type="button"  class="btn btn-danger" 
                                               value="Submit" ng-click="addPayments(projects[projectIndex - 1].project_id)"/>
                                            </div>
                                        </div>

                                        
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <!-- start of displaying payments details for the selected projecr-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>Payments Details</h3>
                        </div>

                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Payment Amount</th>
                                        <th>Payment Date</th>                             
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr ng-repeat="record in paymentDetails">
                                        <th>{{record.d}}-{{record.m}}-{{record.y}}</th>
                                        <th>{{record.payment_amount}}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- end of payments details-->
        </div>
        <script src="assets/js/projectManagementHandler.js"></script>
    </body>
</html>