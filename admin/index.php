<!DOCTYPE html>
<html>

<?php
include "includes/header.php";
?>

    <body ng-app="newProject" ng-controller="newProjectCtr" ng-init="showNewProjectAlert=false">
  

        <!-- side nav -->
        <?php
            include "assets/templates/sideNav.php";
        ?>
        <!-- end of side nav-->
        <div class="page home-page">
            <div class="row"  ng-show="showNewProjectAlert">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="text-align:center">
                            <h3>{{alerts["addnewproject"]}}</h3>
                        </div>
                    </div>
                </div>
            </div><!-- alert message-->
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Add New Project
                        </div>
                        <div class="panel-body">
                            <form name="newProject">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label>Project Name </label>
                                        <input type="text" class="form-control" ng-model="project.projectName" name="projectName" required/>
                                        
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>Start Date </label>
                                        <input type="date" class="form-control" ng-model="project.startDate" name="startDate" required/>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label>End Date </label>
                                        <input type="date" class="form-control" ng-model="project.endDate" name="endDate" required/>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label>Price </label>
                                        <input type="text" class="form-control" ng-model="project.price" min="1" required/>
                                    </div>    
                                </div>


                                <div class="row">
                                    <div class=" col-sm-6 col-sm-offset-3">
                                        <hr style="border-width:1px;border-color:gray"/>
                                    </div>    
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>Client Name</label>
                                        <input type="text" class="form-control" ng-model="client.clientName" name="clientName" minlength="10" required/>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label>Client Phone</label>
                                        <input type="tel" class="form-control" ng-model="client.clientPhone" ng-pattern="regex"  name="clientPhone" required/>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-12 col-sm-offset-4">
                                        <input type="submit" ng-click="save()" value="Save" class="btn btn-primary" 
                                         ng-disabled="newProject.projectName.$untouched || newProject.clientPhone.$invalid"/>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end of add project information section -->


           
        </div>


        <!-- Javascript files-->

      
        <script src="assets/js/newProjectCtr.js"></script>
    </body>

</html>