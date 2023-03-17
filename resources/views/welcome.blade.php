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
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1>Welcome to Kodebreakers!</h1>
        <p>This is a simple online code editor that you can use to learn how to write code in various programming languages.</p>
        <div class="row my-5">
            <div class="col-md-6">
                <h2>Code Editor</h2>
                <p>Enter your code in the text area below, then click the "Run" button to see the output.</p>
                <textarea id="editor"></textarea>
                <button onclick="runCode()" class="btn btn-primary my-3">Run</button>
            </div>
            <div class="col-md-6">
                <h2>Output</h2>
                <p>The output of your code will appear in the area below.</p>
                <div id="output-container" class="border border-dark output-container w-100"></div>
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
            var code = document.getElementById('editor').value;

            // Clear the output container
            outputContainer.innerHTML = '';

            // Try to run the code and catch any errors
            try {
                var result = eval(code);
                outputContainer.textContent = result;
            } catch (error) {
                // If an error occurs, display it in the output container
                outputContainer.innerHTML = '<p style="color:red;">Error: ' + error.message + '</p>';
            }
        }
        
        var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
            lineNumbers: true,
            matchBrackets: true,
            autoCloseBrackets: true,
            mode: "javascript",
            theme: "dracula"
        });
    </script>
</body>
</html>