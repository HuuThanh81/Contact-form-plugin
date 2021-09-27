<?php
$path = preg_replace('/wp-content.*$/','', __DIR__);
require_once($path."wp-load.php");
if(isset($_POST['ContactSubmit']) && $_POST['ContactSubmit']=="1")
{   
    global $wpdb;
    $name = sanitize_text_field( $_POST['name']);
    $email = sanitize_email( $_POST['email']);
    $phone = sanitize_text_field( $_POST['phone']);
    $comments = sanitize_textarea_field( $_POST['comments']);
    
    $to = 'huynhlehuuthanh@gmail.com';
    $subject ='hello !';
    $message = '';
    $message .= 'Name:'.$name.'<br/>';
    $message .= 'email:'.$email.'<br/>';
    $message .= 'phone:'.$phone.'<br/>';
    $message .= 'Name:'.$name.'<br/>';

    $comments = wpautop( $comments);
    $comments = str_replace("<p>","",$comments);
    $comments = str_replace("<p>","<br/><br/>", $comments);

    $message .= 'Comments:<br/>'. $comments . '<br/><br/>';
    $message .= 'Thank you.';
    wp_mail($to, $subject, $message);
    
    $insertData = $wpdb -> get_results("INSERT INTO ".$wpdb->prefix."form_submissions (`name`, `email`, `phone`, `message`) VALUES ('".$name."','".$email."','".$phone."','".$comments."') ");

    $return = [];
    $return ['success'] = 1;
    $return ['message'] = 'Your information has been received.';

    echo json_encode($return);
}
?>