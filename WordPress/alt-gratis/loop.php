<div class="posts">
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  itemscope itemtype="schema.org/BlogPosting">
    <?php $img = get_the_post_thumbnail(get_the_ID(), 'post-thumbnails', array('itemprop' => 'image')); ?>
        <!-- post thumbnail -->
		<?php if (!empty($img)) : // Check if thumbnail exists ?>
        <div class="image">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_post_thumbnail('post-thumbnails', array('itemprop' => 'image')); // Declare pixel size you need inside the array ?>
            </a>
            <?php get_template_part( 'post', 'date' ); ?>
        </div>
        <!-- /post thumbnail -->
        <?php else: ?>
            <?php get_template_part( 'post', 'date' ); ?>
        <?php endif; ?>
    
		<!-- post title -->
		<h2  itemprop="headline">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h2>
		<!-- /post title -->
        <div class="category"><?php the_category(' '); ?></div>
		<?php if (!empty($img)) : ?>
			<?php altgratis_excerpt('altgratis_index', 'altgratis_view_more'); // Build your custom callback length in functions.php ?>
        <?php else: ?>
        	<?php altgratis_excerpt('altgratis_custom_post', 'altgratis_view_more'); // Build your custom callback length in functions.php ?>
        <?php endif; ?>
        
        <?php edit_post_link(__('Edit', 'altgratis')); ?>
		<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave a comment', 'altgratis' ), __( '1 Comment', 'altgratis' ), __( '% Comments', 'altgratis' )); ?></span> 
		

	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h3><?php _e( 'Sorry, nothing to display.', 'altgratis' ); ?></h3>
	</article>
	<!-- /article -->

<?php endif; ?>
</div>