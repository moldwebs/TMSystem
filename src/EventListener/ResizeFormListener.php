<?php


namespace App\EventListener;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ResizeFormListener implements EventSubscriberInterface
{

    protected $type;
    protected $items;
    protected $options;

    private $deleteEmpty;
    private $emptyItems = [];

    public function setConf(string $type, array $items = [], array $options = [], $deleteEmpty = false)
    {
        $this->type = $type;
        $this->items = $items;
        $this->options = $options;
        $this->deleteEmpty = $deleteEmpty;
    }

    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit',
            FormEvents::SUBMIT => ['onSubmit', 50],
        ];
    }

    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        if (null === $data) {
            $data = [];
        }

        foreach ($form as $name => $child) {
            $form->remove($name);
        }

        $newData = [];
        foreach ($this->items as $name => $value) {
            $options = array_merge_recursive($this->options, [
                'label' => false,
                'row_attr' => ['label' => $value],
                'property_path' => '['.$name.']',
            ]);
            $form->add($name, $this->type, $options);

            foreach ($data as $item) {
                if($item->{"get" . (new \ReflectionClass($value))->getShortName()}() == $value)
                    $newData[$name] = $item;
            }

        }

        $event->setData($newData);
    }

    public function preSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        foreach ($form as $name => $child) {

            $isEmpty = method_exists($child->getData(),'isEmpty') ? $child->getData()->isEmpty() : $child->isEmpty();

            if ($isEmpty) {
                $form->remove($name);
            }

        }
    }

    public function onSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        foreach ($form as $name => $child) {

            $isEmpty = method_exists($child->getData(),'isEmpty') ? $child->getData()->isEmpty() : $child->isEmpty();

            if ($isEmpty) {
                unset($data[$name]);
                $form->remove($name);
            }
        }

        $event->setData($data);
    }

}
