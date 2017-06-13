<footer class="content-info" role="contentinfo">

    <?php if (is_nakee_element()) : ?>

    <div class="footer-triangle"></div>

        <?php if (is_active_sidebar('frontpage-footer')) : ?>
    <div id="main-footer-widget">
        <div class="container">
            <div class="row-fluid">
                <?php dynamic_sidebar('frontpage-footer'); ?>
            </div>
        </div>
    </div>
        <?php endif; ?>

    <div class="technology-widget-container visible-desktop">
        <div class="container">
            <?php echo display_technology(array(
                'php' => 'PHP',
                'yii' => 'Yii Framework',
                'mysql' => 'MySQL',
                'mariadb' => 'MariaDB',
                'git' => 'Git',
                'apache' => 'Apache',
                'nginx' => 'nginx',
                'debian' => 'Debian',
                'jquery' => 'jQuery',
                'gulp' => 'GulpJS',
                'sass' => 'SASS',
                'ruby' => 'Ruby',
            )); ?>
        </div>
    </div>

    <?php endif; ?>

    <div class="footer-top-border"></div>
    <div class="footer-text-container">
        <div class="container">
            <div class="row-fluid">
                <div class="span6 footer-text">
                    <small><?php echo __('Copyright &copy; ' . date('Y') . ' <a href="' . home_url('/') . '" title="' . get_bloginfo('name') . ' - ' . get_bloginfo('description') . '">' . get_bloginfo('name') . '</a>.', 'roots'); ?> Hosted by <a href="http://losarihost.com/" target="_blank">losarihost.com</a></small>
                </div>
                <div class="span6 social-footer">
                    <ul class="inline pull-right">
                        <li><a href="https://www.facebook.com/<?php echo FACEBOOK_USERNAME; ?>" class="url facebook" title="Like Me on Facebook"><i class="icon-facebook"></i><span class="hide-text">Facebook</span></a></li>
                        <li><a href="https://www.twitter.com/<?php echo TWITTER_USERNAME; ?>" class="url twitter" title="Get the Boring Tweets"><i class="icon-twitter"></i><span class="hide-text">Twitter</span></a></li>
                        <li><a href="https://www.github.com/<?php echo GITHUB_USERNAME; ?>" class="url github" title="Collaborate with me on Github"><i class="icon-github"></i><span class="hide-text">Github</span></a></li>
                        <li><a href="<?php echo FEEDBURNER_URL; ?>" class="url rss" title="Feed my blog updates"><i class="icon-rss"></i><span class="hide-text">Atom Feed</span></a></li>
                        <li><a href="#top" class="to-top" title="Back to Top"><i class="icon-chevron-up"></i><span class="hide-text">To Top</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</footer>

<!-- GPLUS SCRIPT -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<!-- GPLUS SCRIPT -->

<?php wp_footer(); ?>

<?php
// GLOBAL DEBUGGING
if (WP_DEBUG) {
    echo '<pre>Loading Time: <code>' . xdebug_time_index() . '</code></pre>';
}
?>
