<?php
    namespace controllers;
    
    use core\Controller;
    use core\Template;
    
    class ThreadsController extends Controller
    {
        public function actionAdd()
        {
            $db = \core\Core::get()->db;
            $categories = $db->select("categories", "*");
            $this->template->setParam("categories", $categories);
            return $this->render();
        }

        public function actionIndex()
        {
            if($this->isGet)
            {
                $category_id = $this->get->category_id;
                
                $db = \core\Core::get()->db;
                $threads = $db->select("threads", "*", ['category_id' => $category_id, 'is_deleted' => 0]);
                $this->template->setParam("threads", $threads);

                $comments = $db->select("discussion", "*", ["is_deleted" => 0], "ORDER BY thread_id");
                $this->template->setParam("comments", $comments);
            }
            return $this->render();
        }

        public function actionCreateThread()
        {
            if($this->isPost)
            {
                $folder_uuid = uniqid();
                $thread = new \models\Threads();
                $thread->title = $this->post->title;
                $thread->description = $this->post->description;
                $thread->category_id = $this->post->category_id;
                $thread->created_at = (new \DateTime('now'))->format('Y-m-d H:i:s');
                $thread->pics_folder_uuid = $folder_uuid;
                mkdir("pics/{$folder_uuid}", 0777, true);
                $thread->imgs_refs = $this->imgsUploader->getImgsJson($folder_uuid);  
                $thread->save();
                
                $db = \core\Core::get()->db;
                $createdThread = $db->select('threads', 'id', ["pics_folder_uuid" => $folder_uuid]);
                http_response_code(201);
                return $this->redirect("/lost_island/discussion/index?thread_id={$createdThread[0]['id']}");
            }
        }

        public function actionRules()
        {
            return $this->redirect("/lost_island/categories/rules");
        }
    } 