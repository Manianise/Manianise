<?php

/**
 * validate_password
 *
 * @param  mixed $password
 * @return bool
 */
function validate_password(string $password) : bool {
  // Check if the password is at least 8 characters long
  if(strlen($password) < 8) {
    return false;
  }

  // Check if the password contains at least one uppercase letter, one lowercase letter, one number, and one special character
  if(!preg_match('/[A-Z]+/', $password) || !preg_match('/[a-z]+/', $password) || !preg_match('/[0-9]+/', $password) || !preg_match('/[\W]+/', $password)) {
    return false;
  }

  return true;
}

/**
 * user_name_validation
 *
 * @param  mixed $name
 * @return void
 */
function user_name_validation(string $name) {
    if (!validate_username($name) || preg_match('/[^a-zA-Z0-9]+/', $name) === 1) {
        return false;
    }
    return true;
}

/**
 * get_error_msg
 *
 * @return array
 */
function get_error_msg() : array {
	$errors = [];
	// Check if the username is valid
  if(user_name_validation($_POST['username']) === false) {
    $errors['user'] =  'Ce nom est déjà pris ou est non valide. Ne mettez pas d\'espace ou de caractères spéciaux';
  }
  // Check if the email is valid
  if(!is_email($_POST['email'])) {
    $errors['mail'] = 'e-mail non valide';
  }
  // Check if the email already exists
  if(email_exists($_POST['email']) !== false) {
    $errors['mail-exists'] = 'Cet email existe déjà';
  }
  // Check if the password is strong enough
  if(!validate_password($_POST['password'])) {
    $errors['pwd'] = 'Le mot de passe doit posséder au moins 8 caractères et contenir au moins une majuscule, une minuscule, un nombre et un caractère spécial.';
  }
	// Confirm password
  if($_POST['password'] !== $_POST['password-confirm']) {
    $errors['pwd-confirm'] = 'Vos mots de passes ne concordent pas';
  }
	return $errors;
}