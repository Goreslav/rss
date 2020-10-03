<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FeedController extends AbstractController
{

    /**
     * @Route("/feed", name="feed")
     */

    public function index()
    {
        return $this->render('feed/index.html.twig', [
            'links' => $this->feedNavLinks()
        ]);
    }

    /**
     * @return array
     */
    protected function feedNavLinks():array
    {
        return [
            'oblubene' => 'favorite_feeds',
            'vsetky' => 'all_feeds'
        ];
    }
}
