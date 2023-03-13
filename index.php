<?php get_header(); ?>
	<main class="default-page no-flex">
		<?php while (have_posts()) : the_post(); ?>
			<h1><?php the_title();?></h1>
		  <?php while ( have_rows('hero_section') ) : the_row();?>
		    <?php $backgroundImage = get_sub_field('image');?>
		    <section class="hero-section background-image-section"
					style="background: url('<?php echo $backgroundImage[url];?>')">
	        <div class="content">
	          <h1><?php the_title();?></h1>
	        </div>
		    </section>
		  <?php endwhile;?>
	    <section class="default-section">
        <div class="content">
					<?php the_content(); ?>
        </div>
	    </section>
		<?php endwhile; ?>
	</main>
<?php get_footer(); ?>
