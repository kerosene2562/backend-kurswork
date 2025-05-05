<?php
    namespace controllers;
    
    class SiteController
    {
        public function actionAdd()
        {
            $template = new \core\Template('views/site/add.php');
            return [
                'Content' => $template->getHTML(),
                'Title' => 'додавання сторінки'
            ];
        }

        public function actionIndex()
        {
            $template = new \core\Template('views/site/index.php');
            return [
                'Content' => $template->getHTML(),
                'Title' => 'головна сторінка'
            ];
        }
    } 