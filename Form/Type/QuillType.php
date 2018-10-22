<?php

namespace Nicolassing\QuillBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Nicolas Assing <nicolas.assing@gmail.com>
 */
class QuillType extends AbstractType
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['theme'] = $options['theme'];
        $view->vars['height'] = $options['height'];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'theme' => $this->config['theme'],
                'height' => $this->config['height']
            )
        );
    }

    public function getParent()
    {
        return TextareaType::class;
    }
}
