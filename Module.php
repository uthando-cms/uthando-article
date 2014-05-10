<?php

namespace UthandoArticle;

class Module
{
	public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/autoload_classmap.php'
            ],
        ];
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getControllerConfig()
    {
    	return [
        	'invokables' => [
        		'UthandoArticle\Controller\Article' => 'UthandoArticle\Controller\ArticleController',
        	],
        ];
    }
    
    public function getServiceConfig()
    {
    	return [
            'invokables' => [
                'UthandoArticle\InputFilter\Article'    => 'UthandoArticle\InputFilter\Article',
                'UthandoArticle\Mapper\Article'         => 'UthandoArticle\Mapper\Article',
                'UthandoArticle\Service\Article'        => 'UthandoArticle\Service\Article'
            ]
        ];
    }
}
