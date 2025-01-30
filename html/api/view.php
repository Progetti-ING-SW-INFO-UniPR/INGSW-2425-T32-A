<?php

class view{

     public function response($data, $status = 200) {
        http_response_code($status);
        echo json_encode($data);
    }

    public function error($message, $status = 400) {
        http_response_code($status);
        echo json_encode(["error" => $message]);
    }

}