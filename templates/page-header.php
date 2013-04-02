<div class="page-header">
    <h1>
        <?php echo nakee_title(); ?>
    </h1>
</div>

<?php if (is_category() || is_tag()) : ?>

    <?php
    $term = get_queried_object();
    $display = (empty($term->description)) ? false : true;
    ?>

    <?php if ($display) : ?>
<p class="nakee-term-desc lead"><?php echo $term->description; ?></p>
    <?php endif; ?>

<?php endif; ?>
