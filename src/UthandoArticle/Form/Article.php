<?php

namespace UthandoArticle\Form;

use Zend\Form\Form;

class Article extends Form
{
	public function __construct()
	{
		parent::__construct('Article');
		
		$this->add([
			'name' => 'articleId',
			'type' => 'hidden',
		]);
		
		$this->add([
		    'name' => 'title',
		    'type' => 'text',
		    'options' => [
				'label'     => 'Title:',
				'required'  => true,
			],
			'attributes' => [
			    'placeholder' => 'Article Title:',
			],
		]);
		
		$this->add([
		    'name' => 'slug',
		    'type' => 'text',
		    'options' => [
		        'label'       => 'Slug:',
		        'required'    => false,
		    	'help-inline' => 'If you leave this blank the the title will be used for the slug.'
		    ],
		    'attributes' => [
		        'placeholder' => 'Slug:',
		    ],
		]);
		
		$this->add([
		    'name' => 'content',
		    'type' => 'textarea',
		    'options' => [
		        'label' => 'HTML Content:'
		    ],
		    'attributes' => [
		        'placeholder' => 'HTML Content:',
		        'class'       => 'editable-textarea',
		    	'id'          => 'article-content-textarea',
                'rows'        => 25,
		    ],
		]);
		
		$this->add([
		    'name' => 'description',
		    'type' => 'text',
		    'options' => [
				'label' => 'Description:',
			],
			'attributes' => [
			    'placeholder' => 'Description:',
			],
		]);
		
		$this->add([
			'name' => 'pageHits',
			'type' => 'hidden',
		]);
	}
}
