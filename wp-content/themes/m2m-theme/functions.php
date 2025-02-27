<?php
// Theme setup
function m2m_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'm2m_theme_setup');

// ACF Fields setup
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
                'required' => 1,
            ),
            array(
                'key' => 'field_register_link_text',
                'label' => 'Register Link Text',
                'name' => 'register_link_text',
                'type' => 'text',
                'default_value' => 'REGISTER ›',
                'required' => 1,
            ),
            array(
                'key' => 'field_background_image',
                'label' => 'Background Image',
                'name' => 'background_image',
                'type' => 'image',
                'return_format' => 'array',
                'required' => 1,
            ),
            array(
                'key' => 'field_title',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'textarea',
                'default_value' => "Life.\nIn a New Light.",
                'required' => 1,
                'rows' => 2,
                'new_lines' => 'br',
                'placeholder' => 'Enter title here (use Enter/Return for line breaks)',
            ),
            array(
                'key' => 'field_sub_title',
                'label' => 'Sub Title',
                'name' => 'sub_title',
                'type' => 'text',
                'default_value' => 'Introducing Toronto most highly anticipated residential project.',
                'required' => 1,
            ),
            array(
                'key' => 'field_body_copy',
                'label' => 'Body Copy',
                'name' => 'body_copy',
                'type' => 'wysiwyg',
                'required' => 1,
                'default_value' => '<p>Each home at M2M is constructed around a column of light, and is designed to promote health, well being and exceptional living.</p>
<p class="project-details">
    20 LUXURY TOWN HOMES<br>
    IN BROCKTON VILLAGE<br>
    WEST QUEEN WEST<br>
    FROM 1.1 MILLION
</p>',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'templates/page-landing.php',
                ),
            ),
        ),
    ));

    endif;
}
add_action('acf/init', 'setup_landing_page_acf_fields');

// Enqueue scripts and styles
function m2m_enqueue_assets() {
    if(is_page_template('templates/page-landing.php')) {
        wp_enqueue_style('m2m-landing', get_template_directory_uri() . '/assets/css/landing-page.css', array(), '1.0.1');
        wp_enqueue_script('m2m-landing', get_template_directory_uri() . '/assets/js/landing-page.js', array('jquery'), '1.0.1', true);
    }
}
add_action('wp_enqueue_scripts', 'm2m_enqueue_assets');

// Add debugging
add_action('wp_footer', function() {
    if(is_page_template('templates/page-landing.php')) {
        echo '<!-- M2M Landing page template loaded -->';
    }
});

// Create custom table for form submissions
function m2m_create_submissions_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'form_submissions';
    
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(20) NOT NULL,
        address text NOT NULL,
        submission_date datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('after_switch_theme', 'm2m_create_submissions_table');

// Handle form submission
function m2m_save_form_submission($fields, $entry, $form_data, $entry_id) {
    // Only process form with ID 14 (your registration form)
    if ($form_data['id'] != 14) {
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'form_submissions';

    // Get the field values using the correct field IDs
    $name = sanitize_text_field($fields['1']['value']);     // Name field ID: 1
    $address = sanitize_text_field($fields['2']['value']);  // Address field ID: 2
    $email = sanitize_email($fields['5']['value']);         // Email field ID: 5
    $phone = sanitize_text_field($fields['8']['value']);    // Phone field ID: 8

    // Insert into database
    $wpdb->insert(
        $table_name,
        array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
        ),
        array(
            '%s', // name
            '%s', // email
            '%s', // phone
            '%s', // address
        )
    );
}
add_action('wpforms_process_complete', 'm2m_save_form_submission', 10, 4);

// Add admin menu to view submissions
function m2m_add_admin_menu() {
    add_menu_page(
        'Form Submissions',
        'Form Submissions',
        'manage_options',
        'form-submissions',
        'm2m_submissions_page',
        'dashicons-list-view',
        30
    );
}
add_action('admin_menu', 'm2m_add_admin_menu');

// Create the submissions page in admin
function m2m_submissions_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'form_submissions';
    
    // Get all submissions
    $submissions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submission_date DESC");
    
    ?>
    <div class="wrap">
        <h1>Form Submissions</h1>
        <table class="widefat fixed" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($submissions as $submission): ?>
                <tr>
                    <td><?php echo esc_html($submission->id); ?></td>
                    <td><?php echo esc_html($submission->name); ?></td>
                    <td><?php echo esc_html($submission->email); ?></td>
                    <td><?php echo esc_html($submission->phone); ?></td>
                    <td><?php echo esc_html($submission->address); ?></td>
                    <td><?php echo esc_html($submission->submission_date); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
} 