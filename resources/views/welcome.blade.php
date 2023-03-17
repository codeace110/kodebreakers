<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kodebreakers</title>
    <link href="https://fonts.googleapis.com/css?family=Figtree:400,600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-beta1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/codemirror.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/theme/dracula.min.css" rel="stylesheet">
    <style>
        .output-container {
            height: 300px;
            overflow: auto;
            color: red;
        }

        .editor-container {
            height: 500px;
        }

        #editor,
        .CodeMirror {
            height: 100%;
        }

        /* Style the editor and output container */
        .CodeMirror {
            height: 100%;
            font-family: "Figtree", sans-serif;
            font-size: 1rem;
            border: none;
        }

        .output-container {
            height: 100%;
            overflow: auto;
            color: red;
            border: none;
        }

        /* Style the container and body */
        body {
            background-color: #f8f8f8;
        }

        .container {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            padding: 2rem;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h1>Welcome to Kodebreakers!</h1>
        <p>This is a simple online code editor that you can use to learn how to write code in various programming languages.</p>

        <div class="container">
        <button onclick="runCode()" class="btn btn-primary my-3">Run</button>
            <div class="col">

                <div class="col-md-6">
                    <div class="col-md-6">
                        <h2>Code Editor</h2>
                        <p>Enter your code in the editor below, then click the "Run" button to see the output.</p>
                        <div class="editor-container border border-dark">
                            <textarea id="editor"></textarea>
                        </div>
                    </div>
                </div>


                <div class="container">
                     <h2>Output</h2>
                        <p>The output of your code will appear in the area below.</p>
                    <div class="col">
                        <div class="col-md-3">
                            <div id="output-container" class="border border-dark output-container w-100"></div>
                        </div>
                    </div>


                </div>


            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/codemirror.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/mode/javascript/javascript.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/addon/edit/matchbrackets.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.62.2/addon/edit/closebrackets.min.js"></script>
            <script>
                function runCode() {
                    var outputContainer = document.getElementById('output-container');
                    var code = editor.getValue();

                    // Clear the output container
                    outputContainer.innerHTML = '';

                    // Redirect console.log() to the output container
                    var oldLog = console.log;
                    console.log = function(message) {
                        var pre = document.createElement('pre');
                        pre.innerText = message;
                        outputContainer.appendChild(pre);
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
</body>

</html>