<?php
$path = preg_replace('/wp-content.*$/','', __DIR__);
require_once($path."wp-load.php");

global $wpdb, $post;

if(array_key_exists('submit_scripts_update',$_POST)){
    $x = sanitize_email( $_POST['sc_email']);
    $y = sanitize_textarea_field( $_POST['sc_subject']);
}

if(isset($_POST['ContactSubmit']) && $_POST['ContactSubmit']=="1")
{   
    $name = sanitize_text_field( $_POST['name']);
    $email = sanitize_email( $_POST['email']);
    $phone = sanitize_text_field( $_POST['phone']);
    $comments = sanitize_textarea_field( $_POST['comments']);
    
    $to = 'huynhlehuuthanh@gmail.com';
    $subject ='hello !';
    $message = '';
    $message .= 'Name: '.$name.'<br/>';
    $message .= 'Email: '.$email.'<br/>';
    $message .= 'Phone: '.$phone.'<br/>';

    $comments = wpautop( $comments);
    $comments = str_replace("<p>","",$comments);
    $comments = str_replace("<p>","<br/><br/>", $comments);

    $message .= 'Comments:<br/>'. $comments . '<br/><br/>';
    $message .= 'Thank you.';
    wp_mail($to, $subject, $message);
    
    $insertData = $wpdb -> get_results("INSERT INTO ".$wpdb->prefix."form_submissions (name, email, phone, message) VALUES ('".$name."','".$email."','".$phone."','".$comments."') ");

    $return = [];
    $return ['success'] = 1;
    $return ['message'] = 'Your information has been received.';

    echo json_encode($return);

    $time = current_time('mysql');
    $data = array(
        // 'comment_post_ID' => $post->ID,
        'comment_content' => $message,
        'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
        'comment_date' => $time,
        'comment_approved' => 1
    );
    wp_insert_comment($data);
}


?>