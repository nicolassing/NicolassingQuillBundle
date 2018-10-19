<?php

namespace Nicolassing\QuillBundle\Tests\Form\Type;

use Nicolassing\QuillBundle\Form\Type\QuillType;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * @author Nicolas Assing <nicolas.assing@gmail.com>
 */
class QuillTypeTest extends TypeTestCase
{
    private $config;

    protected function setUp()
    {
        $this->config = ['theme' => 'snow', 'height' => '10rem'];

        parent::setUp();
    }

    protected function getExtensions()
    {
        $type = new QuillType($this->config);

        return array(new PreloadedExtension(array($type), array()));
    }

    public function testSubmitValidData()
    {
        $formData = '<p>bar</p>';
        $form = $this->factory->create(QuillType::class, '<p>foo</p>');
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals('<p>bar</p>', $form->getData());
    }

    public function testSubmitNull()
    {
        $formData = null;
        $form = $this->factory->create(QuillType::class, '<p>foo</p>');
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals(null, $form->getData());
    }
}
