<?php

/*
 * This file is part of the FOSUserBundle package.
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

    protected function setUp(): void
    {
        $this->config = ['theme' => 'snow', 'height' => '10rem'];

        parent::setUp();
    }

    public function testSubmitValidData()
    {
        $formData = '<p>bar</p>';
        $form = $this->factory->create(QuillType::class, '<p>foo</p>');
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertSame('<p>bar</p>', $form->getData());
    }

    public function testSubmitNull()
    {
        $formData = null;
        $form = $this->factory->create(QuillType::class, '<p>foo</p>');
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertNull($form->getData());
    }

    protected function getExtensions()
    {
        $type = new QuillType($this->config);

        return [new PreloadedExtension([$type], [])];
    }
}
