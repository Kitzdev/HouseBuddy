<?php

class App
{
    protected Controller $controller;
    protected string $method = "index";
    protected array $params = [];

    const DEFAULT_CONTROLLER = "HomeController";
    const API_VERSION_DIRECTORY = [
        "v1" => "version_1"
    ];

    public function __construct()
    {
        $url = $this->parseURL();

        /**
         * Set up controller
         */

        // API Request
        if (!empty($url) && $url[0] === "api") {
            $directory = self::API_VERSION_DIRECTORY[$url[1]];
            $url[2] = ucfirst($url[2]);
            require_once "APIController.php";

            $controllerName = "$url[2]APIController";
            if (file_exists(__DIR__ . '/../controller/api/' . "$directory/" . $controllerName . '.php')) {
                require_once __DIR__ . '/../controller/api/' . "$directory/" . $controllerName . '.php';
                $this->controller = new $controllerName;
                unset($url[0], $url[1], $url[2]);
            } else {
                // Default Controller
                require_once __DIR__ . '/../controller/' . self::DEFAULT_CONTROLLER . '.php';
                $this->controller = new HomeController();
            }

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $this->method = "read";
                    break;
                case 'POST':
                    $this->method = "create";
                    break;
                case 'PUT':
                    $this->method = "update";
                    break;
                case 'DELETE':
                    $this->method = "delete";
                    break;
            }

            if (!empty($url)) {
                $this->params = array_values($url);
            }

            header('Content-type: application/json');
            echo json_encode(call_user_func_array([$this->controller, $this->method], $this->params));
            return true;
        }

        $url[0] = ucfirst($url[0] ?? "");
        require_once "PageController.php";

        $controllerName = "$url[0]Controller";
        // Page Request
        if (file_exists(__DIR__ . '/../controller/' . $controllerName . '.php')) {
            require_once __DIR__ . '/../controller/' . $controllerName . '.php';
            $this->controller = new $controllerName;
            unset($url[0]);
        } else {
            // Default Controller
            require_once __DIR__ . '/../controller/' . self::DEFAULT_CONTROLLER . '.php';
            $this->controller = new HomeController();
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
            return explode('/', $url);
        }
        return [];
    }
}