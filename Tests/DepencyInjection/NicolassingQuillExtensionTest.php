<?php

namespace Nicolassing\QuillBundle\Tests\DependencyInjection;

use Nicolassing\QuillBundle\DependencyInjection\NicolassingQuillExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;

/**
 * @author Nicolas Assing <nicolas.assing@gmail.com>
 */
class NicolassingQuillExtensionTest extends TestCase
{
    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testLoadThrowsExceptionUnlessThemeSet()
    {
        $loader = new NicolassingQuillExtension();
        $config = $this->getFullConfig();
        unset($config['theme']);
        $loader->load(array($config), new ContainerBuilder());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testLoadThrowsExceptionUnlessHeightSet()
    {
        $loader = new NicolassingQuillExtension();
        $config = $this->getFullConfig();
        unset($config['height']);
        $loader->load(array($config), new ContainerBuilder());
    }

    public function testLoadConfig()
    {
        $configuration = new ContainerBuilder();
        $loader = new NicolassingQuillExtension();
        $config = $this->getFullConfig();
        $loader->load(array($config), $configuration);

        $this->assertTrue($configuration->hasParameter('nicolassing_quill.config'));
        $this->assertEquals(['theme' => 'snow', 'height' => '10rem'], $configuration->getParameter('nicolassing_quill.config'));
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
