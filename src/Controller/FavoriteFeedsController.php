<?php

namespace App\Controller;


use App\Entity\Feeds;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteFeedsController extends FeedController
{
    /**
     * @Route("/feed/favorite/", name="favorite_feeds")
     */
    public function index()
    {
        return $this->render('favorite_feeds/index.html.twig', [
            'links' => $this->feedNavLinks(),
            'feeds'=> $this->getAllFAvoriteFeeds()
        ]);
    }

    private function getAllFAvoriteFeeds(): array
    {
        $query= $this->getDoctrine()->getRepository(Feeds::class);
        $feeds= $query->findBy(['status'=>'favorite']);

        if (empty($feeds)) {
            $this->addFlash('warning', 'ziadne linky');
        }
        return $feeds;
    }
}
