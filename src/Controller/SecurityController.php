<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Core\Controller\Controller;
use Core\Http\Response;
use Core\Session\Session;

class SecurityController extends Controller
{
    public function register():Response
    {

        $username = null;
        $unencryptedPassword = null;
        if(!empty($_POST['username'])) {
            $username = $_POST['username'];
        }
        if(!empty($_POST['password'])) {
            $unencryptedPassword = $_POST['password'];
        }

        if($username && $unencryptedPassword)
        {
            $userRepository = new UserRepository();

            $userExistant = $userRepository->findByUsername($username);

            if($userExistant){

                $this->addFlash("username déja utilisé déso","warning");
                return $this->redirect("?type=security&action=register");
            }

            $user = new User();
            $user->setUsername($username);
            $user->setPassword($unencryptedPassword);

            $userRepository->save($user);

            $this->addFlash("compte bien créé bienvenue $username" ,"success");
            return $this->redirect();


        }


        return $this->render("user/register", [
            "pageTitle"=> "Nouveau compte"
        ]);
    }

    public function signIn():Response
    {
        $username = null;
        $unencryptedPassword = null;
        if(!empty($_POST['username'])) {
            $username = $_POST['username'];
        }
        if(!empty($_POST['password'])) {
            $unencryptedPassword = $_POST['password'];
        }

        if($username && $unencryptedPassword) {
            $userRepository = new UserRepository();

            $user = $userRepository->findByUsername($username);

            if (!$user) {

                $this->addFlash("username inconnu", "danger");
                return $this->redirect("?type=security&action=signIn");
            }

            if(!$user->logIn($unencryptedPassword))
            {
                $this->addFlash("mauvais mot de passe, ".$user->getUsername(), "danger");
                return $this->redirect("?type=security&action=signIn");
            }


            $this->addFlash("Bienvenue ".$user->getUsername() ,"success");
            return $this->redirect("?type=album&action=index");

        }

        return $this->render("user/login", [
            "pageTitle"=> "Connexion"
        ]);
    }

    public function signOut():Response
    {
        Session::remove("user");
        $this->addFlash("bien déconnecté, à bientôt !", "secondary");
        return $this->redirect("?type=album&action=index");
    }
}