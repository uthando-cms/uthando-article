<?php

namespace UthandoArticle\Form;

use Zend\Form\Form;

class Article extends Form
{
    public function init()
    {
        $elementArray = include __DIR__ . '/articleFieldElements.php';

        foreach ($elementArray as $name => $spec) {
            $spec['name'] = $name;
            $this->add($spec);
        }
    }
}
