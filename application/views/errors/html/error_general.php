<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo isset($heading) ? htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') : 'Error'; ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f7f7f7; color: #222; }
        .box { max-width: 760px; margin: 0 auto; background: #fff; border: 1px solid #ddd; border-radius: 6px; padding: 24px; }
        h1 { margin-top: 0; color: #b00020; }
        p { line-height: 1.6; }
    </style>
</head>
<body>
    <div class="box">
        <h1><?php echo isset($heading) ? htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') : 'Error'; ?></h1>
        <?php echo isset($message) ? $message : ''; ?>
    </div>
</body>
</html>
