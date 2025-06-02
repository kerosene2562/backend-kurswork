<?php
    namespace controllers;

    class CategoriesController extends \core\Controller
    {
        public function actionIndex()
        {
            $db = \core\Core::get()->db;
            $categories = $db->select("categories", "*");
            $this->template->setParam("Categories", $categories);

            $countOfTreads = $db->select("threads", "*");
            $this->template->setParam("countOfTreads", count($countOfTreads));
            
            return $this->render();
        }

        public function actionAdd()
        {
            return $this->render();
        }
    }
?>