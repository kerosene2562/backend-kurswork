<?php
    namespace controllers;

    use DateTime;

    class DiscussionController extends \core\Controller
    {
        public function actionIndex()
        {
            if($this->isGet)
            {
                $this->getIndexData();
            }
            return $this->render();
        }

        private function getIndexData()
        {
            $thread_id = $this->get->thread_id;
            $db = \core\Core::get()->db;

            $threadTitle = $db->select("threads", "*", ["id" => $thread_id]);
            $this->template->setParam("threadTitle", $threadTitle);

            $imgs = explode(" ", $threadTitle[0]["imgs_refs"]);
            $this->template->setParam("imgs", $imgs);

            $comments = $db->select("discussion", "*", ["thread_id" => $thread_id]);
            $this->template->setParam("selectedDiscussion", $comments);

            $categories = $db->select("categories", "*");
            $this->template->setParam("Categories", $categories);
        }

        public function actionGetDiscussion()
        {
            $thread_id = $this->get->thread_id;
            $db = \core\Core::get()->db;

            $comments = $db->select("discussion", "*", ["thread_id" => $thread_id]);

            header('Content-Type: application/json');
            echo json_encode($comments);
            exit;
        }


        public function actionAdd()
        {
            $id = $this->post->thread_id;
            $comment = new \models\Discussion();
            $comment->thread_id = $this->post->thread_id;
            $comment->comment = $this->post->comment;
            $comment->parent_comment_id = $this->post->parent_comment_id;
            if(implode(' ', $this->files->imgs_refs["name"]) != "")
                $comment->imgs_refs = implode(' ', $this->files->imgs_refs["name"]);
            $comment->post_datetime = (new \DateTime('now'))->format('Y-m-d H:i:s');
            $comment->save();
            return $this->redirect("/lost_island//discussion/index?thread_id=$id");
        }
    }
?>