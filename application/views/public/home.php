<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TikTok Agency</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }
        .wrap {
            max-width: 980px;
            margin: 60px auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
            padding: 40px 32px;
        }
        h1 {
            margin-top: 0;
            font-size: 2.4rem;
            color: #111827;
        }
        p {
            line-height: 1.7;
            color: #374151;
            font-size: 1.05rem;
        }
        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
        }
        .btn.primary {
            background: #2563eb;
            color: white;
        }
        .btn.secondary {
            background: #eef2ff;
            color: #1e3a8a;
        }
        .legal {
            margin-top: 30px;
            border-top: 1px solid #e5e7eb;
            padding-top: 18px;
        }
        .legal a {
            color: #2563eb;
            text-decoration: none;
            margin-right: 12px;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <h1>TikTok Agency</h1>
        <p>Welcome to TikTok Agency, a public service dashboard for managing TikTok workflow, integrations, and account access. This website is intended for official app verification and client-facing platform operations.</p>
        <p>Use the login page to access the protected dashboard. Public pages are available for legal and policy verification.</p>

        <div class="actions">
            <a class="btn primary" href="<?php echo site_url('login'); ?>">Login</a>
            <a class="btn secondary" href="<?php echo site_url('terms'); ?>">Terms</a>
            <a class="btn secondary" href="<?php echo site_url('privacy'); ?>">Privacy</a>
        </div>

        <div class="legal">
            <a href="<?php echo site_url('terms'); ?>">Terms of Service</a>
            <a href="<?php echo site_url('privacy'); ?>">Privacy Policy</a>
        </div>
    </div>
</body>
</html>
