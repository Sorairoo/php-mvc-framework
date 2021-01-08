<?php
class Router {
    protected $conn;
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function __construct(\PDO $conn) {

        $this->conn = $conn;
    }

    public function loadRoutes(array $routes) {

        $this->routes = $routes;
    }

    public function getRoutes() {
        return $this->routes;
    }
    public function dispatch(){

        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $url = trim($url ,'/');

        $method = $_SERVER['REQUEST_METHOD'];
        return $this->processQueue($url, $method);
    }
    protected function processQueue($uri, $method = 'GET') {

        $routes = $this->routes[$method];

        foreach ($routes as $route => $callback) {

            $regMatch = preg_quote($route);
	
            $subPattern = preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)',  $regMatch);

            $pattern = "@^" . $subPattern. "$@D";
			
            $matches = [];

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                return $this->route($callback, $matches);

            }
        }
        throw new Exception('No matchin routes found for ' . $uri);


    }

    protected function route($callback, array $matches =[])
    {
        try {
            if(is_callable($callback)){
                return   call_user_func_array($callback, $matches);
            }
            $tokens = explode('@',$callback);

            $controller = $tokens[0];

            $method = $tokens[1];

            $class =  new $controller($this->conn);

            if(method_exists($controller, $method)){
                call_user_func_array([$class, $method], $matches);
                return $class;

            } else {
                throw new Exception('Method '.$method.' not found in class '. $controller);
            }
         } 
         catch (Exception $e){
             die($e->getMessage());
         }
     }

}
