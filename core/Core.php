<?php
    namespace core;

    class Core
    {
        public $defaultLayoutPath = 'views/layouts/index.php';
        public $moduleName;
        public $actionName;
        public $router;
        public $template;

        public function __construct($route)
        {
            $this->router = new core\Router($route);
            $this->template = new Template($this->defaultLayoutPath);
        }

        public function run()
        {
            $params = $this->router->run();
            $this->template->setParams($params);
        }

        public function done()
        {
            $this->router->done();
        }
    }
?>