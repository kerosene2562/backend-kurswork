<?php
    namespace controllers;
    
    use core\Controller;
    use core\Template;
    
    class ThreadsController extends Controller
    {
        public function actionAdd()
        {
            return $this->render();
        }

        public function actionIndex()
        {
            if($this->isGet)
            {
                $category_id = $this->get->category_id;
                
                $db = \core\Core::get()->db;
                $threads = $db->select("threads", "*", ['category_id' => $category_id]);
                $this->template->setParam("threads", $threads);
            }
            return $this->render();
            //$res=\models\Threads::findByCondition(['thread_id' => '4']);

            // $db->insert('threads', [
            //     'title' => 'news1',
            //     'description' => 'desc',
            //     'imgs_refs' => 'img2.jpg',
            //     'category_id' => '1'
            // ]);

            // \core\Core::get()->session->set('user_id', 1);
            // $id = \core\Core::get()->session->get('user_id');

            //$row = \models\Admins::findById(1);
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
                return $this->redirect("/lost_island/discussion/index?thread_id={$createdThread[0]['id']}");
            }
        }
    } 