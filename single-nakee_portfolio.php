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
                <?php
                $src['thumb'] = home_url() . '/assets/img/no-portfolio-1200x619.png';
                $src['full'] = $src['thumb'];
                if (has_post_thumbnail()) {
                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio-large' );
                    $src['thumb'] = $thumb[0];
                    $full = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
                    $src['full'] = $full[0];
                }
                ?>
                <a href="<?php echo $src['full']; ?>" title="Portfolio: <?php the_title(); ?>" class="nakee-portfolio-popup">
                    <img class="img-polaroid" src="<?php echo $src['thumb']; ?>" alt="Portfolio: <?php the_title(); ?>" title="Portfolio: <?php the_title(); ?>">
                </a>
            </figure>
            <h1 class="entry-title"><?php echo nakee_get_title(); ?></h1>
            <div class="entry-meta hide-text"><time datetime="<?php echo get_the_date("Y-m-d"); ?>" pubdate><?php echo get_the_date(); ?></time></div>
        </header>

        <div class="entry-content">
            <?php the_content(); ?>
            <div class="clearfix"></div>
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
