<?php
    namespace core;

    class Template
    {
        protected $templateFilePath;
        protected $paramsArray;

        public Controller $controller;

        public function __set($name, $value)
        {
            Core::get()->template->setParam($name, $value);
        }

        public function __construct($templateFilePath)
        {
            $this->templateFilePath = $templateFilePath;
            $this->paramsArray = [];
        }

        public function setTemplateFilePath($path)
        {
            $this->templateFilePath = $path;
        }

        public function setParam($paramsName, $paramsValue)
        {
            $this->paramsArray[$paramsName] = $paramsValue;
        }

        public function setParams($params)
        {
            foreach($params as $key => $value)
            {
                $this->setParam($key, $value);
                
            }
        }

        public function getHTML()
        {
            $code = 0;
            $core = \core\Core::get();
            $action = $core->actionName;
            

            if(file_exists($this->templateFilePath))
            {
                $code = http_response_code();
            }

            if($action == "rules"){
                $cache_path = "cache/cache_rules.php";
                
                if($code == 200 && file_exists($cache_path) && file_exists($this->templateFilePath)){
                    include_once($cache_path);
                    exit;
                }
                else if($code == 200 && !file_exists($cache_path) && file_exists($this->templateFilePath)){
                    ob_start();
                    include($this->templateFilePath);
                    $page_content = ob_get_contents();
                    ob_end_clean();
                    file_put_contents($cache_path, $page_content);
                    include_once($cache_path);
                    exit;
                }
                else if(file_exists($cache_path) && !file_exists($this->templateFilePath)){
                    unlink($cache_path);
                    exit;
                }
                $core->error(404);
            }
            else{
                if(file_exists($this->templateFilePath))
                {
                    ob_start();
                    $this->controller = \core\Core::get()->controllerObject;
                    extract($this->paramsArray);
                    include($this->templateFilePath);
                    $str = ob_get_contents();
                    ob_end_clean();
                    return $str;
                }
                else{
                    $core->error(404);
                }
            }
        }

        public function display()
        {
            echo $this->getHTML();
        }
    }