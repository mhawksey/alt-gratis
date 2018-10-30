<?php get_header(); ?>

	<main role="main">
	<!-- section -->
	<section>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
            	<?php $featured_img = get_post(get_post_thumbnail_id()); 
				$featured_title = $featured_img->post_excerpt; 
				?>
            	<div class="post_thumb">
                    <?php the_post_thumbnail('single-post-thumbnail'); // Fullsize image for the single post ?>
                    <?php if ($featured_title) : ?>
                    	<div class="caption"><?php echo $featured_title; ?></div>
                    <?php endif; ?>
                </div>
			<?php endif; ?>
			<!-- /post thumbnail -->

			<!-- post title -->
			<h1>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h1>
			<!-- /post title -->

			<!-- post details -->
			<div class="category"><?php the_category(' '); ?></div>
            
            <div itemprop="author" content="<?php get_author_posts_url( get_the_author_meta( 'ID' ) )?>"><?php _e( 'Edited by', 'altgratis' ); ?> <?php the_author_posts_link(); ?></div>
            
            <div itemprop="datePublished" content="<?php echo get_the_date('c'); ?>"><span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span></div>
            
            <div class="tags"><?php the_tags( __( 'Tags:<ul class="tags"><li>', 'altgratis' ), '</li><li>', '</li></ul>'); // Separated by commas with a line break at the end ?></div>	
            
			<!-- /post details -->

			<?php the_content(); // Dynamic Content ?>
            
            <div class="post-edit"><?php edit_post_link(__('Edit', 'altgratis')); // Always handy to have Edit Post Links available ?></div>


			<!-- <p><?php _e( 'Categorised in: ', 'altgratis' ); the_category(', '); // Separated by commas ?></p> -->

			<!-- <p><?php _e( 'This post was written by ', 'altgratis' ); the_author(); ?></p> -->


			<?php comments_template(); ?>

		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'altgratis' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
