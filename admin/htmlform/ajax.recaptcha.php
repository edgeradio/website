<?php
// File: ajax.recaptcha.php
// Author: HTMLForm.com


// Load reCaptcha Library
require_once('../resources/libraries/recaptcha/recaptchalib.php');

// Reading form configuration file
$ini_array = parse_ini_file("form_config.ini",true);

//Setting public and private keys
$publickey = $ini_array['general']['recaptcha_public_key'];
$privatekey = 'MY_PRIVATE_KEY'; 

// Checking reCaptcha answer
$resp = recaptcha_check_answer ($privatekey,

                                $_SERVER["REMOTE_ADDR"],

                                $_POST["recaptcha_challenge_field"],

                                $_POST["recaptcha_response_field"]);



if ($resp->is_valid) {
    ?>success<?php
}
else 
{	
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
       "(reCAPTCHA said: ".$_SERVER["REMOTE_ADDR"] . $resp->error . ")");
}

?>