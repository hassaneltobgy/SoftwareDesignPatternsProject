<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Screen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: blueviolet;
            margin: 0;
        }

        .message-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .message-container p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .message-container button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .message-container button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <p>
            <?php 
            // Display the message passed via the query string
            echo isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'No message available.'; 
            ?>
        </p>
        <button onclick="window.location.href='OrganizationView.php';">Back to Home</button>
    </div>
</body>
</html>
