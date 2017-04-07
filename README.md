# PHP CSRF Protection class
easy to use csrf helper class for PHP

## How to use?

where ever you have a form, use `CSRF::putTokenField();` to insert a hidden token input field, which is used to check if the request is valid or a CSRF.

example:
```PHP

//include the CSRF.php file which is in Helpers folder
<form action='submit.php' method='POST'>
<input type='text' name='comment'>
<?php CSRF::putTokenField(); ?>
<input type='submit' name='submit'>
</form>

```

To check if incomming request is a valid request and has a token use `CSRF::isValidRequest()`
```PHP

if(isset($_POST['submit'])){
  if(CSRF::isValidRequest()){
    //your logic
  }
}

```
[or]
```PHP

CSRF::isValidRequest();
//logic

```
`CSRF::isValidRequest()` will kill the execution if there is no valid token
