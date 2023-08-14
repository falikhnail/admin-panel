<aside class="sidebar sidebar-dark sidebar-fixed bg-gradient-sidebar" id="sidebar">
    <?php
    $isReport = strpos(url()->current(), 'report') !== false;
    ?>
    {!! $backend_sidebar->asUl(
        ['class' => 'sidebar-nav', 'id' => 'sidebar-nav'],
        ['class' => 'nav-content ' . ($isReport ? '' : 'collapse'), 'id' => 'report-nav'],
    ) !!}
</aside>
