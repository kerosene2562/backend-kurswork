<?php
    namespace controllers;

    class CategoriesController extends \core\Controller
    {
        public function actionIndex()
        {
            $db = \core\Core::get()->db;
            $categories = $db->select("categories", "*");
            $this->template->setParam("Categories", $categories);

            $countOfTreads = $db->select("threads", "*", ["is_deleted" => 0]);
            $this->template->setParam("countOfTreads", count($countOfTreads));
            
            $countOfAllTreads = $db->select("threads", "*");
            $this->template->setParam("countOfAllTreads", count($countOfAllTreads));

            $countOfAllComments = $db->select("discussion", "*");
            $this->template->setParam("countOfAllComments", count($countOfAllComments));
            
            return $this->render();
        }

        public function actionAdd()
        {
            return $this->render();
        }

        public function actionRules()
        {
            return $this->render();
        }
    }
?>