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
            $core = \core\Core::get();
            $thread_id = $this->get->thread_id;
            $db = $core->db;

            $threadTitle = $db->select("threads", "*", ["id" => $thread_id]);
            if(!empty($threadTitle))
            {
                $this->template->setParam("threadTitle", $threadTitle[0]);

                $comments = $db->select("discussion", "*", ["thread_id" => $thread_id]);
                $this->template->setParam("selectedDiscussion", $comments);

                $categories = $db->select("categories", "*");
                $this->template->setParam("Categories", $categories);
            }
            else
            {
                $core->error(404);
            }
        }

        public function actionGetDiscussion()
        {
            $thread_id = $this->get->thread_id;
            $db = \core\Core::get()->db;

            $comments = [];
            $commentsAll = $db->select("discussion", "*", ["thread_id" => $thread_id]);
            foreach($commentsAll as $comment)
            {
                if($comment["is_deleted"])
                {
                   
                    $comment["comment"] = "Коментар видалено...";
                    $comment["imgs_refs"] = "[]"; 
                }
                $comments[] = $comment;
                
            }

            header('Content-Type: application/json');
            echo json_encode($comments);
            exit;
        }

        public function actionAdd()
        {
            $id = $this->post->thread_id;
            $db = \core\Core::get()->db;
            $folder_uuid = $db->select("threads", "pics_folder_uuid", ["id" => $id])[0]["pics_folder_uuid"];
            $comment = new \models\Discussion();
            $comment->thread_id = $this->post->thread_id;
            $comment->comment = $this->post->comment;
            $comment->parent_comment_id = $this->post->parent_comment_id;
            $comment->imgs_refs = $this->imgsUploader->getImgsJson($folder_uuid);
            $comment->save();
            exit;
        }

        public function actionReport()
        {
            $id = $this->post->reportedOnId;
            $isComment = $this->post->reportedType;
            
            $report = new \models\Reports();
            $report->reason = $this->post->reason;
            $report->reported_id = $id;
            $report->type = $isComment;
            $report->save();
        }
    }
?>