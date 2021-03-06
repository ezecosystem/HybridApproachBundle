<?php

namespace Netgen\HybridApproachBundle\Components\SearchResultConverter;

use eZ\Publish\API\Repository\Repository;
use Netgen\SearchAndFilterBundle\Components\SearchAndFilterHit;
use Netgen\SearchAndFilterBundle\Components\SearchResultConverter;
use eZ\Publish\API\Repository\Values\Content\Search\SearchResult;
//use eZ\Publish\API\Repository\Values\Content\Search\SearchHit;

class LegacyFilterResultConverter implements SearchResultConverter {

    /**
     * @var \eZ\Publish\API\Repository\Repository
     */
    protected $repository;

    /**
     * Constructor
     */
    public function __construct( Repository $repository )
    {
        $this->repository = $repository;
    }

    /**
     * Builds search result
     */
    public function convert( $input )
    {
        $result = new SearchResult(
            array(
                'time'       => 0,
                'maxScore'   => 0,
                'totalCount' => sizeof($input),
            )
        );

        $contentService = $this->repository->getContentService();

        foreach ( $input as $doc )
        {
            $contentObject = $contentService->loadContent( $doc->ContentObjectID );
            $searchHit = new SearchAndFilterHit(
                array(
                    'score'         => 0,
                    'valueObject'   => $contentObject,
                    'objectStates'  => $this->loadContentObjectStates($contentObject)
                )
            );
            $result->searchHits[] = $searchHit;
        }

        return $result;
    }

    private function loadContentObjectStates( $contentObject )
    {
        $objectStateService = $this->repository->getObjectStateService();
        $objectStateGroups = $objectStateService->loadObjectStateGroups();
        $objectStatesArray = array();
        $stripedObjectStatesGroupArray = array('ez_lock');

        foreach ( $objectStateGroups as $objectStateGroup )
        {
            if ( !in_array( $objectStateGroup->identifier, $stripedObjectStatesGroupArray ) )
            {
                $objectStatesArray[$objectStateGroup->identifier] = $objectStateService
                    ->getContentState( $contentObject, $objectStateGroup );
            }
        }

        return count($objectStatesArray) ? $objectStatesArray : null ;
    }
}