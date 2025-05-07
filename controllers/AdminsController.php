<?php
    namespace controllers;

    class AdminsController extends \core\Controller
    {
        public function actionLogin()
        {
            if(\models\Admins::IsAdminLogged())
            {
                return $this->redirect('/lost_island/news/index');
            }
            if($this->isPost)
            {
                $admin = \models\Admins::FindByLoginAndPassword($this->post->login, $this->post->password);
                if(!empty($admin))
                {
                    \models\Admins::LoginAdmin($admin);
                    return $this->redirect('/lost_island/news/index');
                }
                else
                {
                    $this->setErrorMessage('неправильний логін або пароль!');
                }
            }
            return $this->render();
        }

        public function actionRegister()
        {
            if($this->isPost)
            {
                $admin = \models\Admins::FindByLogin($this->post->login);
                if(!empty($admin))
                {
                    $this->addErrorMessage('користувач з таким логіном вже існує');
                }
                if($this->post->password != $this->post->password2)
                {
                    $this->addErrorMessage('паролі не співпадають');
                }
                if(empty($this->post->login))
                {
                    $this->addErrorMessage('логін не вказано');
                }
                if(empty($this->post->password))
                {
                    $this->addErrorMessage('пароль не вказано');
                }
                if(empty($this->post->mail))
                {
                    $this->addErrorMessage('пошту не вказано');
                }
            }
            return $this->render();
        }

        public function actionLogout()
        {
            \models\Admins::LogoutAdmin();
            return $this->redirect('login');
        }
    }
?>