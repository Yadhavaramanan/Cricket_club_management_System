<!DOCTYPE html>
<html>
<head>
    <title>Message</title>
</head>
<body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var params = new URLSearchParams(window.location.search);
            if (params.has('message')) {
                var message = params.get('message');
                alert(message);
                window.location.href = "/dbms/index.php";
            } else {
                // If there's no message parameter, redirect to index.php directly
                window.location.href = "/dbms/index.php";
            }
        });
    </script>
</body>
</html>
