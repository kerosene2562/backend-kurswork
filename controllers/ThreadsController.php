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
            if($this->isPost)
            {
                $recaptchaSecret = '6LcQGl0rAAAAAALMw9eIkW-aP2uXGPg6EQ72TKec';
                $recaptchaResponse = $_POST['g-recaptcha-response'];

                if (!$recaptchaResponse) {
                    $error_message = "Будь ласка, пройдіть перевірку reCAPTCHA.";
                } else {
                    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptchaSecret."&response=".$recaptchaResponse);
                    $responseKeys = json_decode($response, true);

                    if(intval($responseKeys["success"]) !== 1) {
                        $this->addErrorMessage('Ви не пройшли капчу!');
                        return $this->render();
                    }
                    else{
                        $db = \core\Core::get()->db;
                
                        if(strlen($this->post->title) < 10)
                        {
                            $this->addErrorMessage('Довжина назви повинна становити більше 10 символів!');
                            return $this->render();
                        }
                        if(strlen($this->post->title) > 255)
                        {
                            $this->addErrorMessage('Довжина назви повинна становити не більше 255 символів!');
                            return $this->render();
                        }
                        if(strlen($this->post->description) > 15000)
                        {
                            $this->addErrorMessage('Довжина опису повинна становити не більше 15000 символів!');
                            return $this->render();
                        }
                        if($this->post->category_id == "-")
                        {
                            $this->addErrorMessage('Оберіть категорію!');
                            return $this->render();
                        }
                        
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
            }
            return $this->render();
        }

        public function actionIndex()
        {
            if($this->isGet)
            {                
                $category_id = $this->get->category_id;
                $this->template->setParam('category_id', $category_id);
            }
            return $this->render();
        }

        public function actionGetThreads(){
            $category_id = $this->get->category_id;
            $like = $this->get->search;
            $sort_by = $this->get->sort_by;
            $db = \core\Core::get()->db;

            $search = "";
            if($like != "")
            {
                $search = " AND title LIKE '%{$like}%'";
            }
            if($sort_by == "time")
            {
                $search .= " ORDER BY created_at";
            }

            $statsComments = [];
            $statsMedia = [];
            $comments = $db->select("discussion", "*", ["is_deleted" => 0], "ORDER BY thread_id");
            foreach($comments as $comment)
            {
                if(array_key_exists($comment["thread_id"], $statsComments))
                {
                    $statsComments[$comment["thread_id"]]++;
                    $statsMedia[$comment["thread_id"]] += count(json_decode($comment["imgs_refs"]));
                }
                else
                {
                    $statsMedia[$comment["thread_id"]] = count(json_decode($comment["imgs_refs"]));
                    $statsComments[$comment["thread_id"]] = 1;
                }
            }

            $threads = [];
            $threadsAll = $db->select("threads", "*", ["category_id" => $category_id], $search);
            foreach($threadsAll as $thread)
            {
                if($thread["is_deleted"])
                {
                   continue;
                }
                $threads[] = $thread;
            }
            
            foreach($threads as $index => $thread)
            {
                if(isset($statsComments[$thread['id']]))
                {
                    $threads[$index]['statsCom'] = $statsComments[$thread['id']];
                    $threads[$index]['statsMedia'] = $statsMedia[$thread['id']];
                }
                else
                {
                    $threads[$index]['statsCom'] = 0;
                    $threads[$index]['statsMedia'] = 0;
                }
            }

            if($sort_by == "bamp"){
                usort($threads, function($a, $b){
                    return $b['statsCom'] <=> $a['statsCom'];
                });
            }

            header('Content-Type: application/json');
            echo json_encode($threads);
            exit;
        }

        public function actionRules()
        {
            $this->func();
            return $this->redirect("/lost_island/categories/rules");
        }
    } 