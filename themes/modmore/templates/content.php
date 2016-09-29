<?php $this->layout('theme::layout/05_page') ?>

<h1 class="Page__Header"><?= $page['breadcrumbs'] ? $this->get_breadcrumb_title($page, $base_page) : $page['title'] ?></h1>

<div class="s-content">
    <?= $page['content']; ?>
</div>

<?php if (!empty($page['prev']) || !empty($page['next'])) {
?>
<nav>
    <ul class="Pager">
        <?php if (!empty($page['prev'])) {
    ?><li class=Pager--prev><a href="<?= $base_url . $page['prev']->getUrl() ?>">&laquo; <?= $page['prev']->getTitle() ?></a></li><?php

} ?>
        <?php if (!empty($page['next'])) {
    ?><li class=Pager--next><a href="<?= $base_url . $page['next']->getUrl() ?>"><?= $page['next']->getTitle() ?> &raquo;</a></li><?php

} ?>
    </ul>
</nav>
<?php

} ?>


<p><small>Found a typo, is a description unclear or missing completely?
        <a href="https://github.com/modmore/docs/edit/master/<?= $page['relative_path'] ?>" target="_blank">Edit this page</a>
        or
        <a href="https://github.com/modmore/docs/issues/new?title=<?= urlencode($page['title']) ?>&body=On+page+[<?= urlencode($page['title']) ?>](https://github.com/modmore/docs/blob/master/<?= $page['relative_path'] ?>)+there+is+an+issue+with+..." target="_blank">report an issue</a>. Thank you!
    </small></p>
