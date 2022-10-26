<?php

namespace app\Core;


class RouterCore
{
    private $uri; // url depois de local host
    private $method; // metodo usado na url

    private $getArr = [];

    public function __construct() // Ao iniciar aplicação sera iniciado o constructor primeiramente
    {
        $this->initialize();
        require_once('../app/config/Router.php');
        $this->execute();
    }

    private function initialize() // tratamento da uri
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        $ex = explode('/', $uri); // separa a uri em array

        $uri = $this->normalizeURI($ex);

        for ($i = 0; $i < UNSET_URI_COUNT; $i++) {
            unset($uri[$i]);  // unset remove o primeiro indice do array informado no paramentro da uri
        }

        $this->uri = implode('/', $this->normalizeURI($uri)); // separa a uri em string

        if (DEBUG_URI) {
            dd($uri);
        }
    }

    private function normalizeURI($params) // padronizar uri
    {
        return array_values(array_filter($params)); //filtra e muda os valores de indice no array
    }

    private function get($router, $call)
    {
        $this->getArr[] = [
            'router' => $router,
            'call'   => $call
        ];
    }

    private function post($router, $call)
    {
        $this->getArr[] = [
            'router' => $router,
            'call'   => $call
        ];
    }


    private function execute()
    {
        switch ($this->method) {
            case 'GET':
                $this->executeGet();
                break;
            case 'POST':
                $this->executePost();
                break;
        }
    }

    private function executeGet()
    {
        foreach ($this->getArr as $get) {

            if (substr($get['router'], -1) == '/') {
                substr($get['router'], 0, -1);
            }

            if (substr($get['router'], 1) == $this->uri) {
                if (is_callable($get['call'])) {
                    $get['call']();
                    break;
                } else {
                    $this->executeController($get['call']);
                }
            }
        }
    }

    private function executePost()
    {
        foreach ($this->getArr as $get) {

            if (substr($get['router'], -1) == '/') {
                substr($get['router'], 0, -1);
            }

            if (substr($get['router'], 1) == $this->uri) {
                if (is_callable($get['call'])) {
                    $get['call']();
                    return;
                }

                $this->executeController($get['call']);
            }
        }
    }


    private function executeController($get)
    {
        $ex = explode('@', $get);

        if (!isset($ex[0]) || !isset($ex[1])) { // se nao encontrar o controller é o method
            (new \app\Controller\MessageController)->message('TITULO', 'Controller é method nao encontrado' . $get, 404);
            return;
        }

        $getController = 'app\\Controller\\' . $ex[0];
        if (!class_exists($getController)) { // verifica se existe a controller/ $get
            (new \app\Controller\MessageController)->message('TITULO', 'Controller Não Encontrada.' . $get, 404);
            return;
        }

        if (!method_exists($getController, $ex[1])) { //verifica se tem o method
            (new \app\Controller\MessageController)->message('TITULO', 'Method Não Encontrada.' . $get, 404);
            return;
        }


        call_user_func_array([new $getController, $ex[1]], []);
    }
}
