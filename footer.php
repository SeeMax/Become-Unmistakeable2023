<footer class="footer">
	<div class="content">

		<div class="footer-tile logo-tile">
			<div class="footer-logo-container">
				<a class="c-block-fill" href="/"></a>
				<img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo-w.svg">
			</div>
			<div class="footer-social-container">
				<?php if( have_rows('social_info', 'options') ): ?>
				<?php while( have_rows('social_info', 'options') ): the_row(); 
					$fb = get_sub_field('facebook');
					$tw = get_sub_field('twitter');
					$in = get_sub_field('linkedin');
					$ig = get_sub_field('instagram');
				?>
				<?php if($fb):?>
				<a class="social-line" href="<?php echo $fb;?>" target="_blank">
					<i class="fab fa-facebook"></i>
				</a>
				<?php endif;?>
				<?php if($tw):?>
				<a class="social-line" href="<?php echo $tw;?>" target="_blank">
					<i class="fab fa-twitter"></i>
				</a>
				<?php if($in):?>
				<a class="social-line" href="<?php echo $in;?>" target="_blank">
					<i class="fab fa-linkedin"></i>
				</a>
				<?php endif;?>
				<?php endif;?>
				<?php if($ig):?>
				<a class="social-line" href="<?php echo $ig;?>" target="_blank">
					<i class="fab fa-instagram"></i>
				</a>
				<?php endif;?>
				<?php endwhile;?>
				<?php endif;?>
			</div>
		</div>

		<div class="footer-tile footer-nav-tile">
			<?php footer_theme_nav(); ?>
		</div>



	</div>
	<div class="copyright">
		&copy; <?php echo date("Y"); ?> <?php echo get_bloginfo();?>
	</div>
</footer>
<?php wp_footer(); ?>
</div><!-- WRAPPER -->
</body>

</html>