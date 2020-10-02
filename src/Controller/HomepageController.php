<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomepageController extends AbstractController
{



    public function __construct()
    {

    }

    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function indexAction(): Response
    {

        $message = '';
        $username = '';
        $loginMessage = '';

        if (!empty($_GET['last_username'])) {
            $username = $_GET['last_username'];

        }
        if (!empty( $_GET['error'])) {
            $loginMessage = $_GET['error'];
        }

        if (!empty($_GET['message'])) {
            $message= $_GET['message'];
        }

        return $this->render('homepage/index.html.twig',
            [
                'last_username' => $username,
                'error' => $loginMessage,
                'message'=> $message
            ]);
    }
}
