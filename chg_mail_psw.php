<?php

include_once('./fct/load.php');

if(!isset($_POST)){
  header('location:parametres.php');
}else{
  //echo $_POST['new_psw'];
  set_mail_psw($_POST['new_psw']);
  header('location:parametres.php');
}
