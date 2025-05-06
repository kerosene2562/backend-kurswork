<?php
    namespace controllers;
    
    use core\Controller;
    use core\Template;
    
    class NewsController extends Controller
    {
        public function actionAdd()
        {
            return $this->render();
        }

        public function actionIndex()
        {
            $db = \core\Core::get()->db;

            $res=\models\Threads::findByCondition(['thread_id' => '4']);

            // $thread = new \models\Threads();
            // $thread->title = "!!!!!!!!";
            // $thread->description = "desc!!!!";
            // $thread->imgs_refs = "img2.png";
            // $thread->category_id = "1";
            // $thread->created_at = "2025-05-06 19:00:00";
            // $thread->save();

            // $rows = $db->select("threads", ["title", "description", "imgs_refs"], ['thread_id' => 2]);
            // var_dump($rows);

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

            return $this->render();
        }

        public function actionView($params)
        {
            return $this->render();
        }
    } 