<?php
/**
 * Trigger this file on Plugin uninstall
 *
 * @package  ContactForm
 */

/**
 * Plugin Name:       Contact form Ajax Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Example plugin basic
 * Version:           1.0.0
 * Author:            Huu Thanh
 * Author URI:        https://author.example.com/
 */


defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

if ( !class_exists( 'ContactForm' ) ) {

	class ContactForm
	{
        public $plugin;

        function __construct(){
            $this -> plugin = plugin_basename( __File__ );
        }

		function register() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
            add_action('admin_menu', array($this, 'add_admin_page'));
            add_shortcode( 'contact_form',array($this, 'contact_form_show') );
            add_action( 'wp_footer', array($this,'add_script'));
            add_action( 'wp_head', array($this, 'add_style'));
            add_filter("plugin_action_links_$this->plugin", array($this,'settings_link'));
		}

        function settings_link($links){
            $settings_link ='<a href="options-general.php?page=contact_form_setting">Settings</a>';
            array_push($links, $settings_link);
            return $links;
        }

        function contact_form_show(){
            $content = '';
            $content .= '<div id="response_div"></div>';
            $content .= '<div class="contact-form">';
            $content .= '<div class="form">';
            $content .= '<h2>LIÊN HỆ VỚI CHÚNG TÔI</h2>';
            $content .= '<p type="Họ và tên"><input name="your_name" id="your_name" placeholder="Nhập họ và tên"></input></p>';
            $content .= '<p type="Email"><input name="your_email" id="your_email" placeholder="Email của bạn"></input></p>';
            $content .= '<p type="Số điện thoại"><input name="phone_number" id="phone_number" placeholder="Số điện thoại liên hệ"></input></p>';
            $content .= '<p type="Lời nhắn"><textarea name="your_comments" id="your_comments" placeholder="Lời nhắn của bạn"></textarea></p>';
            $content .= '<button name="contact_submit" id="contact_submit" onclick="submit_contact_form()">GỬI NGAY</button>';
            $content .= '<div>';
            $content .= '<span class="fa fa-phone"></span>028 2210 0290';
            $content .= '<span class="fa fa-envelope"></span>cskh@eznet.com.vn';
            $content .= '</div>';
            $content .= '</div>';
            $content .= '</div>';
            
            return $content;   
        }

        function add_style(){
            ?>
            <link rel="stylesheet" href="http://localhost/testplugin/wp-content/plugins/contact-form/assets/styles.css">
            <link rel="stylesheet" href="http://localhost/testplugin/wp-content/plugins/contact-form/assets/all.min.css">
            <?php
        }

        function add_script(){
            ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="http://localhost/testplugin/wp-content/plugins/contact-form/assets/scripts.js"></script>
            <?php
        }

        function add_admin_page(){
            add_menu_page('Form Contact','Setting Form','manage_options','contact_form_setting',array($this,'admin_index'),'dashicons-xing',200);
        }
       
        public function admin_index(){
            require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
        }

		function enqueue() {
			wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/styles.css', __FILE__ ) );
			wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/scripts.js', __FILE__ ) );
		}

		function activate() {
			require_once plugin_dir_path( __FILE__ ) . 'inc/contact-form-activate.php';
			ContactFormActivate::activate();
		}
	}

	$contacForm = new ContactForm();
	$contacForm->register();

	// activation
	register_activation_hook( __FILE__, array( $contacForm, 'activate' ) );

	// deactivation
	require_once plugin_dir_path( __FILE__ ) . 'inc/contact-form-deactivate.php';
	register_deactivation_hook( __FILE__, array( 'ContactFormDeactivate', 'deactivate' ) );

}