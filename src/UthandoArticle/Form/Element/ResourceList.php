<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoNavigation\Model
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @link      https://github.com/uthando-cms for the canonical source repository
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoArticle\Form\Element;

use UthandoUser\Form\Element\AbstractResourceList;

/**
 * Class ResourceList
 * @package UthandoArticle\Model
 */
class ResourceList extends AbstractResourceList
{
    protected $resource = 'article';

    protected $emptyOption = null;
}
