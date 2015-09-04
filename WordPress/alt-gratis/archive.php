<?php get_header(); ?>
<?php 
$is_readerlite = false;
$root_cat = "Reader";
$category = get_category( get_query_var( 'cat' ) );
$cat_id = $category->cat_ID;
if (cat_is_ancestor_of(get_cat_id($root_cat), get_query_var('cat')) || is_category($root_cat) && defined ('READER_C_PATH')){
	$is_readerlite = true;
}
if (defined('CONFERENCER_PATH')){
	wp_enqueue_style('conferencer');
	wp_enqueue_script('conferencer');	
}
?>
<?php get_header(); ?>
<?php if (!($is_readerlite)): ?>
<?php echo (do_shortcode('[alt_slider category__in='.$cat_id.']')); ?>
<div id="column">
	<?php get_template_part('loop'); ?>
</div>
<?php get_template_part('pagination'); ?>
<?php elseif (have_posts()): ?>
<?php 
if ( !is_user_logged_in() ) { 
	$log_reminder = '<strong>Note: Login to mark items as read, favourite and like posts</strong>';
	$blog_reminder = 'login and register it in your profile';
} else {
	$blog_reminder = '<a href="'.bp_core_get_user_domain(bp_loggedin_user_id()).'profile/edit/group/2/"><strong>register it in your profile</strong></a>';
}
?>
<div style="text-align:right"><a href="feed/" title="RSS Feed">RSS <i class="fa fa-rss"></i></a></div>
<h2>Reader</h2>
<p><small>The Reader is searching and displaying content related to #altc. If you have a blog <?php echo $blog_reminder; ?> and include the text #altc in the title or post content for it to appear in the Reader. <?php echo $log_reminder; ?></small></p>
<div id="accordionLoader" class="inifiniteLoader">Loading... </div>
<div id="accordion" style="display:none">
<?php require_once(sprintf("%s/templates/content-item.php", READER_C_PATH)); ?>
</div>
<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>