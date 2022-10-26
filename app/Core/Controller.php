<?php

namespace app\Core;

class Controller
{
    protected function load(string $view, $params = [])
    {
        $twig = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader('../app/View/')
        );

        $twig->addGlobal('BASE', BASE);
        echo $twig->render($view . '.twig.php', $params);
    }

    public function showMessage(string $titulo, string $description, string $link = null, int $httpCode = 200)
    {
        http_response_code($httpCode);

        $this->load('Partials/message', [
            'titulo'    => $titulo,
            'description' => $description,
            'link'      => $link
        ]);
    }
}
