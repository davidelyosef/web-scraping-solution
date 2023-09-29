<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Scraper</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script>
        function crawl() {
            var form = document.getElementById('crawler-form');
            var url = form.elements['url'].value;
            var depth = form.elements['depth'].value;
            var resultDiv = document.getElementById('result');
            var loader = document.getElementById('loader');
    
            // Display loader while data is being loaded
            loader.style.display = 'block';
    
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
                // Hide loader when data is loaded
                loader.style.display = 'none';
    
                // Display success message in a more appropriate way
                resultDiv.innerHTML = `
                    <div class="alert alert-success" role="alert">
                        ${data.message}
                    </div>`;
            })
            .catch(error => {
                // Hide loader in case of an error
                loader.style.display = 'none';
    
                // Display error message
                console.error('Error:', error);
                resultDiv.innerHTML = `
                    <div class="alert alert-danger" role="alert">
                        An error occurred during crawling.
                    </div>`;
            });
        }
    </script>
    


    {{-- <script>
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
    </script> --}}

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 600px;
        }

        .form-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .form-container label {
            font-weight: bold;
            color: #495057;
        }

        .form-container button {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Web Scraper</h1>
        <div id="loader" class="spinner-border text-primary" role="status" style="display: none;">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="form-container">
            <form id="crawler-form">
                <div class="mb-3">
                    <label for="url" class="form-label">URL:</label>
                    <input type="text" class="form-control" id="url" name="url" required>
                </div>

                <div class="mb-3">
                    <label for="depth" class="form-label">Crawling Depth:</label>
                    <input type="number" class="form-control" id="depth" name="depth" value="1" min="1">
                </div>

                <button type="button" class="btn btn-success" onclick="crawl()">Start Crawling</button>
            </form>

            <a class="btn btn-primary mt-3" href="{{ route("export.csv") }}">Export File</a>
            <div id="result" class="mt-3"></div>
        </div>
    </div>
</body>
</html>