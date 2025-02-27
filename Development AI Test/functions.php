function setup_landing_page_acf_fields() {
    if(function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(array(
        'key' => 'group_landing_page',
        'title' => 'Landing Page Settings',
        'fields' => array(
            array(
                'key' => 'field_logo',
                'label' => 'Logo',
                'name' => 'logo',
                'type' => 'image',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_register_link_text',
                'label' => 'Register Link Text',
                'name' => 'register_link_text',
                'type' => 'text',
                'default_value' => 'Register',
            ),
            array(
                'key' => 'field_background_image',
                'label' => 'Background Image',
                'name' => 'background_image',
                'type' => 'image',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_title',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
            ),
            array(
                'key' => 'field_sub_title',
                'label' => 'Sub Title',
                'name' => 'sub_title',
                'type' => 'text',
            ),
            array(
                'key' => 'field_body_copy',
                'label' => 'Body Copy',
                'name' => 'body_copy',
                'type' => 'wysiwyg',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-landing.php',
                ),
            ),
        ),
    ));

    endif;
}
add_action('acf/init', 'setup_landing_page_acf_fields');

// Enqueue scripts and styles
function enqueue_landing_page_assets() {
    if(is_page_template('page-landing.php')) {
        wp_enqueue_style('landing-page', get_template_directory_uri() . '/assets/css/landing-page.css');
        wp_enqueue_script('landing-page', get_template_directory_uri() . '/assets/js/landing-page.js', array('jquery'), null, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_landing_page_assets'); 