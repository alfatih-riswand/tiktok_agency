<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?=html_escape(isset($title)?$title:'Dashboard')?> | TikTok Agency</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="<?=base_url('assets/css/app.css?v=20261115')?>" rel="stylesheet">
</head>
<body>
<?php $current_route = $this->uri->segment(1); $current_uri = trim($this->uri->uri_string(), '/'); ?>
<div class="sidebar">
  <div class="brand-wrap">
    <div class="brand-mark"><i class="fab fa-tiktok"></i></div>
    <div class="brand-text"><span>TikTok</span></div>
  </div>
  <nav class="side-nav">
    <a href="<?=site_url('dashboard')?>" class="<?=($current_route === 'dashboard' || $current_route === '') ? 'active' : ''?>"><i class="fas fa-chart-pie"></i> Dashboard</a>
    <a href="<?=site_url('crud/index/live_sessions')?>" class="<?=($current_uri === 'crud/index/live_sessions') ? 'active' : ''?>"><i class="fas fa-broadcast-tower"></i> Live Monitoring</a>
    <a href="<?=site_url('crud/index/campaigns')?>" class="<?=($current_uri === 'crud/index/campaigns') ? 'active' : ''?>"><i class="fas fa-bullhorn"></i> Campaign</a>
    <a href="<?=site_url('crud/index/contents')?>" class="<?=($current_uri === 'crud/index/contents') ? 'active' : ''?>"><i class="fas fa-photo-video"></i> Content</a>
    <a href="<?=site_url('crud/index/creators')?>" class="<?=($current_uri === 'crud/index/creators') ? 'active' : ''?>"><i class="fas fa-users"></i> Creator</a>
    <a href="<?=site_url('crud/index/agencies')?>" class="<?=($current_uri === 'crud/index/agencies') ? 'active' : ''?>"><i class="fas fa-building"></i> Agency</a>
    <a href="<?=site_url('crud/index/products')?>" class="<?=($current_uri === 'crud/index/products') ? 'active' : ''?>"><i class="fas fa-shopping-bag"></i> Product</a>
    <a href="<?=site_url('report')?>" class="<?=($current_route === 'report') ? 'active' : ''?>"><i class="fas fa-file-chart-line"></i> Report</a>
    <a href="<?=site_url('integration')?>" class="<?=($current_route === 'integration') ? 'active' : ''?>"><i class="fas fa-plug"></i> Integrasi API</a>
    <?php if(isset($current_user['role']) && $current_user['role']==='admin'):?><a href="<?=site_url('users')?>" class="<?=($current_route === 'users') ? 'active' : ''?>"><i class="fas fa-user-shield"></i> Users</a><?php endif;?>
  </nav>
  <div class="side-bottom"><a href="<?=site_url('logout')?>"><i class="fas fa-sign-out-alt"></i> Logout</a></div>
</div>

<main class="main">
  <header class="topbar">
    <div class="brand-header">
      <div class="tiktok-logo"><i class="fab fa-tiktok"></i></div>
      <div>
        <h1><?=html_escape(isset($title)?$title:'Agency Monitoring Dashboard')?></h1>
        <p>Performance &amp; Campaign Monitoring</p>
      </div>
    </div>
    <div class="topbar-tools">
      <div class="date-pill"><i class="far fa-calendar-alt"></i> 1 Nov 2026 – 14 Nov 2026</div>
      <div class="user-pill">
        <span class="avatar-mini"><i class="fas fa-user"></i></span>
        <span><?=html_escape(isset($current_user['name'])?$current_user['name']:'RPT Agency')?></span>
      </div>
    </div>
  </header>

  <?php if($this->session->flashdata('success')):?><div class="alert alert-success"><?=html_escape($this->session->flashdata('success'))?></div><?php endif;?>
  <?php if($this->session->flashdata('error')):?><div class="alert alert-danger"><?=html_escape($this->session->flashdata('error'))?></div><?php endif;?>

  <?php $this->load->view($page_view); ?>

  <footer class="page-footer">TikTok Agency Monitoring · Data sesuai izin API yang terhubung</footer>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="<?=base_url('assets/js/app.js?v=20261115')?>"></script>
</body>
</html>
