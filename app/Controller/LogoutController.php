<?php

namespace Controller;

use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\View\TwigCore;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class LogoutController implements ControllerInterface
{
    public function execute(Request $request): string
    {
        if(isset($_SESSION["user"])){
            session_unset();
            session_destroy();
        }
        header('Location: /');
        return "";
    }
}
