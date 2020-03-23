<?php


namespace App\Controller;

use App\Entity\User;
use App\Message\Execute;
use App\Message\Notification;
use App\Traits\Controller\EntityManagerTrait;
use App\Traits\Controller\RequestTrait;

use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AppController
{
    use EntityManagerTrait, RequestTrait;

    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        $body = 'OK';

        return $this->render('frontend/index.html.twig', [
            'body' => $body
        ]);
    }

    /**
     * @Route("/makesome", name="makesome")
     */
    public function makesome(MessageBusInterface $bus)
    {

        $filename = uniqid() . '.docx';
        $action = "Convert file {$filename} to pdf";

        sleep(2);

        $bus->dispatch(new Notification(json_encode([
            'action' => 'dialog',
            'message' => $action
        ])));

        $result = $bus->dispatch(new Execute($filename, new Notification(json_encode([
            'action' => 'dialog',
            'message' => $action . ' ' . 'Ready'
        ]))));

        return $this->render('frontend/index.html.twig', [
            'body' => 'SEND ACTION TO QUEUE'
        ]);
    }

    /**
     * @Route("/demologin", name="demologin")
     */
    public function demologin()
    {

        $user = $this->em->getRepository(User::class)->findOneBy(['username' => 'admin@mail.com']);

        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->get('security.token_storage')->setToken($token);

        // If the firewall name is not main, then the set value would be instead:
        // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
        $this->get('session')->set('_security_main', serialize($token));

        // Fire the login event manually
        $event = new InteractiveLoginEvent($this->request, $token);
        $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

        return $this->redirectToRoute('backend');
    }
}