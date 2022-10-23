<?php

namespace app\Controller;

use app\Core\Controller;

class PagesController extends Controller
{

    public function home()
    {
        $this->load('Home/main');
    }

    public function singlePost()
    {
        $this->load('Posts/main');
    }
}
