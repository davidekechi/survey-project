<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Project</title>

    <style>
        /* Spinner styles */
        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid rgb(0,0,0); /* Color of the spinner */
            border-radius: 50%;
            width: 80px;
            height: 80px;
            animation: spin 1s linear infinite;
        }

        /* Animation for the spinner */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div id="app"></div> <!-- Vue.js App Mounting Point -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>
