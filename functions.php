<?php
    /**
     * Functions.php
     *
     *
     * @package SDEV
     * @subpackage SDEV WP
     * @since SDEV WP Theme 2.0
     */
    if(!isset($_SESSION)){
        session_start();
    }
    define('DEV_ENV', 0);

    /* Show errors if DEV_ENV is set to 0 */
    if(DEV_ENV === 0){
        ini_set('display_errors', 0);
        ini_set('display_startup_errors',0);
        error_reporting(E_ALL);
    }
    
    /* remove "Private: " from titles */
    function remove_private_prefix($title) {
        $title = str_replace('Private: ', '', $title);
        return $title;
    }
    add_filter('the_title', 'remove_private_prefix');
    add_theme_support( 'post-thumbnails' );


    /* remove p tag wrap in images */
    function filter_ptags_on_images($content) {
        $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
        return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
    }
    add_filter('acf_the_content', 'filter_ptags_on_images');
    add_filter('the_content', 'filter_ptags_on_images');

    /* Add theme support for plugin features */
    add_theme_support( 'title-tag' );
    add_theme_support( 'yoast-seo-breadcrumbs' );

    function get_primary_category($post_id, $taxonomy) {
 
        $term_list = wp_get_post_terms($post_id, $taxonomy, ['fields' => 'all']);
        $category = null;
 
        foreach($term_list as $term) {
 
            if( get_post_meta($post_id, '_yoast_wpseo_primary_category',true) == $term->term_id ) {
 
                // this is a primary category
                $category = $term->name;
 
            }
        }
 
        return $category;
 
    }

    /* SDEV Bootstrap */
    require_once('lib/sdev/sdev.php');

    /* Register ACF Blocks */
    require_once('src/views/blocks/register.php');

    /* Register theme assets */
    wp_register_style( 'google-fonts', 'https://use.typekit.net/mni3ffg.css' );
    wp_register_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css' );
    wp_register_style( 'poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600&display=swap' );
    wp_register_style( 'reset-css', \SDEV\Utils::getThemeResourcePath( 'assets/css/reset.css' ) );
    wp_register_style( 'sdev-theme-style', \SDEV\Utils::getThemeResourcePath( 'dist/style.css' ), array(), rand(111,9999), 'all' );
    wp_register_script( 'sdev-theme-script', \SDEV\Utils::getThemeResourcePath( 'dist/bundle.js' ), array('jquery'), rand(111,9999), true );

    /* Enqueue FE assets */
    function front_assets(){
        wp_enqueue_style( 'reset-css' );
        wp_enqueue_style( 'sdev-theme-style' );
        wp_enqueue_script( 'sdev-theme-script' );
        wp_enqueue_style( 'google-fonts');
        wp_enqueue_style( 'fontawesome');
        wp_enqueue_style( 'poppins');
    }

    /* Enqueue admin assets */
    function custom_admin_assets(){
        /* So our FE fonts and styles will reflect in admin acf block editor and there's no need to add stylesheet in each block. */
        wp_enqueue_style( 'google-fonts');
        wp_enqueue_style( 'sdev-theme-style' );
    }

    /* Hook them */
    add_action( 'wp_enqueue_scripts', 'front_assets' );
    add_action( 'admin_enqueue_scripts', 'custom_admin_assets' );
    register_sidebar();

    // save
    add_filter('gform_incomplete_submission_pre_save','modify_incomplete_submission', 10, 3 );
    function modify_incomplete_submission( $submission_json, $resume_token, $form ) {

        

        //change the user first name to Test in the saved data
        $updated_json = json_decode( $submission_json );
        $firstname = $updated_json->submitted_values->{'6'}->{'6.3'};
        $lastname = $updated_json->submitted_values->{'6'}->{'6.6'};
        $message = $updated_json->submitted_values->{'14'};
        $message = "Message: ".$updated_json->submitted_values->{'14'}."<br/> ------------------------------------------------------------------------";
        if(!empty($updated_json->submitted_values->{'10'})){
            $message .= "<br/> How should we get in touch?: ".$updated_json->submitted_values->{'10'}."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($updated_json->submitted_values->{'53'})){
            $message .= "<br/> Email Address: ".$updated_json->submitted_values->{'53'}."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($updated_json->submitted_values->{'50'})){
            $message .= "<br/> Phone Number: ".$updated_json->submitted_values->{'50'}."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($updated_json->submitted_values->{'47'})){
            $message .= "<br/> Phone Number: ".$updated_json->submitted_values->{'59'}."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($updated_json->submitted_values->{'17'})){
            $message .= "<br/> Is there already a case filed or pending?: ".$updated_json->submitted_values->{'17'}."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($updated_json->submitted_values->{'21'})){
            $message .= "<br/> Are there any minor children involved in the case?: ".$updated_json->submitted_values->{'21'}."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($updated_json->submitted_values->{'23'})){
            $message .= "<br/> If you know the case details please provide them: ".$updated_json->submitted_values->{'23'}." ".$updated_json->submitted_values->{'24'}."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($updated_json->submitted_values->{'29'})){
            $message .= "<br/> Is there a hearing scheduled?: ".$updated_json->submitted_values->{'29'}."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($updated_json->submitted_values->{'32'})){
            $message .= "<br/> What does the hearing regard?: ".$updated_json->submitted_values->{'32'}."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($updated_json->submitted_values->{'33'})){
            $message .= "<br/> Hearing Date: ".$updated_json->submitted_values->{'33'}."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($updated_json->submitted_values->{'36'})){
            $message .= "<br/> Was the hearing already continued?: ".$updated_json->submitted_values->{'36'}."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($updated_json->submitted_values->{'37'})){
            $message .= "<br/> Original Date: ".$updated_json->submitted_values->{'37'}."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($updated_json->submitted_values->{'41'})){
            $message .= "<br/> Date of Birth: ".$updated_json->submitted_values->{'41'}."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($updated_json->submitted_values->{'42'}->{'42.1'})){
            $message .= "<br/> Address: ".$updated_json->submitted_values->{'42.1'}."<br/> ------------------------------------------------------------------------";
        }
        $email = '';
        $phone = '';
 
        if (!filter_var($updated_json->submitted_values->{'5'}, FILTER_VALIDATE_EMAIL)) {
            // invalid emailaddress
            $phone = $updated_json->submitted_values->{'5'};
        } else {
            $email = $updated_json->submitted_values->{'5'};
        }

        $token = '9837a8f33d16723c9f620b42bbe05023';
    
        $ch = curl_init( 'https://grow.clio.com/inbox_leads' );
        # Setup request to send json via POST.
        $payload = json_encode( 
            array( 
                    "inbox_lead" => [
                        "from_first" => $firstname, //example dynamic: 
                        "from_last" => $lastname,
                        "from_message" => $message,
                        "from_email" => $email,
                        "from_phone" => $phone,
                        "referring_url" => "https://hemmatlaw.com/sign-up",
                        "from_source" => "Law Firm Landing Page"
                    ],
                    "inbox_lead_token" => $token
                ) 
            );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        # Return response instead of printing.
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch);
    }

    // submit
    add_action( 'gform_after_submission_5', 'clio_send', 10, 2 );
    function clio_send( $entry, $form ) {

        $token = '9837a8f33d16723c9f620b42bbe05023';
    
        $ch = curl_init( 'https://grow.clio.com/inbox_leads' );

        $message = "Message: ".$entry['14']."<br/> ------------------------------------------------------------------------";
        $message .= "<br/> Is there already a case filed or pending?: ".$entry['17']."<br/> ------------------------------------------------------------------------";
        if(!empty($entry['10'])){
            $message .= "<br/> How should we get in touch?: ".$entry['10']."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($entry['53'])){
            $message .= "<br/> Email Address: ".$entry['53']."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($entry['50'])){
            $message .= "<br/> Phone Number: ".$entry['50']."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($entry['59'])){
            $message .= "<br/> Phone Number: ".$entry['47']."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($entry['21'])){
            $message .= "<br/> Are there any minor children involved in the case?: ".$entry['21']."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($entry['23'])){
            $message .= "<br/> If you know the case details please provide them: ".$entry['23']." ".$entry['24']."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($entry['29'])){
            $message .= "<br/> Is there a hearing scheduled?: ".$entry['29']."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($entry['32'])){
            $message .= "<br/> What does the hearing regard?: ".$entry['32']."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($entry['33'])){
            $message .= "<br/> Hearing Date: ".$entry['33']."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($entry['36'])){
            $message .= "<br/> Was the hearing already continued?: ".$entry['36']."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($entry['37'])){
            $message .= "<br/> Original Date: ".date('m-d-Y', strtotime($entry['37']))."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($entry['41'])){
            $message .= "<br/> Date of Birth: ".date('m-d-Y', strtotime($entry['41']))."<br/> ------------------------------------------------------------------------";
        }
        if(!empty($entry['42.1'])){
            $message .= "<br/> Address: ".$entry['42.1']."<br/> ------------------------------------------------------------------------";
        }
        $email = '';
        $phone = '';
 
        if (!filter_var($entry['5'], FILTER_VALIDATE_EMAIL)) {
            // invalid emailaddress
            $phone = $entry['5'];
        } else {
            $email = $entry['5'];
        }


        # Setup request to send json via POST.
        $payload = json_encode(
            array(
                    "inbox_lead" => [
                        "from_first" => $entry['6.3'], //example dynamic:
                        "from_last" => $entry['6.6'],
                        "from_message" => $message,
                        "from_email" => $email,
                        "from_phone" => $phone,
                        "referring_url" => "https://hemmatlaw.com/sign-up",
                        "from_source" => "Law Firm Landing Page"
                    ],
                    "inbox_lead_token" => $token
                )
            );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        # Return response instead of printing.
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch);
    }

    
?>