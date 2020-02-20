# NicolassingQuillBundle

This bundle integrate [quilljs](https://quilljs.com/docs) in your Symfony project.

## Installation ##

Add the `nicolassing/quill-bundle` package to your `require` section in the `composer.json` file.

``` bash
$ composer require nicolassing/quill-bundle
```

## Usage ##

Configure `quill` client(s) in your `config/packages/nicolassing_quill.yaml`:

``` yaml
nicolassing_quill:
    theme: snow
    height: 10rem
```

There is 2 themes available
* snow (default)
* bubble

Add a quill widget into your form
``` php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Nicolassing\QuillBundle\Form\Type\QuillType;
use Symfony\Component\Form\FormBuilderInterface;

class FooType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bar', QuillType::class)
        ;
    }
}
```

Add javascript and stylesheet in your twig template
``` twig
<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

{{ form_row(form.bar) }}

<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="bundles/nicolassingquill/js/nicolassing_quill.js"></scriptt>
```
