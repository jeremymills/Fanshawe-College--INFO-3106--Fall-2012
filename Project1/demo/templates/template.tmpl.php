<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>Demo - Form Views</title>
  
  <link rel="stylesheet" href="../demo/public/css/foundation.css">
  <link rel="stylesheet" href="../demo/public/css/foundation.min.css">
  <link rel="stylesheet" href="../demo/public/css/app.css">

  <script src="../demo/public/js/modernizr.foundation.js"></script>
  

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>
<div class="wrapper">
    <header id="header">
        <div class="row">
            <div class="twelve columns">
                <h1>Form Views Library</h1>
                <h4 class="description">Demo for Project 1 solution</h4>
            </div>
        </div>
    </header>
    <section id="main">
        <div class="row">
            <div class="three columns">
                <nav id="sidebar">
                    <?php if( !empty($navigation) ) : ?>
                    <ul class="nav-bar vertical">
                        <?php foreach( $navigation as $navItem ) : ?>
                        <li<?php print isset($navItem['#active']) && $navItem['#active'] ? ' class="active"' : ''; ?>><a href="<?php print $navItem['#href']; ?>" title="<?php print $navItem['#title']; ?>"><?php print $navItem['#title']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </nav>
            </div>
            <div class="nine columns">
                <?php print $content; ?>
            </div>
        </div>
    </section>
    <footer id="footer">
        <div class="row">
            <div class="twelve columns">
                <p>Copyright <a href="#" title="Fanshawe College">JeremyMills</a> &copy; 2012. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</div>
<script src="../demo/public/js/jquery.js"></script>
<script src="../demo/public/js/foundation.min.js"></script>
<script src="../demo/public/js/app.js"></script>
</body>
</html>
