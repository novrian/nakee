<section id="<?php echo 'social-share-' . get_the_ID(); ?>" class="single-social">
    <h3><?php echo __('Spread the Word', 'roots'); ?></h3>
    <div class="single-section-container">
        <div class="social-button-wrap facebook">
            <div class="fb-share-button" data-href="<?= get_permalink(); ?>" data-layout="button_count" data-size="large" data-mobile-iframe="true">
                <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(get_permalink()); ?>&amp;src=sdkpreparse">Share</a>
            </div>
        </div>
        <div class="social-button-wrap twitter">
        <a href="https://twitter.com/share" class="twitter-share-button" data-via="<?php echo TWITTER_USERNAME; ?>" data-related="<?php echo TWITTER_USERNAME; ?>" data-count="vertical" data-lang="id" data-size="large">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
        <div class="social-button-wrap gplus">
            <div class="g-plusone" data-size="tall"></div>
        </div>
    </div>
</section>
