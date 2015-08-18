<?php
namespace Omeka\Controller\Site;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PageController extends AbstractActionController
{
    public function showAction()
    {
        $siteResponse = $this->api()->read('sites', array(
            'slug' => $this->params('site-slug')
        ));
        $site = $siteResponse->getContent();
        $siteId = $site->id();

        $pageResponse = $this->api()->read('site_pages', array(
            'slug' => $this->params('page-slug'),
            'site' => $siteId
        ));
        $page = $pageResponse->getContent();

        $view = new ViewModel;
        $view->setVariable('site', $site);
        $view->setVariable('page', $page);
        return $view;
    }

    public function browseAction()
    {
        $siteResponse = $this->api()->read('sites', array(
            'slug' => $this->params('site-slug')
        ));
        $site = $siteResponse->getContent();

        $view = new ViewModel;
        $view->setVariable('site', $site);
        return $view;
    }
}