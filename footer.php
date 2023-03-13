<footer class="footer">
	<div class="content">

		<div class="footer-tile logo-tile">
			<div class="footer-logo-container">
				<a class="c-block-fill" href="/"></a>
				<img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo-w.svg">
			</div>
		</div>
		
		<div class="footer-tile footer-nav-tile">
			<?php footer_theme_nav(); ?>
		</div>
		
		<div class="footer-tile social-tile">
			<?php if( have_rows('social_info', 'options') ): ?>
				<?php while( have_rows('social_info', 'options') ): the_row(); 
					$fb = get_sub_field('facebook');
					$tw = get_sub_field('twitter');
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
					<?php endif;?>
					<?php if($ig):?>
						<a class="social-line" href="<?php echo $ig;?>" target="_blank">
							<i class="fab fa-instagram"></i>
						</a>
					<?php endif;?>
				<?php endwhile;?>
			<?php endif;?>
		</div>

		<div class="footer-tile contact-tile">
			<?php if( have_rows('contact_info', 'options') ): ?>
				<?php while( have_rows('contact_info', 'options') ): the_row(); 
					$addy = get_sub_field('address');
					$phone = get_sub_field('phone_number');
					$email = get_sub_field('contact_email');
				?>
					<?php if($addy):?>
						<div class="contact-line">
							<?php echo $addy;?>
						</div>
					<?php endif;?>
					<?php if($phone):?>
						<a class="contact-line" href="tel:<?php echo $phone;?>">
							<?php echo $phone;?>
						</a>
					<?php endif;?>
					<?php if($email):?>
						<a class="contact-line" href="mailto:<?php echo $email;?>" target="_blank">
							<?php echo $email;?>
						</a>
					<?php endif;?>
				<?php endwhile;?>
			<?php endif;?>
		</div>
	
		<div class="footer-tile subscribe-tile">
			<div class="mailchimp-wrapper" id="mc_embed_signup">	
				<?php the_field('mailchimp_form', 'options');?>
			</div>
		</div>
		
	</div>
	<div class="copyright">
		&copy; Copyright <?php echo date("Y"); ?> <?php echo get_bloginfo();?>
	</div>
</footer>
<?php wp_footer(); ?>
</div><!-- WRAPPER -->
</body>
</html>