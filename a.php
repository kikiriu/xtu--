<!DOCTYPE html>
<html>
<head>
    <title>WebSocket Test</title>
</head>
<body>
    <h1>WebSocket Test</h1>
    <input id="message" type="text" placeholder="Enter message" />
    <button onclick="sendMessage()">Send</button>
    <div id="output"></div>

    <script>
        const ws = new WebSocket('ws://localhost:8080');

        ws.onopen = function() {
            document.getElementById('output').innerHTML += 'Connected to WebSocket server<br>';
        };

        ws.onmessage = function(event) {
            document.getElementById('output').innerHTML += 'Received: ' + event.data + '<br>';
        };

        ws.onclose = function() {
            document.getElementById('output').innerHTML += 'Disconnected from WebSocket server<br>';
        };

        function sendMessage() {
            const message = document.getElementById('message').value;
            ws.send(message);
            document.getElementById('output').innerHTML += 'Sent: ' + message + '<br>';
        }
    </script>
</body>
</html>
