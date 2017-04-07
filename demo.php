<?php
//Include CSRF.php to use where you have forms
include('Helpers/CSRF.php');
?>

<?php

//check if it is a valid request if POST is set
if(isset($_POST['submit'])){

  if(CSRF::isValidRequest()){
    echo $_POST['user'];
  }

}

?>

<form method="POST">
  <label>Form with CSRF token:</label>
  <input type="text" name="user">
  <?php CSRF::putTokenField(); ?>
  <input type="submit" name="submit">
</form>

<form method="POST">
  <label>Form without a CSRF token:</label>
  <input type="text" name="user">
  <input type="submit" name="submit">
</form>
