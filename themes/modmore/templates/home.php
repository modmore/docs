<?php $this->layout('theme::layout/05_page') ?>

<h1 class="Page__Header"><?= $page['breadcrumbs'] ? $this->get_breadcrumb_title($page, $base_page) : $page['title'] ?></h1>

<div class="s-content">
    <?= $page['content']; ?>
</div>
