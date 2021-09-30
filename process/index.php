<?php
$path = preg_replace('/wp-content.*$/','', __DIR__);
require_once($path."wp-load.php");

global $wpdb, $post;

if(isset($_POST['ContactSubmit']) && $_POST['ContactSubmit']=="1")
{   $create_date = time();
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
    
    $table_name = $wpdb->prefix . 'form_submissions';
    $wpdb->insert($table_name, array('id' => NULL, 'name' => $name, 'email' => $email, 'phone' => $phone, 'message' =>$comments, 'create_date' =>$create_date));

    $return = [];
    $return ['success'] = 1;
    $return ['message'] = 'Thông tin đăng ký của bạn đã được tiếp nhận.';

    echo json_encode($return);

    $time = current_time('mysql');
    $data = array(
        'comment_content' => $message,
        'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
        'comment_date' => $time,
        'comment_approved' => 1
    );
    wp_insert_comment($data);
}
?>