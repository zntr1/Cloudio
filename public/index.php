<?php
//include config
require_once('../script/config.php');

//check if already logged in move to home page
//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: home.php'); }

?>
<!DOCTYPE html>
<html>
<script src="../jquery-1.7.1.js"></script>


<link rel="stylesheet" href="../css/styles.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<title>Cloud.ia</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">


<body>

<!-- Top container -->
<div class="w3-bar w3-top w3-blue-gray w3-large" style="z-index:50">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i
            class="fa fa-bars"></i>
    </button>
    <span class="w3-bar-item w3-right"><a href="index.html">Cloud.io</a></span>
</div>


<!-- Sidebar/menu -->
<nav id="mySidebar" class="w3-sidebar w3-collapse w3-white w3-animate-left"><br>
    <div class="w3-container">
        <h5>Dashboard</h5>
    </div>
    <hr/>
    <div class="w3-bar-block">

        <br>
        <a id="menuAccount" onclick="load_accountPage();" class="w3-bar-item w3-button w3-padding w3-blue-gray"><i
                class="fa fa-users fa-fw"></i>  Mein Account</a>
        <a id="menuData" onclick="load_storagePage();" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-files-o fa-fw"></i> 
            Meine Dateien</a>

        <a id="menuPermission" onclick="load_permissionsPage();" class="w3-bar-item w3-button w3-padding "><i
                class="fa fa-eye fa-fw"></i> 
            Freigabe</a>
        <a id="menuPremium" onclick="load_premiumPage();" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-diamond fa-fw"></i> 
            Premium</a>
        <a id="menuSettings" onclick="load_settingsPage();" class="w3-bar-item w3-button w3-padding"><i
                class="fa fa-cog fa-fw"></i> 
            Einstellungen</a><br>
        <hr>
        <a href="#" class="w3-bar-item w3-button w3-padding"
           onclick="w3_close()" title="close menu"><i class="fa fa-angle-double-left"></i>  Verbergen</a>

    </div>


    <!-- Footer -->
    <footer id="sidebarFooter" class="w3-container w3-padding-16 w3-white" style="text-align: center;">
        <p> © 2017 - Cloud.io </p>
    </footer>
</nav>

<!-- !PAGE CONTENT! -->
<div id="main" class="w3-main">

</div>
    <script>


        // Get the Sidebar
        var mySidebar = document.getElementById("mySidebar");
        var mainContent = document.getElementById("main");
        // Get the DIV with overlay effect
//        var overlayBg = document.getElementById("myOverlay");

        // Toggle between showing and hiding the sidebar, and add overlay effect
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mainContent.style.marginLeft = '0';
                mySidebar.style.display = 'none';
//                overlayBg.style.display = "none";
            } else {
                mainContent.style.marginLeft = '300px';
                mySidebar.style.display = 'block';
//                overlayBg.style.display = "block";
            }
        }

        // Close the sidebar with the close button
        function w3_close() {
            mainContent.style.marginLeft = '0';
            mySidebar.style.display = "none";
            //            overlayBg.style.display = "none";
        }

        function load_settingsPage() {
            document.getElementById("main").innerHTML = '<object type="text/html" data="settings.html" ></object>';
        }

        function load_permissionsPage() {
            document.getElementById("main").innerHTML = '<object type="text/html" data="permissions.html" ></object>';
        }

        function load_premiumPage() {
            document.getElementById("main").innerHTML = '<object type="text/html" data="premium.html" ></object>';
        }

        function load_storagePage() {
            document.getElementById("main").innerHTML = '<object type="text/html" data="storage.html" ></object>';
        }

        function load_accountPage() {
            document.getElementById("main").innerHTML = '<object type="text/html" data="userprofile.html" ></object>';
        }
    </script>

</body>
</html>
