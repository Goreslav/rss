<?php

namespace App\Controller;

use App\Entity\Feeds;

use Symfony\Component\Routing\Annotation\Route;

class SearchController extends FeedController
{
    /**
     * @Route("/search", name="search")
     */
    public function index()
    {
        return $this->render('search/index.html.twig', [
            'links' => $this->feedNavLinks(),
        ]);
    }
}
