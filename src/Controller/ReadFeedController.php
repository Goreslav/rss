<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReadFeedController extends FeedController
{
    /**
     * @Route("/feed/read/", name="read_feed")
     * @param Request $request
     * @return Response
     */
    public function FeedDetailAction(Request $request): Response
    {
        if ($request->query->all() !== [])
        {
            $url = $request->query->all()['url'];
            $checked = filter_var($url, FILTER_SANITIZE_URL);
            if (!filter_var($checked, FILTER_VALIDATE_URL)) {
                $this->redirectToRoute('all_feeds');
            }
            $feedData = $this->parseRssFeed($url);

            if (!empty($feedData))
            return $this->render('read_feed/index.html.twig', [
                'links'=>$this->feedNavLinks(),
                'feedData' => $feedData,
            ]);
        } else {
            (
            $this->redirectToRoute('all_feeds')
            );
        }
        return $this->redirectToRoute('all_feeds');
    }
}
