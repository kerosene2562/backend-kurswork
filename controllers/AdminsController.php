<?php
    namespace controllers;

    class AdminsController extends \core\Controller
    {
        public function actionLogin()
        {
            if($this->isPost)
            {
                $admin = \models\Admins::FindByLoginAndPassword($this->post->login, $this->post->password);
                if(!empty($user))
                {
                    \model\Admins::LoginAdmin($admin);
                    return $this->redirect();
                }
                else
                {
                    $this->template->setParam('error_message', 'неправильний логін або пароль!');
                }
            }
            return $this->render();
        }

        public function actionLogout()
        {
            \model\Admins::LogoutAdmin();
            return $this->redirect('/admins/login');
        }
    }
?>