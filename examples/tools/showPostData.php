<?php
$headers = getallheaders();
$rawPostData = file_get_contents('php://input');

error_log('Authorization: ' . $headers['Authorization']);
error_log('Content-Type: ' . $headers['Content-Type']);
error_log("Raw post data:\n" . $rawPostData);
error_log('Received ' . strlen($rawPostData) . ' bytes');
