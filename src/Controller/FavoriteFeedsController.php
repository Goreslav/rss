<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;

class FavoriteFeedsController extends FeedController
{
    /**
     * @Route("/feed/favorite/", name="favorite_feeds")
     */
    public function index()
    {
        return $this->render('favorite_feeds/index.html.twig', [
            'links' => $this->feedNavLinks()
        ]);
    }
}
