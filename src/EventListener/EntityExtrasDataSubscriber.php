<?php


namespace App\EventListener;


use App\Annotation\ExtrasData;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\HttpFoundation\RequestStack;

class EntityExtrasDataSubscriber implements EventSubscriber
{

    /**
     * @var Reader
     */
    private $reader;
    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(Reader $reader, RequestStack $requestStack)
    {

        $this->reader = $reader;
        $this->requestStack = $requestStack;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->populateData($args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->populateData($args);
    }

    public function populateData(LifecycleEventArgs $args)
    {
        $requestData = $this->requestStack->getCurrentRequest()->request->get('driver');

        $object = $args->getObject();
        $refl = new \ReflectionClass(get_class($object));
        foreach ($refl->getProperties() as $property) {
            if ($extrasDataAnnotation = $this->reader->getPropertyAnnotation($property, ExtrasData::class)) {
                $extrasData = [];
                if (!empty($extrasDataAnnotation->fields)) {
                    foreach ($extrasDataAnnotation->fields as $field) {
                        $extrasData[$field] = $requestData[$field] ?? null;
                    }
                }
                $object->{$extrasDataAnnotation->setter}($extrasData);
            }
        }
    }

}