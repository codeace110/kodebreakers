<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kodebreakers</title>
    <script src="https://apis.google.com/js/api.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Figtree:400,600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-beta1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/codemirror.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/theme/dracula.min.css" rel="stylesheet">

    <style>
        /*********** dark and light mode**************** */
        /* Dark Theme */
        .dark-theme {
            background-color: #222;
            color: #fff;
        }

        .dark-theme .top-container {
            background-color: #333;
            color: #fff;
        }

        .dark-theme .btn {
            background-color: #0077b3;
            color: #fff;
        }

        .dark-theme h1,
        .dark-theme h2,
        .dark-theme p,
        .dark-theme label {
            color: #fff;
        }

        .dark-theme .nav-link {
            background-color: #3e8e41;
            color: #fff;
        }

        .dark-theme #youtube {
            background-color: #333;
        }

        .dark-theme #editor {
            background-color: #222;
            color: #fff;
        }

        .dark-theme #output-container {
            background-color: white;
            color: #fff;
        }

        /************ code mirror*************** */
        .CodeMirror {
            padding-top: 20px;
            padding-right: 10px;
            padding-bottom: 20px;
            padding-left: 30px;

            font-size: 17px;
            font-weight: 800;
        }

        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        h1,
        h2 {
            font-weight: bold;
            text-align: center;
        }

        p {
            text-align: center;
        }

        /************ container for outpu*************** */
        .top-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            max-width: 80%vw;
            margin: auto;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .col {
            flex: 1;
            padding: 0 10px;
        }

        .col-md-6 {
            flex-basis: 50%;
            max-width: 50%;
            padding: 0 10px;
        }

        .btn {
            width: 200px;
            height: 50px;
            display: inline-block;
            border: none;
            border-radius: 5px;
            margin-bottom: -20px;
            background-color: #1e90ff;
            color: #fff;
            font-size: 11px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .btn:hover {
            background-color: #0077b3;
        }

        /****************youtube iframe************************/

        #youtube {
            margin-top: 5px;
            width: 100%;
            height: 639px;
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden;
            display: flex;

        }

        .editor-container {
            width: 100%;
            height: 470px;
            margin-bottom: 20px;
            border-radius: 0px 0px 5px 5px;
            overflow: hidden;
            display: flex;


        }

        #editor {

            flex: 1;
            border: none;
            background-color: transparent;
            font-family: monospace;
            resize: none;
            padding: 20px;

        }

        .output-container {
            width: 100%;
            height: 150px;
            margin-bottom: 20px;
            border-radius: 5px;
            overflow-y: scroll;
            overflow-x: hidden;

        }

        #output-container {
            padding: 15px;
            width: 85%;
            height: 100%;
            border: none;
            background-color: #fff;
            font-family: monospace;
            font-size: 16px;
            color: green;
            font-weight: 900;
            overflow-y: none;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
        }

        /* Media Queries */
        @media screen and (max-width: 767px) {
            .col-md-6 {
                flex-basis: 100%;
                max-width: 100%;
            }
        }

        .nav-link {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #4caf50;
            color: #fff;
            border-radius: 0.25rem;
            text-decoration: none;
            transition: background-color 0.3s ease-in-out;
        }

        .nav-link:hover {
            background-color: #3e8e41;
        }

        /************youtube videos*************** */
        form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2px;
        }

        input[type="text"] {
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            width: 70%;
            margin-right: 10px;
            background-color: none;
        }

        button[type="submit"] {
            background-color: #0073e6;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0066cc;
        }
    </style>
</head>

<body>
    <div class="top-container">
        @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            @auth
            <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="nav-link">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="nav-link">Register</a>
            @endif
            @endauth
        </div>
        @endif
        <h1>Welcome to Kodebreakers!</h1>
        <button id="theme-toggle" class="btn">Toggle Theme</button>
        <div class="row">
            <div class="col-md-6">
                <h2>Code Editor</h2>
                <p>Enter your code in the editor below, then click the "Run" button to see the output.</p>

            </div>
            <div class="col">
                <h2>Output</h2>
                <p>The output of your code will appear in the area below.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form onsubmit="return searchYouTube();">
                    <input type="text" id="search" placeholder="Search YouTube">
                    <button type="submit">Search</button>
                </form>
                <!-- Add an iframe container for the YouTube video -->
                <iframe id="youtube" src="https://www.youtube.com/embed/PkZNo7MFNFg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col">
                <div class="output-container">
                    <div id="output-container">
                    </div>
                </div>
                <div class="container text-center">
                    <div class="row align-items-start">
                        <div class="col">
                            <button onclick="runCode()" class="btn">
                                <h1>RUN</h1>
                            </button>
                        </div>
                        <div class="col-2" styl>
                            <button style="width:150px;" class="btn">
                                <h1>LOG</h1>
                            </button>
                        </div>
                        <div class="col">
                            <button style="width:150px;" class="btn">
                                <h1>Output</h1>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="editor-container">
                    <textarea id="editor"></textarea>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/addon/edit/matchbrackets.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/addon/edit/closebrackets.min.js"></script>
    <script>
        const toggleButton = document.getElementById("theme-toggle");
        const body = document.body;

        toggleButton.addEventListener("click", function() {
            body.classList.toggle("dark-theme");
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            initEditor();
        });
    </script>
    <script>
        function runCode() {
            var outputContainer = document.getElementById('output-container');
            var code = editor.getValue();
            // Clear the output container
            outputContainer.innerHTML = '';
            // Redirect console.log() to the output container



            var oldLog = console.log;
            console.log = function(message) {
                var div = document.createElement('div');
                div.innerText = message;
                outputContainer.appendChild(div);

            };
            // Try to run the code and catch any errors
            try {
                eval(code);
            } catch (error) {
                // If an error occurs, display it in the output container
                var p = document.createElement('p');
                p.innerText = 'Error: ' + error.message;
                p.style.color = 'red';
                outputContainer.appendChild(p);
            }
            // Restore console.log()
            console.log = oldLog;
        };
        var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
            lineNumbers: true,
            matchBrackets: true,
            autoCloseBrackets: true,
            mode: "javascript",
            theme: "dracula"
        });
        // Set the editor width and height
        editor.setSize("100%", "100%");
        // Set the output container height
        var outputContainer = document.getElementById('output-container');
        outputContainer.style.height = (window.innerHeight - 120) + 'px';
        // Listen for window resize events and adjust the output container height accordingly
        window.addEventListener('resize', function() {
            outputContainer.style.height = (window.innerHeight - 120) + 'px';
        });
    </script>
    <script>
        // Define the CodeMirror editor
        const editor = CodeMirror.fromTextArea(document.getElementById('editor'), {
            lineNumbers: true,
            matchBrackets: true,
            autoCloseBrackets: true,
            mode: 'javascript',
            theme: 'dracula',
        });

        // Set the editor width and height
        editor.setSize('100%', '100%');

        // Set the output container height
        const outputContainer = document.getElementById('output-container');
        outputContainer.style.height = `${window.innerHeight - 120}px`;

        // Listen for window resize events and adjust the output container height accordingly
        window.addEventListener('resize', () => {
            outputContainer.style.height = `${window.innerHeight - 120}px`;
        });
    </script>
</body>

</html>