<footer class="content-info" role="contentinfo">
    
    <?php if (is_nakee_element()) : ?>
    
        <?php if (is_active_sidebar('frontpage-footer')) : ?>
    <div id="main-footer-widget">
        <div class="container">
            <div class="row-fluid">
                <?php dynamic_sidebar('frontpage-footer'); ?>
            </div>
        </div>
    </div>
        <?php endif; ?>
    
    <div id="technology-widget">
        <div class="container">
            <?php echo display_technology(array(
                'html5' => 'HTML5',
                'css3' => 'CSS3',
                'jquery' => 'jQuery',
                'jquery-ui' => 'jQuery UI',
                'php' => 'PHP',
                'mysql' => 'MySQL',
                'git' => 'Git',
                'ps' => 'Adobe Photoshop',
                'ai' => 'Adobe Illustrator',
                'sass' => 'SASS',
                'compass' => 'Compass',
                'ruby' => 'Ruby',
                'cakephp' => 'cakePHP',
                'wordpress' => 'Wordpress'
            )); ?>
        </div>
    </div>
    
    <?php endif; ?>
    
    <div id="footer-text">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 footer-text">
                    <small><?php echo __('Copyright &copy; ' . date('Y') . ' <a href="' . home_url('/') . '" title="' . get_bloginfo('name') . ' - ' . get_bloginfo('description') . '">' . get_bloginfo('name') . '</a>.', 'roots'); ?> Hack Cipta dilindungi Undang-Undang ;)</small>
                </div>
                <div class="span6 social-footer">
                    <ul class="inline pull-right">
                        <li><a href="https://www.facebook.com/<?php echo FACEBOOK_USERNAME; ?>" class="url facebook" title="Like Me on Facebook"><span class="hide-text">Facebook</span></a></li>
                        <li><a href="https://www.twitter.com/<?php echo TWITTER_USERNAME; ?>" class="url twitter" title="Get the Boring Tweets"><span class="hide-text">Twitter</span></a></li>
                        <li><a href="https://www.github.com/<?php echo GITHUB_USERNAME; ?>" class="url github" title="Collaborate with me on Github"><span class="hide-text">Github</span></a></li>
                        <li><a href="<?php echo FEEDBURNER_URL; ?>" class="url rss" title="Feed my blog updates"><span class="hide-text">Atom Feed</span></a></li>
                        <li><a href="#top" class="to-top" title="Back to Top"><span class="hide-text">To Top</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</footer>

<?php wp_footer(); ?>

<?php
// GLOBAL DEBUGGING
if (WP_DEBUG) {
    echo '<pre>Loading Time: <code>' . xdebug_time_index() . '</code></pre>';
}
?>