<?php get_header(); ?>
<main class="single-company-page">
  <?php while (have_posts()) : the_post(); ?>

  <?php $logo = get_field( 'logo', $featured_post->ID );?>

  <?php if( have_rows('case_study_content') ):
    while( have_rows('case_study_content') ): the_row(); 

      if( have_rows('intro_section') ):
        while( have_rows('intro_section') ): the_row(); 
        $headline = get_sub_field( 'headline' );
        $bodyText = get_sub_field( 'body' );
        endwhile;
      endif;

      if( have_rows('problem__opportunity') ):
        while( have_rows('problem__opportunity') ): the_row(); 
        $prob = get_sub_field( 'problem' );
        $opp = get_sub_field( 'opportunity' );
        endwhile;
      endif;

      
$solver = get_sub_field( 'problem_solver_2');

      if( have_rows('the_results') ):
        while( have_rows('the_results') ): the_row(); 
        $result = get_sub_field( 'single_result' );
        endwhile;
      endif;

      if( have_rows('the_feedback') ):
        while( have_rows('the_feedback') ): the_row(); 
        $feedback = get_sub_field( 'single_feedback' );
        endwhile;
      endif;

                  
    endwhile;
  endif; ?>
  <section class="single-co-hero animatedSection">
    <div class="content">

      <h5>Case Study</h5>
      <h1><?php echo $headline;?></h1>
      <h6><?php echo $bodyText;?></h6>
    </div>
  </section>
  <section class="single-co-prob-opp darkgray-background animatedSection">
    <div class="content">
      <div class="prob-opp-text-half c-width-50">
        <div class="prob-opp-group">
          <h5>The Client</h5>
          <h6><?php the_title();?></h6>
        </div>
        <div class=" prob-opp-group">
          <h5>The Problem</h5>
          <h6><?php echo $prob;?></h6>
        </div>
        <div class="prob-opp-group">
          <h5>The Opportunity</h5>
          <h6><?php echo $opp;?></h6>
        </div>
      </div>
      <div class="prob-opp-image-half  c-width-50">
        <svg id="client-logo-portal" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 513.34">
          <g class="circleSpinner">
            <ellipse id="circle-bottom" class="logo-portal-2" cx="263.46" cy="297.73" rx="216.54" ry="215.61" />
            <ellipse id="circle-top" cx="240" cy="215.61" rx="216.54" ry="215.61" />
            <ellipse id="circle-center" class="logo-portal-1" cx="216.54" cy="273.39" rx="216.54" ry="215.61" />
          </g>
          <g class="iconSpinner">
            <image width="250" x="95" height="200" y="176.5" xlink:href="<?php echo $logo['url'];?>" />
          </g>
        </svg>

      </div>
    </div>
  </section>
  <section class="single-co-solver animatedSection">
    <div class="content">
      <h5>The Problem Solver</h5>
      <div class="solver-images-box">
        <?php if( $solver ): ?>
        <?php foreach( $solver as $solve ): ?>
        <?php if ($solve == 'umap'):?>
        <img src="<?php echo get_template_directory_uri(); ?>/dist/images/umap-logo.svg" alt="uMapLogo">
        <?php endif;?>
        <?php if ($solve == 'ulead'):?>
        <img class="ulead-img" src="<?php echo get_template_directory_uri(); ?>/dist/images/ulead-logo.svg"
          alt="uLeadLogo">
        <?php endif;?>
        <?php endforeach; ?>
        <?php endif;?>
      </div>

    </div>
  </section>


  <?php if( have_rows('case_study_content') ): while( have_rows('case_study_content') ): the_row();?>
  <?php if( have_rows('the_results') ):?>
  <section class="single-co-results darkgray-background animatedSection">
    <div class="content">
      <h5>The Results</h5>
      <div class="results-area">
        <?php while( have_rows('the_results') ): the_row();?>
        <?php $result = get_sub_field( 'single_result' );?>
        <div class="single-result c-width-33-3">
          <h4><?php echo $result;?></h4>
          <div class="animatedLineCover"></div>
        </div>
        <?php endwhile;?>
      </div>
    </div>
  </section>
  <?php endif;?>
  <?php if( have_rows('the_feedback') ):?>
  <section class="single-co-feedback offwhite-background animatedSection">
    <div class="content">
      <h5>The Feedback</h5>
      <div class="feedback-area">
        <?php while( have_rows('the_feedback') ): the_row();?>

        <?php $feedback = get_sub_field( 'single_result' );?>
        <div class="single-feedback c-width-33-3">
          <p><?php echo $feedback;?></p>
        </div>
        <?php endwhile;?>
      </div>
    </div>
  </section>
  <?php endif;?>
  <?php endwhile;endif;?>


  <?php endwhile; ?>
</main>
<?php get_footer(); ?>