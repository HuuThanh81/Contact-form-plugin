<?php
if(array_key_exists('submit_scripts_update',$_POST)){
  update_option('ht_contact_form_sc_email',$_POST['sc_email']);
  update_option('ht_contact_form_sc_subject',$_POST['sc_subject']);
  ?>
  <div id="setting-error-settings_updated" class="update_settings_error notice is-dismissible">
      <strong>Setting have been saved</strong>
  </div>
  <?php
}

$scf_email = get_option('ht_contact_form_sc_email','Your Email');
$scf_subject = get_option('ht_contact_form_sc_subject','Your Subject');
?>
<div class="wrap">
  <h2>Setting Contact Email</h2>
  <form method="post" action="">
      <label for="sc_email">Your Email</label>
      <textarea name="sc_email" class="large-text"><?php print $scf_email ?></textarea>
      <label for="sc_subject">Your Subject</label>
      <textarea name="sc_subject" class="large-text"><?php print $scf_subject ?></textarea>
      <input type="submit" name="submit_scripts_update" class="button button-primary" value="UPDATE !">
  </form>
</div>
    
    
    
    
    
  



