<!DOCTYPE html>
<html>
    
    <head>
        <title>Tables</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/normalize.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <link href="assets/DT_bootstrap.css" rel="stylesheet" media="screen">
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

                    
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">userAccount Details</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
  									<?php


include('connect.php');

$per_page = 5;

// figure out the total pages in the database
$result = mysql_query("SELECT * FROM tbluser");
$total_results = mysql_num_rows($result);
$total_pages = ceil($total_results / $per_page);

// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
if (isset($_GET['page']) && is_numeric($_GET['page']))
{
    $show_page = $_GET['page'];

    // make sure the $show_page value is valid
    if ($show_page > 0 && $show_page <= $total_pages)
    {
        $start = ($show_page -1) * $per_page;
        $end = $start + $per_page;
    }
    else
    {
        // error - show first set of results
        $start = 0;
        $end = $per_page;
    }
}
else
{
    // if page isn't set, show first set of results
    $start = 0;
    $end = $per_page;
}

// display pagination

//place pagination for bootsrap;

for ($i = 1; $i <= $total_pages; $i++)
{
    echo "<a href='tableUser.php?page=$i'>$i</a>";
}

echo "</p>"; //close pagination

// display data in table

echo '	<table class="table table-striped">
						              <thead>
						                <tr>
						                  <th>id</th>
						                  <th>user pasword</th>
						                  <th>userAcStatus</th>
						                  <th>userAcType</th>
                                          <th>fullname</th>
						                </tr>
						              </thead></tr>';

// loop through results of database query, displaying them in the table
for ($i = $start; $i < $end; $i++)
{
    // make sure that PHP doesn't try to show results that don't exist
    if ($i == $total_results) { break; }

    // echo out the contents of each row into a table
    echo "<tr>";
    echo '<td>' . mysql_result($result, $i, 'userId') . '</td>';
    echo '<td>' . mysql_result($result, $i, 'userPassword') . '</td>';
    echo '<td>' . mysql_result($result, $i, 'userStatus') . '</td>';
    echo '<td>' . mysql_result($result, $i, 'userType') . '</td>';
     echo '<td>' . mysql_result($result, $i, 'userFullName') . '</td>';
     echo '<td>' . mysql_result($result, $i, 'userAddress') . '</td>';
    echo '<td><a href="modifyuserForm.php?userId=' . mysql_result($result, $i, 'userId') . '">Edit</a></td>';
    echo '<td><a href="deleteUser.php?userId=' . mysql_result($result, $i, 'userId') . '">Delete</a></td>';
    echo "</tr>";
}
// close table>
echo "</table>";

// pagination

?>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>


                        <!-- /block -->


            <hr>
            <footer>
                <p>&copy; </p>
            </footer>
        </div>
        <!--/.fluid-container-->

        <script src="vendors/jquery-1.9.1.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>


        <script src="assets/scripts.js"></script>
        <script src="assets/DT_bootstrap.js"></script>
        <script>
        $(function() {
            
        });
        </script>
    </body>

</html>