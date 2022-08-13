<!DOCTYPE html>
<!--[if lt IE 7]>       <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>          <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>          <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <title><?= $page['title']; ?> <?php if ($page['title'] != $params['title']) {
            echo '- ' . $params['title'];
        } ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    $desc = $params->getCurrentPage()->getAttribute('description');
    if (!empty($desc)) {
        echo '<meta name="description" content="' . htmlentities($desc, ENT_QUOTES, 'UTF-8') . '" />';
    }
    else {
        echo '<meta name="description" content="The official documentation for modmore extras." />';
    }
    ?>

    <meta name="author" content="The modmore team &amp; contributors">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="https://assets.modmore.com/icon_180x180.png" type="image/x-icon">
    <!-- Mobile -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <script>
        window.base_url = "<?= $base_url?>";
        document.documentElement.classList.remove('no-js');
    </script>

    <!-- Font -->
    <?php foreach ($config->getTheme()->getFonts() as $font) { ?>
        <link href='<?= $font; ?>' rel='stylesheet' type='text/css'>
    <?php } ?>

    <!-- CSS -->
    <?php foreach ($config->getTheme()->getCSS() as $css) { ?>
        <link href='<?= $css; ?>' rel='stylesheet' type='text/css'>
    <?php } ?>
</head>
<body class="<?= $this->section('classes'); ?>">
<?= $this->section('content'); ?>

<script>
    if (window.location.host === 'docs.modmore.com') {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-39365923-5', 'auto');
        ga('send', 'pageview');
    }
</script>

<!-- jQuery -->
<script src="<?= $base_url; ?>themes/modmore/js/jquery-1.11.3.min.js"></script>

<!-- hightlight.js -->
<script src="<?= $base_url; ?>themes/modmore/js/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>


<!-- JS -->
<?php foreach ($config->getTheme()->getJS() as $js) { ?>
    <script src="<?= $js; ?>"></script>
<?php } ?>

<?php $this->insert('theme::partials/search_script', ['page' => $page, 'base_url' => $base_url]); ?>

<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
<script type="text/javascript">
    window.Beacon('init', 'f8dbaa92-b850-4dc5-a666-85a2a631f699');
</script>

</body>
</html>
