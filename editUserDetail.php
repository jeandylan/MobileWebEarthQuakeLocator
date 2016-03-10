<!doctype html>
<html>
<head>
    <title>sign Up mobile Earthquake</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="js/geoLocalizationForSignUp.js"></script>
    <link rel="stylesheet" href="css/ay.css" />
</head>
<body>

<div data-role="page" data-theme="b">

<div data-role="header" data-add-back-btn="true">



    <h1>Mobile Earthquake</h1>
</div>


<form action="signUp.php" method="post" data-ajax="false">
    <div data-role="main" class="ui-content" >

        <h3>Edit Details</h3>
     
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" name="confirmPassword" id="confirmPassword" value="">
        <div>
            <button class="ui-btn" name="save" id="btnSaveModification" type="button">Save</button>

        </div>

        <div id="result">
            <div data-role="popup" id="popUpSaveResult">
                <p id="popUpContent">Data saved you will be redirected in 3 secs</p>
            </div>
            <div data-role="popup" id="popupValidationWrong" class="ui-content" style="max-width:280px">
                <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
                <p>Blank fields not allowed and passwords should match</p>
            </div>
        </div>

    </div>
</form>


</div>


</div>

<?php
session_start();
$simple=$_SESSION['id'];
?>

<script>
    $(document).ready(function() {
       // location.reload();
        var id1 = '<?php echo $simple; ?>';

        $('#btnSaveModification').click(function () {

        //console.log(id1)
            
            if (($("#password").val().length > 0)&&($("#password").val()==$("#confirmPassword").val() )) {


                var txtFullName = $("#fullName").val();
                var txtaddress = $("#address").val();
                var txtPassword = $("#password").val();
                $.mobile.loading('show', {
                    text: 'foo',
                    textVisible: false,
                    theme: 'z',
                    html: ""
                });

                $.ajax({
                    type: "POST",
                    url: "saveUserDetail.php",
                    data: {password: txtPassword,id : id1},
                    dataType: 'JSON',
                    success: function (response) {

                        $("#popUpSaveResult").popup("open");
                        //redirect User to index after 3sec
                        var delay = 3000; //Your delay in milliseconds

                        setTimeout(function () {
                            window.location = "http://localhost/earthquakeLocator/earthquakeLocator.php"; //modify it
                        }, delay);
                        // $.mobile.loading( "hide" );
                    }
                });
            }
            else{
                $("#popupValidationWrong").popup("open");
            }
            

        });


    });

</script>

</body>
</html>
