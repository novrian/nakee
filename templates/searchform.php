<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">
    <label class="hide" for="s"><?php _e('Search for:', 'roots'); ?></label>
    <input type="text" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" id="s" class="search-query input-block-level" placeholder="<?php _e('Search . . .', 'roots'); ?>">
</form>
