<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP Error</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f7f7f7; color: #222; }
        .box { max-width: 900px; margin: 0 auto; background: #fff; border: 1px solid #ddd; border-radius: 6px; padding: 24px; }
        h1 { margin-top: 0; color: #b00020; }
        .meta { margin-bottom: 16px; }
        pre { white-space: pre-wrap; background: #f3f3f3; padding: 16px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="box">
        <h1><?php echo htmlspecialchars($severity, ENT_QUOTES, 'UTF-8'); ?></h1>
        <div class="meta"><strong>File:</strong> <?php echo htmlspecialchars($filepath, ENT_QUOTES, 'UTF-8'); ?> (line <?php echo (int) $line; ?>)</div>
        <pre><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></pre>
    </div>
</body>
</html>
