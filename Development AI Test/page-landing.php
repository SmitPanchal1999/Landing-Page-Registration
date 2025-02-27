<?php
/**
 * Template Name: Landing Page
 */

get_header(); ?>

<div class="m2m-landing-page">
    <!-- Logo -->
    <div class="m2m-header">
        <?php 
        $logo = get_field('logo');
        if($logo): ?>
            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="m2m-logo">
        <?php endif; ?>
        
        <a href="#" class="register-button"><?php echo esc_html(get_field('register_link_text')); ?></a>
    </div>

    <!-- Main Content -->
    <div class="m2m-content">
        <h1><?php echo esc_html(get_field('title')); ?></h1>
        <h2><?php echo esc_html(get_field('sub_title')); ?></h2>
        <div class="body-copy">
            <?php echo wp_kses_post(get_field('body_copy')); ?>
        </div>
    </div>

    <!-- Registration Form -->
    <div class="registration-form" style="display: none;">
        <div class="form-container">
            <h3>Registration</h3>
            <?php 
            if(class_exists('GFAPI')){
                gravity_form(1, false, false, false, '', true);
            }
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?> 