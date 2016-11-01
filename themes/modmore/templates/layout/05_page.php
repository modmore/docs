<?php $this->layout('theme::layout/00_layout') ?>


<a href="#sidebar" class="skiplink show-on-focus">Skip to sidebar navigation</a>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<?php if ($params['html']['repo']) {
    ?>
    <a href="https://github.com/<?= $params['html']['repo']; ?>" target="_blank" id="github-ribbon" class="Github hidden-print"><img src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a>
<?php

} ?>


<div class="pagewrapper">
    <div id="pagecontent" class="pagecontent">
        <header class="pageheader">
            <!-- JavaScript-only search...
                Pros:
                    - Instant result
                    - Offline
                    - Works with the static site generation
                Cons:
                    - Not accessible >:(
                    - Only searches docs, not other modmore content
                    - No tracking

                Use this temporarily, set up something like an elasticsearch server in the future that reads
                out the static content for accessible search capability that also searches site/forums etc.
                Perhaps keep this available one-way or another (check if offline?) for local copies.

                For no-js it falls back to a google search. Better than nothing.
            -->
            <form method="get" action="https://google.com/search" target="_modmoredocsgoogle" class="docsearch" id="search-form">
              <label for="tipue_search_input">Search documentation</label>
              <input type="search" id="tipue_search_input" name="q" placeholder="Search Documentation">
              <input type="hidden" name="as_sitesearch" value="docs.modmore.com">
              <button type="submit" class="button"><svg role="presentation"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $base_url; ?>themes/modmore/dist/sprite.svg#search" title="search"></use></svg></button>
            </form>
            <script>
                var searchInput = document.getElementById('tipue_search_input');
                searchInput.setAttribute('name','query');
                searchInput.parentNode.removeAttribute('action');
                searchInput.parentNode.removeAttribute('target');
                document.querySelector('input[name="as_sitesearch"]').remove();
            </script>
            <div class="headerlinks">
                <a href="https://support.modmore.com/">Contact Support</a>
            </div>
        </header>
        <main class="maincontent" role="main" itemprop="mainContentOfPage">
            <div class="row">
                <div class="column">
                    <div id="tipue_search_content"></div>

                    <?= $this->section('content'); ?>
                </div>
            </div>
        </main>
    </div>
    <aside id="sidebar" class="sidebar">
        <?php
            $rendertree = $tree['en'];
            $path = 'en';

            if ($page['language'] !== '') {
                $rendertree = $tree[$page['language']];
                $path = $page['language'];
            }
        ?>
        <p class="logo">
            <a href="<?php echo $base_url . $path; ?>/index.html" title="modmore documentation"><strong>modmore documentation</strong></a>
        </p>

        <nav class="pagenav">
            <?php
            echo $this->get_navigation($rendertree, $path, isset($params['request']) ? $params['request'] : '', $base_page, $params['mode']);
            ?>

        </nav>
    </aside>
</div>

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

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -/->
<script>
    window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
    ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>-->