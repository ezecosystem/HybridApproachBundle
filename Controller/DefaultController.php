<?php

namespace Netgen\HybridApproachBundle\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Netgen\SearchAndFilterBundle\Components\SearchAdapter;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Pagerfanta\Pagerfanta;

class DefaultController extends Controller
{
    public function getCreditsAction( )
    {

    }

    public function getChildrenAction($locationId)
    {
        $locationService = $this->getRepository()->getLocationService();
        $parent = $locationService->loadLocation($locationId);
        $childLocationList = $locationService->loadLocationChildren( $parent, $offset = 0, $limit = -1 );

        return $this->render('NetgenHybridApproachBundle:Default:children.html.twig', array(
            'children' => $childLocationList
        ));
    }
}
