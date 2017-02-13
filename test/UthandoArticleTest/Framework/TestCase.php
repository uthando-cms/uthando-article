<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoArticleTest\Framework
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE.txt
 */

namespace UthandoArticleTest\Framework;

use UthandoArticleTest\Bootstrap;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;

    protected function setUp()
    {
        ini_set('error_reporting', E_ALL ^ E_USER_DEPRECATED);
        Bootstrap::init();
        $this->serviceManager = Bootstrap::getServiceManager();
    }

    /**
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    protected function getGuestUser()
    {
        /* @var $auth \UthandoUser\Service\Authentication */
        $auth = $this->getServiceManager()
            ->get('Zend\Authentication\AuthenticationService');
        $auth->clear();
    }

    protected function getAdminUser()
    {
        /* @var $auth \UthandoUser\Service\Authentication */
        $auth = $this->getServiceManager()
            ->get('Zend\Authentication\AuthenticationService');
        $user = new User();

        $user->setFirstname('Joe')
            ->setLastname('Bloggs')
            ->setEmail('email@example.com')
            ->setRole('admin')
            ->setDateCreated(new \DateTime())
            ->setDateModified(new \DateTime());
        $auth->getStorage()->write($user);
        return $user;
    }

    protected function getRegisteredUser()
    {
        /* @var $auth \UthandoUser\Service\Authentication */
        $auth = $this->getServiceManager()
            ->get('Zend\Authentication\AuthenticationService');
        $user = new User();

        $user->setFirstname('Joe')
            ->setLastname('Bloggs')
            ->setEmail('email@example.com')
            ->setRole('registered')
            ->setDateCreated(new \DateTime())
            ->setDateModified(new \DateTime());
        $auth->getStorage()->write($user);
        return $user;
    }
}