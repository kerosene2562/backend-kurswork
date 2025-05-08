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
                
                if(strlen($this->post->login) == 0)
                {
                    $this->addErrorMessage('логін не вказано');
                }
                if($this->post->password != $this->post->password2)
                {
                    $this->addErrorMessage('паролі не співпадають');
                }
                if(strlen($this->post->password) == 0)
                {
                    $this->addErrorMessage('пароль не вказано');
                }
                if(strlen($this->post->password2) == 0)
                {
                    $this->addErrorMessage('повторний пароль не вказано');
                }
                if(strlen($this->post->email) == 0)
                {
                    $this->addErrorMessage('пошту не вказано');
                }
                if(!$this->isErrorMessagesExist())
                {
                    \models\Admins::RegisterAdmin($this->post->login, $this->post->password, $this->post->email);
                    return $this->redirect('/lost_island/admins/registersuccess');
                }
            }
            return $this->render();
        }

        public function actionRegisterSuccess()
        {
            return $this->render();
        }

        public function actionLogout()
        {
            \models\Admins::LogoutAdmin();
            return $this->redirect('login');
        }
    }
?>