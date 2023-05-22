<?php
session_start();
unset($_SESSION);
session_destroy();
echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
?>