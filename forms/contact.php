<?php
  /**
  * Contact Form Handler - Ganesh Bhandari Portfolio
  * Email: bhandariganesh125@gmail.com
  * Phone: +977-9863464502
  */

  // Your personal receiving email address
  $receiving_email_address = 'bhandariganesh125@gmail.com';

  // Path to PHP Email Form Library
  $php_email_form = '../assets/vendor/php-email-form/php-email-form.php';

  if (file_exists($php_email_form)) {
    include($php_email_form);
  } else {
    die('Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : 'Website Visitor';
  $contact->from_email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
  $contact->subject = isset($_POST['subject']) ? strip_tags(trim($_POST['subject'])) : 'New Inquiry from bhandarig.com.np';

  // Message fields
  $contact->add_message($contact->from_name, 'From');
  $contact->add_message($contact->from_email, 'Email');

  if (!empty($_POST['phone'])) {
    $contact->add_message(strip_tags(trim($_POST['phone'])), 'Phone');
  }

  if (!empty($_POST['message'])) {
    $contact->add_message(strip_tags(trim($_POST['message'])), 'Message', 10);
  }

  // Optional SMTP Configuration (Uncomment and configure if hosting requires SMTP authentication)
  /*
  $contact->smtp = array(
    'host' => 'smtp.gmail.com',
    'username' => 'bhandariganesh125@gmail.com',
    'password' => 'your-app-password',
    'port' => '587',
    'encryption' => 'tls'
  );
  */

  echo $contact->send();
?>