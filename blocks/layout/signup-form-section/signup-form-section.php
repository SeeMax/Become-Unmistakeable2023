<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'signup-form-section-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'signup-form-section animatedSection';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>
<?php
  $headline = get_field('headline');
  $embed = get_field('short_code');
  $color = get_field('form_color');
  $anchor = get_field('form_anchor');

?>
<div id="<?php echo $anchor;?>"></div>
<section id="<?php echo esc_attr($id);?>"
  class="<?php echo esc_attr($className);?> <?php echo $color;?>-signup-form-section">

  <div class="content">
    <?php if($headline):?>
    <h2><?php echo $headline;?></h2>
    <?php endif;?>
    <div class="signup-embed-code">
      <?php echo do_shortcode($embed);?>
    </div>
  </div>
</section>