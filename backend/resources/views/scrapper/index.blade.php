<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Scraper</title>
    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    
    <script>
        function crawl() {
            var form = document.getElementById('crawler-form');
            var url = form.elements['url'].value;
            var depth = form.elements['depth'].value;
            var resultDiv = document.getElementById('result');

            fetch('/crawl', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ url: url, depth: depth })
            })
            .then(response => response.json())
            .then(data => {
                resultDiv.innerHTML = data.message;
            })
            .catch(error => {
                console.error('Error:', error);
                resultDiv.innerHTML = 'An error occurred during crawling.';
            });
        }
    </script>

    <script>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
    </script>
</head>
<body>
    <form id="crawler-form">
        <label for="url">URL:</label>
        <input type="text" id="url" name="url" required>

        <label for="depth">Crawling Depth:</label>
        <input type="number" id="depth" name="depth" value="1" min="1">

        <button type="button" onclick="crawl()">Start Crawling</button>
    </form>

    <div id="result"></div>
</body>
</html>