<!DOCTYPE html>
<html>
    
    <head>
        <title>Forms</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#">Admin Panel</a>
                <div class="nav-collapse collapse">
                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> setting <i class="caret"></i>

                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a tabindex="-1" href="../signIn.php">Logout</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                    <ul class="nav">
                        <li class="active">
                            <a href="#">Dashboard</a>
                        </li>


                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span3" id="sidebar">
                <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                    <li>
                        <a href="index.html"><i class="icon-chevron-right"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="tableEarthquake.php"><i class="icon-chevron-right"></i> table earthquake</a>
                    </li>
                    <li>
                        <a href="tableUser.php"><i class="icon-chevron-right"></i> table user</a>
                    </li>
                    <li>
                        <a href="addUserform.php"><i class="icon-chevron-right"></i> Add User</a>
                    </li>
                    <li class="active">
                        <a href="uploadEarthQuake.html"><i class="icon-chevron-right"></i> upload quakeml file</a>
                    </li>
                    <li class="active">
                        <a href="dbMaintain.html"><i class="icon-chevron-right"></i> db maintainance</a>
                    </li>
                </ul>
            </div>
                <!--/span-->
                <div class="span9" id="content">
                      <!-- morris stacked chart -->
               


                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Form Validation</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
					<!-- BEGIN FORM-->
					<form action="" method="post"  id="form_sample_1" class="form-horizontal">
						<fieldset>
							<div class="alert alert-error hide">
								<button class="close" data-dismiss="alert"></button>
								You have some form errors. Please check below.
							</div>
							<div class="alert alert-success hide">
								<button class="close" data-dismiss="alert"></button>
								Your form validation is successful!
							</div>
  							<div class="control-group">
  								<label class="control-label">fullName<span class="required">*</span></label>
  								<div class="controls">
  									<input type="text" name="fullName" data-required="1" class="span6 m-wrap"/>
  								</div>
  							</div>
                            <div class="control-group">
  								<label class="control-label">address<span class="required">*</span></label>
  								<div class="controls">
  									<input type="text" name="address" data-required="1" class="span6 m-wrap"/>
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">Email/id<span class="required">*</span></label>
  								<div class="controls">
  									<input name="email" type="text" class="span6 m-wrap"/>
  								</div>
  							</div>
  					
  					
  						
  					
  							<div class="control-group">
  								<label class="control-label">password&nbsp;&nbsp;</label>
  								<div class="controls">
  									<input name="password" type="text" class="span6 m-wrap"/>
  									<span class="help-block">optional field if login is Fb</span>
  								</div>
  							</div>
                            <div class="control-group">
  								<label class="control-label">confirm password&nbsp;&nbsp;</label>
  								<div class="controls">
  									<input name="confirmPassword" type="text" class="span6 m-wrap"/>
  									<span class="help-block">optional field ,if login is fB</span>
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">Account Type<span class="required">*</span></label>
  								<div class="controls">
  									<select class="span6 m-wrap" name="userType">

  										<option value="normal">normal</option>
  										<option value="facebook">facebook</option>
  										<option value="admin">admin</option>
  									</select>
  								</div>
  							</div>
                            <div class="control-group">
                                <label class="control-label">user Type<span class="required">*</span></label>
                                <div class="controls">
                                    <select class="span6 m-wrap" name="userStatus">

                                        <option value="1">Avaialble</option>
                                        <option value="0">Block</option>

                                    </select>
                                </div>
                            </div>
  							<div class="form-actions">
  								<button type="submit" name="submit" value="Submit" class="btn btn-primary">Validate</button>
  								<button type="button" class="btn">Cancel</button>
  							</div>
						</fieldset>
					</form>
					<!-- END FORM-->
				</div>
			    </div>
			</div>
                     	<!-- /block -->
		    </div>
                     <!-- /validation -->


                </div>
            </div>
            <hr>
            <footer>
                <p>&copy; </p>
            </footer>
        </div>
        <!--/.fluid-container-->
        <link href="vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

        <script src="vendors/jquery-1.9.1.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/jquery.uniform.min.js"></script>
        <script src="vendors/chosen.jquery.min.js"></script>
        <script src="vendors/bootstrap-datepicker.js"></script>

        <script src="vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
        <script src="vendors/wysiwyg/bootstrap-wysihtml5.js"></script>

        <script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

	<script type="text/javascript" src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="assets/form-validation.js"></script>
        
	<script src="assets/scripts.js"></script>
        <script>

	jQuery(document).ready(function() {   
	  // FormValidation.init();
	});
	

        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
        </script>
    </body>

</html>
<?php
// connect to the database
 include('connect.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 $fullname = mysql_real_escape_string(htmlspecialchars($_POST['fullName']));
 $address = mysql_real_escape_string(htmlspecialchars($_POST['address']));
     $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
     $password = mysql_real_escape_string(htmlspecialchars($_POST['password']));
     $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
     $userType = mysql_real_escape_string(htmlspecialchars($_POST['userType']));
     $userStatus = mysql_real_escape_string(htmlspecialchars($_POST['userStatus']));
 // check to make sure both fields are entered


 // save the data to the database
 mysql_query("INSERT INTO `tbluser`(`userId`, `userPassword`, `userType`, `userAddress`, `userFullName`, `userStatus`) VALUES ('$email','$password','$userType','$address','$fullname','$userStatus');");
 //or die(mysql_error());
 
 // once saved, redirect back to the view page
 //header("Location: view.php");
     echo "ok";

 }

?>