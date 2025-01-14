<?php

namespace Controller;

use Repository\UserRepository;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\View\TwigCore;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class UsersController implements ControllerInterface
{

    private ?string $search;

    public function __construct()
    {
        $this->search = null;
    }


	public function execute(Request $request): string|null
	{
        if(!isset($_SESSION["user"])){
            header("Location: /");
        }

        if($request->getHttpMethod() === "GET" && isset($_GET["search"])){
            $this->search = $_GET["search"];
        }

        $users = [];
        if($this->search){
            $ur = new UserRepository();
            $users = $ur->search($this->search);
        }

		return TwigCore::getEnvironment()->render('users/users.html.twig',
            [
                "users"=>$users,
                "search"=>$this->search
            ]
		);
	}
}
