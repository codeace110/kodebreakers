<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>kodebreakers</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="antialiased">
    <div class="container my-5">
        <h1>Welcome to Kodebreakers!</h1>
        <p>This is a simple online code editor that you can use to learn how to write code in various programming languages.</p>
        <div class="row my-5">
            <div class="col-md-6">
                <h2>Code Editor</h2>
                <p>Enter your code in the text area below, then click the "Run" button to see the output.</p>
                <textarea id="editor" class="form-control"></textarea>
                <button onclick="runCode()" class="btn btn-primary my-3">Run</button>
            </div>
            <div class="col-md-6">
                <h2>Output</h2>
                <p>The output of your code will appear in the area below.</p>
                <iframe id="output" class="border border-dark w-100" height="300"></iframe>
            </div>
        </div>
    </div>
    <script>
        function runCode() {
            var iframe = document.getElementById('output');
            var code = document.getElementById('editor').value;

            // Create a new window for the iframe
            var iframeWindow = iframe.contentWindow;
            var iframeDocument = iframeWindow.document;

            // Clear the iframe content
            iframeDocument.open();
            iframeDocument.write('');
            iframeDocument.close();

            // Try to run the code and catch any errors
            try {
                iframeWindow.eval(code);
            } catch (error) {
                // If an error occurs, display it in the output iframe
                iframeDocument.open();
                iframeDocument.write('<p style="color:red;">Error: ' + error.message + '</p>');
                iframeDocument.close();
            }
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>