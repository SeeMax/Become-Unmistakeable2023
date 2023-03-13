<?php get_header(); ?>
	<main class="single-post-page default-page">
		<?php while (have_posts()) : the_post(); ?>
	    <section class="single-post-section no-flex">
				<div class="single-post-hero-image background-image-section"
					style="background-image:url(
					<?php if ( get_the_post_thumbnail() != '' ):?>
						<?php the_post_thumbnail_url();?>
					<?php else:?>
						<?php echo catch_that_image();?>
					<?php endif;?>
					);"
				></div>
				<div class="content">
					<div class="single-post-header">
						<div class="single-post-categories-pre-header">
							<?php foreach((get_the_category()) as $category):?>
								<h6 class="single-category-wrapper">
    							<?php echo $category->cat_name . '';?>
									<a class="c-block-fill" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"></a>
								</h6>
							<?php endforeach;?>
						</div>
						<h6><?php the_date();?></h6>
						<h1><?php the_title();?></h1>
						<h6>by <?php the_author();?></h6>
					</div>
					<hr>
					<div class="single-post-body">
						<?php the_content(); ?>
					</div>
        </div>
	    </section>
		<?php endwhile; ?>
		<?php 
			$post_id = get_the_ID();
			$categories = get_the_category( $post_id );
			$query_args = array( 
				'category_name'   => $categories[0]->cat_name,
				'post__not_in'    => array($post_id),
				'posts_per_page'  => '3',
				'ignore_sticky_posts' => true,
			);
			$query2_args = array( 
				'post__not_in'    => array($post_id),
				'posts_per_page'  => '3',
				'ignore_sticky_posts' => true,
			);
			$related_cats_post = new WP_Query( $query_args );
			$general_post = new WP_Query( $query2_args );
		?>
		<?php if($related_cats_post->have_posts()):?>
			<section class="single-post-related-posts-section">
				<div class="content">
					<h2>Related Posts</h2>
					<div class="single-posts-preview-area">
						<?php while($related_cats_post->have_posts()): $related_cats_post->the_post(); ?>
							<?php get_template_part( 'partials/_single-post-preview' ); ?>
						<?php endwhile;?>
						<?php wp_reset_postdata();?>				
					</div>
				</div>
			</section>
		<?php else:?>
			<section class="single-post-related-posts-section">
				<div class="content">
					<h2>Related Posts</h2>
					<div class="single-posts-preview-area">
						<?php while($general_post->have_posts()): $general_post->the_post(); ?>
							<?php get_template_part( 'partials/_single-post-preview' ); ?>
						<?php endwhile;?>
						<?php wp_reset_postdata();?>				
					</div>
				</div>
			</section>
		<?php endif;?>
	</main>
<?php get_footer(); ?>
