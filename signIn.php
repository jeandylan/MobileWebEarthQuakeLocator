<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>
	<meta name="Author" content=""/>
	

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="js/geoLocalizationForSignUp.js"></script>
<link rel="stylesheet" href="css/ay.css" />
 <script type="text/javascript">

 </script>

</head>
<body>

<div data-role="page" data-theme="b">

  <div data-role="header">
       
      

    <h1>Mobile Earthquake</h1>
  </div>


  <div data-role="main" class="ui-content"  >
     <form action="php/normalLogin.php" method="post"  data-ajax="false">
                    <h3>Sign In</h3>
            
                    <label for="emailAddress">Email Address</label>
                    <input type="text" name="emailAddress" id="emailAddress">

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="">
         <div data-role="popup" id="popupSignIn" class="ui-content" data-position-to="origin" style="max-width:280px">
             <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right" data-position-to="origin" >Close</a>
             <p id="signInError">Details about Sign in error goes here</p>
         </div>
                    <div>
                        <button class="ui-btn" name="submit" id="submit"  type="submit">Sign in</button>

                    </div>
    </form>

                    <div>
<h4>Or Try Facebook Login</h4>

                        <?php
                        /**
                         * Created by PhpStorm.
                         * User: dylan
                         * Date: 11/6/2015
                         * Time: 8:32 PM*/
                        session_start();
                        require_once'php/facebook/facebook-php-sdk-v4-5.0.0/src/Facebook/autoload.php';
                        $fb = new Facebook\Facebook([
                            'app_id' => '1704809339752311',
                            'app_secret' => '91b32c37590a6e659a30566f37380e2c',
                            'default_graph_version' => 'v2.5',
                        ]);

                        $helper = $fb->getRedirectLoginHelper();

                        $permissions = ['email']; // Optional permissions
                        $loginUrl = $helper->getLoginUrl('http://localhost/EarthquakeLocator/php/facebook/callback.php', $permissions); //modifyit


                        echo '<a href="' . $loginUrl . '" data-role="button">Log in with Facebook!</a>';
                        ?>
                    </div>
      <div>
          <a href="signUp.html">if you don't have an account,Register here</a>
      </div>
                </div>
              

            </div>    
    
    
    
    
    <div data-role="page" id="dialog" data-theme="b">
  <div data-role="header">
    <h1>Notice</h1>
  </div>    
  <div data-role="content" id="text">
    <p id="errMsg"></p>
  </div>    
</div>   
<script>

    $(document).ready(function(){
        function $_GET(q,s) {
            s = (s) ? s : window.location.search;
            var re = new RegExp('&amp;'+q+'=([^&amp;]*)','i');
            return (s=s.replace(/^\?/,'&amp;').match(re)) ?s=s[1] :s='';
        }

        //validate data on click
        $('form').on('submit', function(e){
            var valid;
            if(document.getElementById("emailAddress").value==""){
                var errorcode=1;
valid=false;

            }

            if(document.getElementById("password").value==""){
                errorcode=2;
                valid=false; //mark data as invalid


            }

            if(valid==false) { // data is invalid
                console.log(valid);


                    $("#signInError").html("please Enter email & password");
                    $("#popupSignIn").popup({theme: "b"}); //initial popup with theme color
                    $("#popupSignIn").popup("open");




                e.preventDefault();
            }
        });


            var value = $_GET('signInResponse');
       if(value=="notRegister"){
           var clean_uri = location.protocol + "//" + location.host + location.pathname;
           window.history.replaceState({}, document.title, clean_uri);

           setTimeout(function () {
               $("#signInError").html("you are not register");
               $("#popupSignIn").popup({theme: "b"}); //initial popup with theme color
               $("#popupSignIn").popup("open");
           }, 1000);




       }
        if(value=="wrong"){
            var clean_uri = location.protocol + "//" + location.host + location.pathname;
            window.history.replaceState({}, document.title, clean_uri);

            setTimeout(function () {
                $("#signInError").html("check password and email");
                $("#popupSignIn").popup({theme: "b"}); //initial popup with theme color
                $("#popupSignIn").popup("open");
            }, 1000);




        }
    });
</script>
    
    
    


</body>
</html>
