<?php

namespace app\Controller;

use app\Core\Controller;
use app\Model\PostModel;

class PagesController extends Controller
{

    public function home()
    {
        $this->load('Home/main'), [
            'id' => postagem->id,
            'titulo' => postagem->titulo,
            'conteudo' => postagem->conteudo,
        ];
    }

    public function singlePost()
    {
        $this->load('Posts/main');
    }
}
