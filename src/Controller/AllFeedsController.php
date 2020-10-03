<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AllFeedsController extends FeedController
{
    /**
     * @Route("/feed/all/", name="all_feeds")
     */
    public function index()
    {
        return $this->render('all_feeds/index.html.twig', [
            'links' => $this->feedNavLinks(),
        ]);
    }
}
