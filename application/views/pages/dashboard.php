<?php
$cards = array(
    array('Total Views', number_format($kpi['views']), 'fa-eye', 'blue', '+18.6%', 'vs. previous'),
    array('Total Likes', number_format($kpi['likes']), 'fa-heart', 'pink', '+21.3%'),
    array('Total Comments', number_format($kpi['comments']), 'fa-comment', 'cyan', '+9.8%'),
    array('Total Shares', number_format($kpi['shares']), 'fa-share', 'violet', '+15.1%'),
    array('GMV (Sales)', 'Rp '.number_format($kpi['gmv'],0,',','.'), 'fa-wallet', 'rose', '+27.6%'),
);
?>
<div class="dashboard-shell">
  <div class="stats-grid">
    <?php foreach($cards as $card): ?>
      <div class="metric-card <?= $card[3] ?>-tint">
        <div class="metric-icon"><i class="fas <?= $card[2] ?>"></i></div>
        <div class="metric-body">
          <h3><?= $card[0] ?></h3>
          <div class="metric-value"><?= $card[1] ?></div>
          <div class="metric-trend"><span class="trend-up">▲</span> <?= $card[4] ?> <?php if(isset($card[5])): ?><small><?= $card[5] ?></small><?php endif; ?></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="overview-grid">
    <section class="panel chart-panel">
      <div class="panel-head">
        <h4>Performance Overview</h4>
        <div class="legend">
          <span><i class="dot cyan"></i> Views</span>
          <span><i class="dot pink"></i> GMV (Rp)</span>
        </div>
      </div>
      <div class="chart-wrap">
        <canvas id="performanceChart" height="170"></canvas>
      </div>
    </section>

    <aside class="panel live-panel">
      <div class="panel-head">
        <h4>Live Monitoring <span class="status-dot"></span> <span class="status-text">LIVE</span></h4>
      </div>
      <div class="live-card">
        <div class="creator-avatar"><i class="fas fa-user"></i></div>
        <div class="live-metrics">
          <div class="live-row"><span>Viewers</span><b>4,862</b></div>
          <div class="live-row"><span>Likes</span><b>28,640</b></div>
          <div class="live-row"><span>Comments</span><b>1,245</b></div>
          <div class="live-row"><span>GMV</span><b>Rp 56,780,000</b></div>
        </div>
      </div>
    </aside>
  </div>

  <div class="bottom-grid">
    <section class="panel category-panel">
      <div class="panel-head simple"><h4>Sales by Product Category</h4></div>
      <div class="donut-wrap">
        <div class="donut-chart">
          <div class="donut-inner">
            <strong>Rp 428.75M</strong>
            <span>Total GMV</span>
          </div>
        </div>
        <ul class="legend-list">
          <li><span class="swatch pink"></span> Beauty &amp; Care <b>38%</b></li>
          <li><span class="swatch cyan"></span> Fashion <b>24%</b></li>
          <li><span class="swatch violet"></span> Home &amp; Living <b>16%</b></li>
          <li><span class="swatch blue"></span> Elektronik <b>12%</b></li>
          <li><span class="swatch gray"></span> Lainnya <b>10%</b></li>
        </ul>
      </div>
    </section>

    <section class="panel creator-panel">
      <div class="panel-head simple"><h4>Top Agency / Creator</h4></div>
      <table class="rank-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Agency / Creator</th>
            <th>Views</th>
            <th>GMV (Rp)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach(array_slice($top_creators, 0, 5) as $i => $creator): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= html_escape($creator['name']) ?></td>
            <td><?= number_format($creator['views']) ?></td>
            <td><?= 'Rp '.number_format($creator['likes'] * 1200, 0, ',', '.') ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>

    <section class="panel video-panel">
      <div class="panel-head simple"><h4>Top Videos (by Views)</h4></div>
      <div class="video-list">
        <?php foreach(array_slice($top_videos, 0, 3) as $video): ?>
          <div class="video-item">
            <div class="video-thumb"><i class="fas fa-play"></i></div>
            <div class="video-info">
              <div class="video-title"><?= html_escape($video['title'] ?: 'Review Produk A') ?></div>
              <div class="video-meta"><?= number_format($video['views']) ?> Views</div>
            </div>
            <div class="video-growth">▲ 32.6%</div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </div>
</div>
<script>
window.chartLabels = <?=json_encode(array_column($chart,'day'))?>;
window.chartViews = <?=json_encode(array_map('intval', array_column($chart,'views')) )?>;
window.chartLikes = <?=json_encode(array_map('intval', array_column($chart,'likes')) )?>;
</script>
