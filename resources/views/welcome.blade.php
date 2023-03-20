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
        /*************************** */
        .CodeMirror {
            padding-top: 50px;
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
            width: 100%;
            height: 6%;
            display: inline-block;

            border: none;
            border-radius: 5px;
            background-color: #1e90ff;
            color: #fff;
            font-size: 11px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .btn:hover {
            background-color: #0077b3;
        }

        /****************************************/

        #youtube {

            width: 100%;
            height: 680px;
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden;
            display: flex;

        }

        .editor-container {
            width: 100%;
            height: 470px;
            margin-bottom: 20px;
            border-radius: 5px;
            overflow: hidden;
            display: flex;
        }

        #editor {

            flex: 1;
            border: none;
            background-color: transparent;
            font-family: monospace;
            resize: none;
            padding: 50px;
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
            padding: 50px;
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

        /** youtube videos */
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
                    <iframe id="output-container"></iframe>
                </div>
                <button onclick="runCode()" class="btn">
                    <h1>RUN</h1>
                </button>
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
        document.addEventListener("DOMContentLoaded", function(event) {
            initEditor();
        });
    </script>
    <script>
        function searchYouTube() {
            // Check if the gapi client library has finished loading and initializing
            if (!gapi.client) {
                console.error("Error: gapi client library not available.");
                return false;
            }

            // Check if the youtube object is defined
            if (!gapi.client.youtube) {
                console.error("Error: gapi client library loaded, but youtube object not available.");
                return false;
            }

            // Get the search query from the input field
            var query = document.getElementById("search").value;

            // Use the YouTube API to search for videos
            gapi.client.youtube.search.list({
                q: query,
                part: "snippet",
                maxResults: 1,
            }).then(function(response) {
                var videoId = response.result.items[0].id.videoId;
                var videoUrl = "https://www.youtube.com/embed/" + videoId;

                // Set the iframe source to the search result video URL
                document.getElementById("youtube").src = videoUrl;
            }, function(error) {
                console.error("Error searching YouTube: " + error.result.error.message);
            });

            // Prevent the form from submitting and reloading the page
            return false;
        }

        function init() {
            // Load the YouTube API client library
            gapi.load("client", function() {
                gapi.client.init({
                    apiKey: "AIzaSyA1OfrmluYM9HIQqJZRCpQ6VVwTELD8yaU",
                    discoveryDocs: ["https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest"],
                }).then(function() {
                    // gapi is ready, call searchYouTube() function
                    console.log("gapi ready");
                }, function(error) {
                    console.error("Error initializing gapi client: " + error);
                });
            });
        }

        // Add an event listener to wait for the window to load before calling init()
        window.addEventListener('load', init);
    </script>
    <script>
        function runCode() {
            var outputContainer = document.getElementById('output-container');
            var code = editor.getValue();

            // Clear the output container
            outputContainer.contentWindow.document.body.innerHTML = '';

            // Redirect console.log() to the output container
            var oldLog = console.log;
            console.log = function(message) {
                var pre = outputContainer.contentWindow.document.createElement('pre');
                pre.innerText = message;
                outputContainer.contentWindow.document.body.appendChild(pre);
            };

            // Try to run the code and catch any errors
            try {
                outputContainer.contentWindow.eval(code);
            } catch (error) {
                // If an error occurs, display a custom error message in the output container
                var errorMessage = 'Error: ' + error.name + '\nMessage: ' + error.message + '\n\n';
                errorMessage += 'Possible fix: ';
                switch (error.name) {
                    case 'SyntaxError':
                        errorMessage += 'Check for syntax errors in your code and correct them.';
                        break;
                    case 'ReferenceError':
                        errorMessage += 'Make sure that all variable and function names are spelled correctly and exist in the current scope.';
                        break;
                    case 'TypeError':
                        errorMessage += 'Check the data types of your variables and make sure that they are used correctly in your code.';
                        break;
                    default:
                        errorMessage += 'Check your code for any errors and try again.';
                }
                var p = outputContainer.contentWindow.document.createElement('p');
                p.innerText = errorMessage;
                p.style.color = 'red';
                outputContainer.contentWindow.document.body.appendChild(p);
            }

            // Restore console.log()
            console.log = oldLog;
        };
        var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
            lineNumbers: true,
            matchBrackets: true,
            autoCloseBrackets: true,
            mode: "javascript",
            theme: "dracula",

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
</body>

</html>