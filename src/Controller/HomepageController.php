<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomepageController extends AbstractController
{

    /**
     * @var string
     */
    private $text= '';

    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function indexAction(): Response
    {
        $this->text= 'Candy canes marzipan chocolate cake gummies jelly-o.';


        return $this->render('homepage/index.html.twig',
            [
                'text'=> $this->duplicateText(10)
            ]);
    }

    /**
     * @param int $count
     * @return array
     */
    private function duplicateText(int $count): array
    {
        $result = [];
        for ($x = 0; $x <= $count; $x++) {
            $result[]= $this->text;
        }
        return $result;
    }
}
