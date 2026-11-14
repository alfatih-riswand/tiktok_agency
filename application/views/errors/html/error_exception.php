<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Exception</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f7f7f7; color: #222; }
        .box { max-width: 900px; margin: 0 auto; background: #fff; border: 1px solid #ddd; border-radius: 6px; padding: 24px; }
        h1 { margin-top: 0; color: #b00020; }
        pre { white-space: pre-wrap; word-break: break-word; background: #f3f3f3; padding: 16px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Exception</h1>
        <pre><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></pre>
    </div>
</body>
</html>
