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
    <meta name="description" content="The official documentation for modmore extras." />
    <meta name="author" content="The modmore team &amp; contributors">
    <meta charset="UTF-8">
    <link rel="icon" href="https://assets.modmore.com/icon_180x180.png" type="image/x-icon">
    <!-- Mobile -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font -->
    <?php foreach ($params['theme']['fonts'] as $font) {
        echo "<link href='$font' rel='stylesheet' type='text/css'>";
    } ?>

    <!-- CSS -->
    <?php foreach ($params['theme']['css'] as $css) {
        echo "<link href='$css' rel='stylesheet' type='text/css'>";
    } ?>

    <?php /*if ($params['html']['search']) {
        ?>
        <!-- Tipue Search -->
        <link href="<?= $base_url; ?>tipuesearch/tipuesearch.css" rel="stylesheet">
        <?php

    } */ ?>
</head>
<body class="<?= $params['html']['float'] ? 'with-float' : ''; ?>">
<?= $this->section('content'); ?>

<!--
<script defer src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
    onContentLoaded(function() {
        if (!window.jQuery) {
            loadJS('/assets/templates/docs/src/bower_components/jquery/dist/jquery.min.js', false, function () {
                loadJS('/assets/templates/docs/dist/main.js', true);
            });
        } else {
            loadJS('/assets/templates/docs/dist/main.js', true);
        }

        // load image related scripts async
        loadJS('/assets/templates/docs/dist/images.js', function(){
            window.lazySizes.init();
        });
    });
</script>
-->

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
<?php foreach ($params['theme']['js'] as $js) {
    echo '<script src="' . $js . '"></script>';
} ?>

<script src="<?= $base_url; ?>themes/modmore/js/daux.js"></script>

<?php if ($params['html']['search']) {
    ?>
    <!-- Tipue Search -->
    <script type="text/javascript" src="<?php echo $base_url; ?>themes/modmore/js/tipuesearch.js"></script>

    <script>
        window.onunload = function(){}; // force $(document).ready to be called on back/forward navigation in firefox
        $(function() {
            tipuesearch({
                'base_url': '<?php echo $base_url?>'
            });
        });
    </script>
    <?php

} ?>

<!-- Hotjar Tracking Code for https://docs.modmore.com -->
<script>
    if (window.location.host === 'docs.modmore.com') {
        (function (h, o, t, j, a, r) {
            h.hj = h.hj || function () {
                    (h.hj.q = h.hj.q || []).push(arguments)
                };
            h._hjSettings = {hjid: 340033, hjsv: 5};
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, '//static.hotjar.com/c/hotjar-', '.js?sv=');
    }
</script>

</body>
</html>
