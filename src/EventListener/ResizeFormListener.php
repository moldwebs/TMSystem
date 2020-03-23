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

        foreach ($this->items as $name => $value) {
            $options = array_merge_recursive($this->options, [
                'label' => false,
                'row_attr' => ['label' => $value],
                'property_path' => '['.$name.']',
            ]);
            $form->add($name, $this->type, $options);
        }
    }

    public function preSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        foreach ($this->items as $name => $value) {
            foreach ($data[$name] as $val) {
                if (empty($val)) {
                    $form->remove($name);
                    unset($data[$name]);
                    break;
                }
            }
        }

        $event->setData($data);
    }

}