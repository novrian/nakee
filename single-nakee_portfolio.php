<?php
/**
 * Portfolio Single Template
 *
 * @author Novrian Y.F. <me@novrian.info>
 * @copyright (c) 2013, Novrian Y.F.
 * @license http://www.gnu.org/licenses/gpl.html GNU/GPL License
 */

// Get Breadcrumbs
get_template_part('templates/breadcrumbs');
?>

<?php while (have_posts()) : the_post(); ?>

    <article <?php post_class(); ?>>

        <header>
            <figure id="<?php the_ID(); ?>-portfolio" class="nakee-portfolio-figure large-figure">
                <?php /** if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" title="<?php echo nakee_get_title(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'portfolio-large', array(
                    'class' => 'img-polaroid nakee-portfolio-popup',
                    'alt' => 'Portfolio : ' . get_the_title(),
                    'title' => 'Portfolio : ' . get_the_title()
                )); ?></a>
                <?php else : ?>
                <img class="img-polaroid nakee-portfolio-popup" src="<?php echo WP_BASE . '/' . THEME_PATH . '/no-portfolio-1200x619.png' ?>" alt="<?php echo nakee_get_title(); ?>" title="<?php echo nakee_get_title(); ?>" /></a>
                <?php endif; */ ?>
                <?php
                $src = WP_BASE . '/' . THEME_PATH . '/no-portfolio-1200x619.png';
                if (has_post_thumbnail()) {
                    $src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio-large' );
                    $src = $src[0];
                }
                ?>
                <a href="<?php echo $src; ?>" title="Portfolio: <?php the_title(); ?>" class="nakee-portfolio-popup">
                    <img class="img-polaroid" src="<?php echo $src; ?>" alt="Portfolio: <?php the_title(); ?>" title="Portfolio: <?php the_title(); ?>">
                </a>
            </figure>
            <h1 class="entry-title"><?php echo nakee_get_title(); ?></h1>
            <div class="entry-meta hide-text"><time datetime="<?php echo get_the_date("Y-m-d"); ?>" pubdate><?php echo get_the_date(); ?></time></div>
        </header>

        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <footer>

            <div class="row-fluid">
                <?php $categories = get_the_terms(get_the_ID(), 'nakee_portfolio_category'); ?>
                <?php if ($categories && !is_wp_error($categories)) : ?>
                <div class="span6">
                    <section class="portfolio-category-widget">
                        <h3><?php echo __('Categories', 'roots'); ?></h3>
                        <div class="single-widget-inner">
                            <ul class="inline">
                            <?php foreach($categories as $key => $cat) : ?>
                                <li><?php printf(__("<a href=\"%s\" rel=\"tag tooltip\" title=\"View work on %s\">%s</a>", 'roots'), get_term_link($cat), $cat->name, $cat->name); ?></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </section>
                </div>
                <?php endif; ?>

                <?php $technologies = get_the_terms(get_the_ID(), 'nakee_technology'); ?>
                <?php if ($technologies && !is_wp_error($technologies)) : ?>
                <div class="span6">
                    <section class="portfolio-technology-widget">
                        <h3><?php echo __('Technologies', 'roots'); ?></h3>
                        <div class="single-widget-inner">
                            <ul class="inline">
                                <?php foreach($technologies as $key => $tech) : ?>
                                <li><?php printf( __("<a href=\"%s\" rel=\"tag tooltip\" title=\"View work base on %s technology\">%s</a>", 'roots'), get_term_link($tech), $tech->name, $tech->name); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </section>
                </div>
                <?php endif; ?>

            </div>

        </footer>

    </article>

    <nav class="post-nav">
        <ul class="pager">
            <li class="previous"><?php previous_post_link('%link', '&larr; %title'); ?></li>
            <li class="next"><?php next_post_link('%link', '%title &rarr;'); ?></li>
        </ul>
    </nav>

<?php endwhile; ?>
