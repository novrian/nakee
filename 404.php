<?php get_template_part('templates/breadcrumbs'); ?>

<figure class="error404-img">
    <img src="<?php echo home_url() . '/assets/img/404.png' ?>" alt="404 Not Found" title="404 Not Found" >
</figure>

<div class="error404-info">
    <h1>Ooops! Not Found</h1>
    <p><?php _e('It looks like this was the result of either:', 'roots'); ?></p>
    <ul class="circle">
      <li><?php _e('a mistyped address', 'roots'); ?></li>
      <li><?php _e('an out-of-date link', 'roots'); ?></li>
    </ul>
    <?php get_search_form(); ?>
</div>
