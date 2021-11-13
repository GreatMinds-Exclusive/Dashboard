<?php require_once 'core/init.php';
  if (isset($_POST['admlogin'])) {
      $user->email = trim($_POST['username']);
      $user->password = trim($_POST['password']);

      // Ensure no field is empty
      if (!empty($user->username) && !empty($user->password)) {
          // Hash password
          $user->password = md5($user->password);
          if ($user->login($user->username, $user->password)) {
              ($_SESSION['us3rgr0up'] == 500) ? redirectTo('admin/index.php') : redirectTo('index.php');
          }
          else {
              $errors[] = "Authentication failed.";
          }
      }
      else {
          $errors[] = "All fields are required.";
      }
  }