<?php

namespace App\Controller;

use Feed;
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
            'vsetky' => 'all_feeds',
            'pridaj' => 'add_feed'
        ];
    }
    protected function parseRssFeed($url): array {
        $result =[];
        try {
            $rss = Feed::loadRss($url);
            $result =$rss->toArray();
            return $result;
        } catch (\FeedException $e) {
        }
        return $result;
    }

    /**
     * @param $url
     * @return mixed
     * @throws \Exception
     */
    protected function validateUrl($url)
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \RuntimeException('');
        }
    }

//    protected function getFeedData(string $urlsArray) {
//        $result= [];
//        try {
//            foreach ($urlsArray as $url) {
//                $result[]= $this->parseRssFeed($url);
//            }
//            return $result;
//        } catch (\RuntimeException $e) {
//        }
//       return $result;
//    }
}
