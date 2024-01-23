<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function indexAction(): Response
    {
        $message = $this->createMessage();

        return $this->render('homepage/index.html.twig', [
            'text' => $this->duplicateMessage($message, 10)
        ]);
    }

    /**
     * Prepare a message string
     *
     * @return string
     */
    private function createMessage(): string
    {
        return 'Candy canes marzipan chocolate cake gummies jelly-o.';
    }

    /**
     * @param string $message
     * @param int $count
     * @return array
     */
    private function duplicateMessage(string $message, int $count): array
    {
        $result = [];
        for ($x = 0; $x <= $count; $x++) {
            $result[] = $message;
        }
        return $result;
    }
}
