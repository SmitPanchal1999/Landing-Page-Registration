<?php
/**
 * Template Name: M2M Landing Page
 * Template Post Type: page
 */

get_header(); 

// Get ACF fields
$logo = get_field('logo');
$background_image = get_field('background_image');
$register_text = get_field('register_link_text');
?>

<div class="m2m-landing-page" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
            url('<?php echo esc_url($background_image['url']); ?>');">
    <div class="m2m-header">
        <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="m2m-logo">
        <a href="#registration-form" class="register-button"><?php echo esc_html($register_text); ?></a>
    </div>

    <div class="m2m-content">
        <h1><?php echo wp_kses_post(get_field('title')); ?></h1>
        <h2><?php echo esc_html(get_field('sub_title')); ?></h2>
        <div class="body-copy">
            <?php echo wp_kses_post(get_field('body_copy')); ?>
        </div>
        
        <!-- Registration Form Area -->
        <div id="registration-form" class="registration-form">
            <div class="form-container">
                <h3>Registration</h3>
                <?php 
                if(function_exists('wpforms')) {
                    echo do_shortcode('[wpforms id="14"]');
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?> 