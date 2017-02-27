<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine or request Chrome Frame -->
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Use title if it's in the page YAML frontmatter -->
  <title>Welcome to OMQ</title>

  <link href="/dashboard/stylesheets/normalize.css" rel="stylesheet" type="text/css" /><link href="/dashboard/stylesheets/all.css" rel="stylesheet" type="text/css" />
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  <script src="/dashboard/javascripts/modernizr.js" type="text/javascript"></script>
  <link href="/dashboard/images/samsung.svg" rel="icon" type="image/png" />
  
  <?php
  if( empty($_GET['id']) == false ) {
    echo file_get_contents($_GET['id']."_head.html");
  }
  ?>

</head>

<body class="index">

  <div class="contain-to-grid">
    <nav class="top-bar" data-topbar>
      <ul class="title-area">
        <li class="name">
          <h1><a href="/dashboard/index.html">Home</a></h1>
        </li>
        <li class="toggle-topbar menu-icon">
          <a href="#">
            <span>Menu</span>
          </a>
        </li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
          <li class=""><a href="/dashboard/kpi.php?id=qm">Quality Management</a></li>
          <li class=""><a href="/dashboard/kpi.php?id=iqc">IQC</a></li>
          <li class=""><a href="/dashboard/kpi.php?id=vendor">Vendor</a></li>
          <li class=""><a href="/dashboard/kpi.php?id=prod">Production</a></li>
          <li class=""><a href="/dashboard/kpi.php?id=oqc">OQC</a></li>
          <li class=""><a href="/dashboard/kpi.php?id=market">Market Quality</a></li>
          <li class=""><a href="/apache/phpmyadmin/">phpMyAdmin</a></li>
        </ul>
      </section>
    </nav>
  </div>

  <?php
  if( empty($_GET['id']) == false ) {
    echo file_get_contents($_GET['id'].".html");
    }
  ?>

<!-- Remove Black Bottom Down -->
<div class="row">
 <div class="large-12 columns">
   <h2></h2>
 </div>
</div>
<div class="row">
 <div class="large-12 columns">
   <p>
   </p>
 </div>
</div>
</div>

<footer>
  <div class="row">
    <div class="large-12 columns">
      <div class="row">
        <div class="large-8 columns">
          <ul class="inline-list">
            <li><a href="http://bligh.iptime.org:8000/dashboard/index.html">Community</a></li>
            <li>
            <a target="_blank" href="http://bligh.iptime.org:8000/dashboard/index.html">                    Designed by Sangyeon Park
              </a>
            </li>
          </ul>
        </div>
        <div class="large-4 columns">
          <p class="text-right">Copyright (c) 2016, Overseas Manufacture Quality</p>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- JS Libraries -->
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="/dashboard/javascripts/all.js" type="text/javascript"></script>
</body>
</html>
