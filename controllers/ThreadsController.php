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
                $rows = $db->select("threads", "*", ['category_id' => $category_id]);
                $this->template->setParam("threads", $rows);
            }

            //$res=\models\Threads::findByCondition(['thread_id' => '4']);

            // $thread = new \models\Threads();
            // $thread->title = "!!!!!!!!";
            // $thread->description = "desc!!!!";
            // $thread->imgs_refs = "img2.png";
            // $thread->category_id = "1";
            // $thread->created_at = "2025-05-06 19:00:00";
            // $thread->save();

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
            
            return $this->render();
        }

        public function actionView($params)
        {
            return $this->render();
        }
    } 