<?php

class App
{
    protected PageController $controller;
    protected string $method = "index";
    protected array $params = [];

    const DEFAULT_CONTROLLER = "Home";

    public function __construct()
    {
        $url = $this->parseURL();
        $url[0] = ucfirst($url[0]);

        // Set up the controller
        if (file_exists(__DIR__ . '/../controller/' . $url[0] . '.php')) {
            require_once __DIR__ . '/../controller/' . $url[0] . '.php';
            $this->controller = new $this->controller;
            unset($url[0]);
        } else {
            // Default Controller
            require_once __DIR__ . '/../controller/' . self::DEFAULT_CONTROLLER . '.php';
            $this->controller = new Home();
        }

        // Set up the method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Get data from request URL.
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        return call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL(): array
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}