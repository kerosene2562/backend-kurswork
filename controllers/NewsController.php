<?php
    namespace controllers;
    
    class NewsController
    {
        public function actionAdd()
        {
            $template = new \core\Template('views/news/add.php');
            return [
                'Content' => $template->getHTML(),
                'Title' => 'додавання новини'
            ];
        }

        public function actionIndex()
        {
            return [
                'Content' => 'Index action',
                'Title' => 'список новин'
            ];
        }

        public function actionView($params)
        {
            return [
                'Content' => 'news View',
                'Title' => 'перегляд новин'
            ];
        }
    } 