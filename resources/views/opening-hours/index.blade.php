<!DOCTYPE html>
<html>
<head>
    <title>Opening Hours</title>
</head>
<body>

    @if($hours)
        <h1>Opening Hours</h1>
        <p>From: {{ $hours['from_hour'] }}</p>
        <p>To: {{ $hours['to_hour'] }}</p>
    @endif
</body>
</html>