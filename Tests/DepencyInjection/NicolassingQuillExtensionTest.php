<?php

/*
 * This file is part of the FOSUserBundle package.
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nicolassing\QuillBundle\Tests\DependencyInjection;

use Nicolassing\QuillBundle\DependencyInjection\NicolassingQuillExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;

/**
 * @author Nicolas Assing <nicolas.assing@gmail.com>
 */
class NicolassingQuillExtensionTest extends TestCase
{
    public function testLoadThrowsExceptionUnlessThemeSet()
    {
        $loader = new NicolassingQuillExtension();
        $config = $this->getFullConfig();
        unset($config['theme']);
        $this->expectException(InvalidConfigurationException::class);
        $loader->load([$config], new ContainerBuilder());
    }

    public function testLoadThrowsExceptionUnlessHeightSet()
    {
        $loader = new NicolassingQuillExtension();
        $config = $this->getFullConfig();
        unset($config['height']);
        $this->expectException(InvalidConfigurationException::class);
        $loader->load([$config], new ContainerBuilder());
    }

    public function testLoadConfig()
    {
        $configuration = new ContainerBuilder();
        $loader = new NicolassingQuillExtension();
        $config = $this->getFullConfig();
        $loader->load([$config], $configuration);

        $this->assertTrue($configuration->hasParameter('nicolassing_quill.config'));
        $this->assertSame(['theme' => 'snow', 'height' => '10rem'], $configuration->getParameter('nicolassing_quill.config'));
    }

    protected function getFullConfig()
    {
        $yaml = <<<EOF
theme: snow
height: 10rem
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }
}
