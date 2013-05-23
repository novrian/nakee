<?php if (is_active_sidebar('sticky-sidebar')) : ?>
<div class="sticky-sidebar-container">
    <?php dynamic_sidebar('sticky-sidebar'); ?>
</div>
<?php endif; ?>

<?php if (is_active_sidebar('sidebar-primary')) : ?>
    <?php dynamic_sidebar('sidebar-primary'); ?>
<?php endif; ?>
