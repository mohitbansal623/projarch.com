<?php
session_start();
if (!isset($_SESSION['role']) || !isset($_SESSION['uid'])) {
    header('Location: /');
  }
?>  