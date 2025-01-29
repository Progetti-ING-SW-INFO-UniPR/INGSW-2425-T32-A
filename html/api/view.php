<?php


     function response($data, $status = 200) {
        http_response_code($status);
        echo json_encode($data);
    }

     function error($message, $status = 400) {
        http_response_code($status);
        echo json_encode(["error" => $message]);
    }

