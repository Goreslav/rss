<?php
namespace App\Controller;
use App\Entity\Feeds;
use Feed;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class FeedController extends AbstractController
{
    // ... other methods remain same ...

    protected function fetchFeedById($id): Feeds
    {
        $entityManager = $this->getDoctrine()->getManager();
        $feed = $entityManager->getRepository(Feeds::class)->find($id);

        if (!$feed) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        return $feed;
    }

    protected function ensureUrlIsValid($url)
    {
        $sanitizedUrl = filter_var($url, FILTER_SANITIZE_URL);

        if (!filter_var($sanitizedUrl, FILTER_VALIDATE_URL)) {
            throw new \RuntimeException('URL provided is not valid.');
        }

        return $sanitizedUrl;
    }

    public function editAction(Request $request): RedirectResponse
    {
        if ($request->request !== null) {
            $formData = $request->request;
            $id = $formData->get('id');
            $decision = $formData->get('decision');

            $feed = $this->fetchFeedById($id);

            // ... rest of the code ...
        } else {
            return $this->redirectToRoute('all_feeds',[]);
        }
    }

    public function changeAction(Request $request): Response
    {
        if ($request->request->get('id') !== null) {
            $formData = $request->request;
            $id = $formData->get('id');
            $link = $formData->get('link');
            $name = $formData->get('name');

            $feed = $this->fetchFeedById($id);

            $feed->setName($name);
            $feed->setLink($this->ensureUrlIsValid($link));

            // ... rest of the code ...
        }

        return $this->redirectToRoute('all_feeds');
    }
}
