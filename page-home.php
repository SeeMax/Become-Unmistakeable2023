<?php /* Template Name: Home */ get_header(); ?>
<main class="home-page">
	<?php while (have_posts()) : the_post(); ?>
	<div class="content">
		<hr>
		<p>
			Delete This File: page-home.php eventually<br>
			It is to test general styling and does not need to exist after the site is styled and built up.<br>
			It will over ride the basic tempate on the home page otherwise.
		</p>
		<hr>
		<br>
		<?php the_content();?>
		<h1>Headline One Test</h1>
		<h2>Headline Two Test</h2>
		<h3>Headline Three Test</h3>
		<h4>Headline Four Test</h4>
		<h5>Headline Five Test</h5>
		<p>
			Paragraph of Copy Test with a <a href="https://www.google.com" target="_blank">Link Test</a> inside.
		</p>
		<ul>
			<li>Test Un-List Item One</li>
			<li>Test Un-List Item Two</li>
			<li>Test Un-List Item Three</li>
		</ul>
		<ol>
			<li>Test Or-List Item One</li>
			<li>Test Or-List Item Two</li>
			<li>Test Or-List Item Three</li>
		</ol>
		<div class="seemax-button">
			<a class="c-block-fill" href="https://www.google.com"></a>
			<span>Test Button</span>
		</div>
	</div>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>