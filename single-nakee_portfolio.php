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
            <h1 class="entry-title"><?php echo nakee_get_title(); ?></h1>
            <div class="entry-meta hide-text"><time datetime="<?php echo get_the_date("Y-m-d"); ?>" pubdate><?php echo get_the_date(); ?></time></div>
            <figure class="portfolio-presentation">
                <?php $thumbnail_full = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
                <a href="<?php echo $thumbnail_full[0]; ?>" title="Portfolio: <?php echo get_the_title(); ?>"><?php the_post_thumbnail('portfolio-large'); ?></a>
                <figcaption><?php the_title(); ?></figcaption>
            </figure>
        </header>

        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <footer>

            <div class="row-fluid">
                <?php $categories = get_the_terms(get_the_ID(), 'nakee_portfolio_category'); ?>
                <?php if ($categories && !is_wp_error($categories)) : ?>
                <div class="span6">
                    <section class="entry-category">
                        <h3><?php echo __('Categories', 'roots'); ?></h3>
                        <div>
                            <ul>
                            <?php foreach($categories as $key => $cat) : ?>
                                <li><?php printf("<a href=\"%s\" rel=\"tag\">%s</a>", get_term_link($cat), $cat->name); ?></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </section>
                </div>
                <?php endif; ?>

                <?php $technologies = get_the_terms(get_the_ID(), 'nakee_technology'); ?>
                <?php if ($technologies && !is_wp_error($technologies)) : ?>
                <div class="span6">
                    <section class="tag">
                        <h3><?php echo __('Technologies', 'roots'); ?></h3>
                        <div>
                            <ul>
                                <?php foreach($technologies as $key => $tech) : ?>
                                <li><?php printf("<a href=\"%s\" rel=\"tag\">%s</a>", get_term_link($tech), $tech->name); ?></li>
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
