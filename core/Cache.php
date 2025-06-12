<?php
    namespace core;

    class Cache
    {
        public function cachePage()
        {
            $code = 0;
            $core = \core\Core::get();
            $action = $core->actionName;
            

            if(file_exists($this->templateFilePath))
            {
                $code = http_response_code();

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
            }
        }

        public function getCachedPage()
        {

        }
    }
?>