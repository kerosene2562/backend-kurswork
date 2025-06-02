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

            // $db->delete('threads', ['thread_id' => 3]);

            // $db->update('threads', [
            //     'title' => '111111'
            // ],[
            //     'thread_id' => '2'
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
                mkdir("pics/{$folder_uuid}", 0777);

                $files = $this->files->imgs_refs;
                $imgs = [];
                for($i = 0; $i < count($files["name"]); $i++)
                {
                    $file_uuid = uniqid();
                    $filename = $files['name'][$i];
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $path = $folder_uuid . "/" . $file_uuid . "." . $extension;
                    $imgs[] = $path;
                    move_uploaded_file($files['tmp_name'][$i], "pics/" . $path);
                }
                $thread->imgs_refs = json_encode($imgs);
                
                $thread->save();
                return $this->redirect("/lost_island/threads/index?category_id=1");
            }
        }
    } 