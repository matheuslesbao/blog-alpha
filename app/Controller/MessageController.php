<?php

namespace app\Controller;

use app\Core\Controller;

class MessageController extends Controller
{
    public function message(string $title, string $message, $code = 404)
    {
        http_response_code($code);
        $this->load('Message/main', [
            'title' => $title,
            'message' => $message
        ]);
    }
}
