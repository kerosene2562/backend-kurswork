<?php
    namespace controllers;

    use DateTime;

    class DiscussionController extends \core\Controller
    {
        public function actionIndex()
        {
            if($this->isGet)
            {
                $thread_id = $this->get->thread_id;
                $db = \core\Core::get()->db;

                $threadTitle = $db->select("threads", "*", ["id" => $thread_id]);
                $this->template->setParam("threadTitle", $threadTitle);

                $comments = $db->select("discussion", "*", ["thread_id" => $thread_id]);
                $this->template->setParam("selectedDiscussion", $comments);
            }
            return $this->render();
        }

        public function actionAdd()
        {
            $id = $this->post->thread_id;
            $comment = new \models\Discussion();
            $comment->thread_id = $this->post->thread_id;
            $comment->comment = $this->post->comment;
            $comment->parent_comment_id = $this->post->parent_comment_id;
            $comment->post_datetime = (new \DateTime('now'))->format('Y-m-d H:i:s');
            $comment->save();
            return $this->redirect("/lost_island//discussion/index?thread_id=$id");
        }
    }
?>