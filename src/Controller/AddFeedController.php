<?php
namespace App\Controller;
use App\Entity\Feeds;
use App\Form\FeedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddFeedController extends FeedController
{
    /**
     * @Route("/feed/add/", name="add_feed")
     * @param Request $request
     * @return Response
     */
    public function addFeedAction(Request $request): Response
    {
        $feedDetails = $this->getFeedDetails($request);
        $form = $this->createForm(FeedType::class, new Feeds());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->processFormSubmission($form);
        }

        return $this->render('add_feed/index.html.twig', array_merge(
            $feedDetails,
            ['form' => $form->createView()]
        ));
    }

    private function getFeedDetails(Request $request): array
    {
        $formData = $request->query;
        $id = $formData->all()['id'] ?? '';
        $name = '';
        $link = '';

        $feed = $this->findFeed($id);
        if ($feed) {
            $name = $feed->getName();
            $link = $feed->getLink();
        }

        return [
            'id' => $id,
            'name' => $name,
            'link' => $link,
            'links' => $this->feedNavLinks()
        ];
    }

    private function findFeed(string $id): ?Feeds
    {
        if (empty($id)) {
            return null;
        }

        $entityManager = $this->getDoctrine()->getManager();
        return $entityManager->getRepository(Feeds::class)->find($id);
    }

    private function processFormSubmission(FormInterface $form): void
    {
        $feed = $form->getData();
        $this->validateUrl($feed->getLink());
        $feed->setUserId($this->getUser()->getId());

        $em = $this->getDoctrine()->getManager();
        $em->persist($feed);
        $em->flush();

        $this->addFlash('success', 'link pridany');
        $this->redirect('add_feed');
    }
}