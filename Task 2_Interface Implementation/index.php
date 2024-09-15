<?php

require_once 'LoggerInterface.php';
require_once 'FileLogger.php';
require_once 'ScreenLogger.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Logger</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        .log-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .log-message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 10px;
            margin-bottom: 10px;
            border-left: 4px solid #3c763d;
        }
    </style>
</head>
<body>

    <h1>Logging System</h1>
    <div class="log-container">
        <?php
        date_default_timezone_set('Asia/Dhaka');

        $fileLogger = new FileLogger('app.log');
        $fileLogger->log("Logging to a file at " . date('Y-m-d H:i:s'));

        $screenLogger = new ScreenLogger();
        $screenLogger->log("Logging to the screen at " . date('Y-m-d H:i:s'));
        ?>
    </div>

</body>
</html>
