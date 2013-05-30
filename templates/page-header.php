<div class="page-header">
    <h1>
        <?php echo nakee_title(); ?>
    </h1>
</div>

<?php if (is_category() || is_tag()) : ?>

    <?php
    $term = get_queried_object();
    $display = (empty($term->description)) ? false : true;
    $tax = (is_category()) ? __('Category', 'roots') : __('Tag', 'roots');
    ?>

    <?php if ($display) : ?>
<p class="nakee-term-desc lead"><?php echo $term->description; ?></p>
    <?php else : ?>
<p class="nakee-term-desc lead"><?php printf(__('Berikut adalah daftar jurnal yang termasuk dalam %s <strong>%s</strong>', 'roots'), $tax, $term->name); ?></p>
    <?php endif; ?>

<?php elseif(is_search()) : ?>

<p class="nakee-term-desc lead"><?php printf(__('Berikut adalah hasil pencarian Jurnal dengan menggunakan query <em>%s</em>', 'roots'), get_search_query()); ?></p>

<?php endif; ?>
