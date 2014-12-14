<?php
namespace UthandoArticle\InputFilter;

use Zend\InputFilter\InputFilter;

class Article extends InputFilter
{
    public function init()
    {
        $elementArray = include __DIR__ . '/articleInputFilterElements.php';

        foreach ($elementArray as $name => $spec) {
            $spec['name'] = $name;
            $this->add($spec);
        }
    }
}
