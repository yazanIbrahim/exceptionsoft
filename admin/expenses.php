<!DOCTYE html>
<html>
    <?php
    include "includes/header.php";
    ?>

    <body ng-app="expenses" ng-controller="expensesCtr" ng-init="showNewExpenseAlert = false;showExpenses('load',0)">
        <?php
        include "assets/templates/sideNav.php";
        ?>

        <div class="page home-page">
            <div class="row"  ng-show="showNewExpenseAlert">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="text-align:center">
                            <h3>{{alerts["showNewExpenseAlert"]}}</h3>
                        </div>
                    </div>
                </div>
            </div><!-- alert message-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Expenses
                        </div>
                        <div class="panel-body">
                            <div class="" >
                                <form name="expenses">
                                    <div class="x" ng-repeat="data in expensesForm">

                                        <div class="row">
                                            <div class="form-group col-sm-5">
                                                <label>Paid To</label>
                                                <input type="text" class="form-control" ng-model="data.paidTo"/>
                                            </div>

                                            <div class="form-group col-sm-5">
                                                <label>Amount</label>
                                                <input type="text" class="form-control" ng-model="data.amount"/>
                                            </div>

                                            <div class="form-group col-sm-2">
                                                <button class="close" ng-click="close($index)">X</button>
                                            </div>
                                        </div>


                                        <div class="row">

                                            <div class="form-group col-sm-12">
                                                <label>You can Add notes Here</label>
                                                <textarea class="form-control" ng-model="data.notes" style="height: 150px">
                                            
                                                </textarea>
                                            </div>
                                        </div>


                                    </div>
                                </form>
                            </div>

                            <div class="row" style="margin-bottom:20px">
                                <div class="col-sm-12 col-sm-offset-4">
                                    <button  class="btn btn-danger" ng-click="addExpenses()">
                                        Add New Expenses
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>


                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-sm-offset-4">
                                    <input type="submit" value="Save" ng-click="saveExpenses()"class="btn btn-primary"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end of add expenses information section -->
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>This month expenses</h3>
                        </div>
                        
                         <div class="panel-body " >
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Paid To</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr ng-repeat="record in fetchedExpenses">
                                        <th>{{record.expenses_date}}</th>
                                        <th>{{record.amount}}</th>
                                        <th>{{record.paid_to}}</th>
                                        <th>{{record.notes}}</th>
                                    </tr>
                                </tbody>
                            </table>
                            
                             <div class="row">
                                 <div class="col-sm-12" style="text-align:center ">
                                     <ul class="pagination" ng-repeat="item in pageNumber">
                                        <li ng-click="showExpenses('',$index+1)"><a href="#" >{{item}}</a></li>
                                      
                                    </ul> 
                                 </div>
                             </div>
                        </div>
                    </div>
                    
                   
                </div>
            </div>

        </div>

        <script src="assets/js/expensesCtr.js"></script>
    </body>
</html>