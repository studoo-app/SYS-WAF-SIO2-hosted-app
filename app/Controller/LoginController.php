<?php

namespace Controller;

use Repository\UserRepository;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\View\TwigCore;

class LoginController implements ControllerInterface
{

    public function execute(Request $request): string|null
	{

        $email = null;
        $password = null;
        $errors = null;

        if($request->getHttpMethod() === "POST"){
            $email = $_POST["email"] ?? null;
            $password = $_POST["password"] ?? null;

            if($email && $password && $email !== "" && $password !== "" ){
                $service = new UserRepository();
                $user = $service->authenticate($email, $password);
                if($user){
                    $_SESSION["user"] = $user->getEmail();
                    header('Location: /users');
                }else{
                    $errors = "Adresse email ou mot de passe erronnée.";
                }
            }else{
                $errors = "Les champs ne peuvent pas être vides.";
            }
        }



		return TwigCore::getEnvironment()->render('login/login.html.twig',
            [
                "email"=>$email,
                "password"=>$password,
                "errors"=>$errors
            ]
		);
	}
}
