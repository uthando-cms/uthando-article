<?php

namespace UthandoArticle;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getControllerConfig()
    {
        return include __DIR__ . '/config/controller.config.php';
    }

    public function getFormElementConfig()
    {
        return include __DIR__ . '/config/formElement.config.php';
    }

    public function getHydratorConfig()
    {
        return include __DIR__ . '/config/hydrator.config.php';
    }

    public function getInputFilterConfig()
    {
        return include __DIR__ . '/config/inputFilter.config.php';
    }
    
    public function getServiceConfig()
    {
        return include __DIR__ . '/config/service.config.php';
    }

    public function getUthandoMapperConfig()
    {
        return include __DIR__ . '/config/mapper.config.php';
    }

    public function getUthandoModelConfig()
    {
        return include __DIR__ . '/config/model.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/autoload_classmap.php'
            ],
        ];
    }
}
