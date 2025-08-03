<!DOCTYPE html>
<html>
<head>
    <title>Cashfree Response</title>
</head>
<body>
    {{-- <h1>Cashfree Payment Response (JSON)</h1> --}}
    <pre>
        {{ json_encode($data, JSON_PRETTY_PRINT) }}
    </pre>
</body>
</html>
