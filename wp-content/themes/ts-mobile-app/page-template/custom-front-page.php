<?php
/**
 * Template Name: Custom home
 */
get_header(); ?>

<main role="main" id="maincontent">
  <?php do_action( 'bb_mobile_application_before_slider' ); ?>

  <?php if( get_theme_mod('bb_mobile_application_slider_hide_show', false) != '' || get_theme_mod('bb_mobile_application_responsive_slider', false) != ''){ ?> 
    <section id="slider">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-interval="<?php echo esc_attr(get_theme_mod('bb_mobile_application_slider_speed_option', 3000)); ?>"> 
        <?php $bb_mobile_application_slider_pages = array();
          for ( $count = 1; $count <= 4; $count++ ) {
            $mod = intval( get_theme_mod( 'bb_mobile_application_slider' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $bb_mobile_application_slider_pages[] = $mod;
            }
          }
          if( !empty($bb_mobile_application_slider_pages) ) :
          $args = array(
              'post_type' => 'page',
              'post__in' => $bb_mobile_application_slider_pages,
              'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
        ?>
        <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <?php the_post_thumbnail(); ?>
            <div class="carousel-caption">
              <div class="inner_carousel">
                <?php if( get_theme_mod('bb_mobile_application_slider_title_Show_hide',true) != ''){ ?>
                  <h1><?php the_title();?></h1>
                <?php } ?>
                <?php if( get_theme_mod('bb_mobile_application_slider_content_Show_hide',true) != ''){ ?>
                  <p><?php $excerpt = get_the_excerpt(); echo esc_html( bb_mobile_application_string_limit_words( $excerpt, esc_attr(get_theme_mod('bb_mobile_application_slider_excerpt_length','10')))); ?></p>
                <?php } ?>
              </div>
              <?php if( get_theme_mod('bb_mobile_application_slider_button','KNOW MORE') != ''){ ?>
                <div class="know-btn">
                  <a href="<?php the_permalink(); ?>" class="p-3"><?php echo esc_html(get_theme_mod('bb_mobile_application_slider_button','KNOW MORE'));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('bb_mobile_application_slider_button','KNOW MORE'));?></span></a>
                </div> 
              <?php } ?>
            </div>
          </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
        <?php endif;
        endif;?>
        <a class="carousel-control-prev" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev" role="button">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Previous','ts-mobile-app' );?></span>
        </a>
        <a class="carousel-control-next" data-bs-target="#carouselExampleCaptions" data-bs-slide="next" role="button">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Next','ts-mobile-app' );?></span>
        </a>
      </div>
      <div class="clearfix"></div>
    </section>
  <?php }?>

  <?php do_action( 'bb_mobile_application_after_slider' ); ?>

  <?php if( get_theme_mod('bb_mobile_application_title') != '' || get_theme_mod('bb_mobile_application_blogcategory_left_setting') != '' || get_theme_mod('bb_mobile_application_middle_image_setting') != '' || get_theme_mod('bb_mobile_application_blogcategory_right_setting') != ''){ ?>
      <?php /** post section **/ ?>
    <section class="creative-feature my-5">
      <div class="container">
        <?php if( get_theme_mod('bb_mobile_application_title') != ''){ ?>
          <div class="heading-line">
            <h2 class="text-center mb-5 mt-0"><?php echo esc_html(get_theme_mod('bb_mobile_application_title','')); ?> </h2>
          </div>
        <?php } ?>
        <div class="row m-0">
          <div class="col-lg-4 col-md-4 p-0">
            <div id="about" class="darkbox" >
              <?php 
               $bb_mobile_application_catData=  get_theme_mod('bb_mobile_application_blogcategory_left_setting');
               if($bb_mobile_application_catData){
                $page_query = new WP_Query(array( 'category_name' => esc_html($bb_mobile_application_catData,'ts-mobile-app')));?>
                  <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
                    <div class="left-part mb-4">
                      <div class="row m-0"> 
                        <div class="col-lg-4 col-md-4 p-0">
                          <div class="abt-img-box"><?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?> 
                          </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                          <h3 class="text-md-start text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a> </h3>  
                        </div>
                      </div>
                      <p class="pt-2 mb-0 text-md-start text-center"><?php $excerpt = get_the_excerpt(); echo esc_html( bb_mobile_application_string_limit_words( $excerpt,10 ) ); ?></p>    
                    </div>
                <?php endwhile;
              wp_reset_postdata();
              } ?>        
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="middle-image">
              <?php
                $args = array( 'name' => get_theme_mod('bb_mobile_application_middle_image_setting',''));
                $query = new WP_Query( $args );
                if ( $query->have_posts() ) :
                  while ( $query->have_posts() ) : $query->the_post(); ?>
                  <div class="row m-0">
                    <div class="featuered-image">
                      <?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
                    </div>
                  </div>
                  <?php endwhile; 
                  wp_reset_postdata();?>
                  <?php else : ?>
                   <div class="no-postfound"></div>
                  <?php
                  endif; ?>
                <div class="clearfix"></div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 p-0">
            <div id="about" class="darkbox" >
              <?php 
               $bb_mobile_application_catData=  get_theme_mod('bb_mobile_application_blogcategory_right_setting');
               if($bb_mobile_application_catData){
                $page_query = new WP_Query(array( 'category_name' => esc_html($bb_mobile_application_catData,'ts-mobile-app')));?>
                  <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
                    <div class="right-part mb-4">
                      <div class="row m-0">
                        <div class="col-lg-4 col-md-4 p-0">
                          <div class="abt-img-box"><?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?></div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                          <h3 class="text-md-start text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h3>
                        </div>
                      </div>
                      <p class="pt-2 mb-0 text-md-start text-center"><?php $excerpt = get_the_excerpt(); echo esc_html( bb_mobile_application_string_limit_words( $excerpt,10 ) ); ?></p>
                    </div>
                <?php endwhile;
              wp_reset_postdata();
               }
              ?>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>

  <?php do_action( 'bb_mobile_application_after_creative_feature' ); ?>

  <?php if( get_theme_mod('ts_mobile_app_category_post') != ''){ ?>
    <section id="service-cate">
      <div class="row m-0">
        <?php 
          $page_query = new WP_Query(array( 'category_name' => esc_html(get_theme_mod('ts_mobile_app_category_post'),'ts-mobile-app')));?>
          <?php $counter = 1; ?>
            <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
            <div class="col-lg-3 col-md-3 p-0">
              <div class="service text-center p-4 post-list-<?php echo esc_html( ts_mobile_app_odd_or_even($counter)); ?>">
                <?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
                <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4><span class="screen-reader-text"><?php the_title(); ?></span></a>
              </div>
            </div>
            <?php $counter++; ?>
          <?php endwhile;
          wp_reset_postdata();
        ?>
      </div>
    </section>
  <?php }?>

  <?php do_action( 'bb_mobile_application_before_about' ); ?>

  <?php if( get_theme_mod('ts_mobile_app_post') != ''){ ?>
    <section id="about-mobile" class="my-4">
      <div class="container">
        <?php
        $args = array( 'name' => get_theme_mod('ts_mobile_app_post',''));
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="row m-0">
            <div class="col-lg-6 col-md-6">
              <div class="featuered-image">
                <?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <h5 class="py-3"><?php the_title(); ?></h5>
              <p><?php the_excerpt(); ?></p>
              <div class="know-btn">
                <a href="<?php the_permalink(); ?>" class="p-3"><?php echo esc_html_e('READ MORE','ts-mobile-app'); ?><span class="screen-reader-text"><?php esc_html_e( 'READ MORE','ts-mobile-app' );?></span></a>
              </div>
            </div>
          </div>
          <?php endwhile; 
          wp_reset_postdata();?>
        <?php else : ?>
          <div class="no-postfound"></div>
        <?php
        endif; ?>
      </div>
    </section>
  <?php }?>

  <?php do_action( 'bb_mobile_application_after_about' ); ?>

  <div class="container entry-content">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </div>
</main>

<?php get_footer(); ?>