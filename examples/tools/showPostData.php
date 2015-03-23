<?php
$rawPostData = file_get_contents('php://input');
error_log("raw post data:\n" . $rawPostData);
error_log('Received ' . strlen($rawPostData) . ' bytes');
