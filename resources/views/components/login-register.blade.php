<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-800 h-full">
    <main 
        style="background-image: url('https://i.ibb.co/hBCcT6V/background.jpg')"
        class="min-h-screen min-w-screen bg-no-repeat bg-cover bg-center"
    >
        {{ $slot }}
    </main>
    
</body>
</html>