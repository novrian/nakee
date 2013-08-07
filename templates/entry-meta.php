<?php if (is_single()) : ?>

<div class="entry-meta">
    <time class="updated" datetime="<?php echo get_the_time('c'); ?>" pubdate><?php echo get_the_date(); ?></time>
    <p class="hide-text byline author vcard"><?php echo __('By', 'roots'); ?> <?php echo get_the_author(); ?></a></p>
</div>

<?php else : ?>

<div class="entry-meta span4">
    <time class="updated" datetime="<?php echo get_the_time('c'); ?>" pubdate><?php echo get_the_date(); ?></time>
    <figure class="nakee-post-thumbnails">
        <a href="<?php the_permalink(); ?>" title="<?php echo nakee_get_title(); ?>"><?php echo (has_post_thumbnail()) ? get_the_post_thumbnail(get_the_ID(), 'post-small') : wp_get_attachment_image($GLOBALS['nakee']['def-featured-img'][rand(0, 3)], 'post-small'); ?></a>
    </figure>

    <?php $categories = get_the_category(); ?>
    <?php if ($categories) : ?>
    <section id="<?php echo 'category-' . get_the_ID(); ?>" class="nakee-secondary-tag-meta">
        <strong><?php _e('Categories', 'roots'); ?></strong>
        <div class="nakee-swidget-container">
            <ul class="inline">
                <?php foreach($categories as $category) : ?>
                <li><a href="<?php echo get_category_link($category->cat_ID) ?>" rel="tag"><?php echo $category->name; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <?php endif; ?>

    <?php $tags = get_the_tags(); ?>
    <?php if ($tags) : ?>
    <section id="<?php echo 'tag-' . get_the_ID(); ?>" class="nakee-secondary-tag-meta">
        <strong><?php _e('Tags', 'roots'); ?></strong>
        <div class="nakee-swidget-container">
            <ul class="inline">
                <?php foreach($tags as $id => $tag) : ?>
                <li><a href="<?php echo get_tag_link($id); ?>" rel="tag"><?php echo $tag->name; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <?php endif; ?>

    <p class="hide-text byline author vcard"><?php echo __('By', 'roots'); ?> <?php echo get_the_author(); ?></a></p>
</div>

<?php endif; ?>
