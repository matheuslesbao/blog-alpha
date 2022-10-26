<?php

namespace app\Controller;

use app\Core\Controller;

class PostController extends Controller
{

    public function singlePost()
    {
        $this->load('Posts/main');
    }
}
