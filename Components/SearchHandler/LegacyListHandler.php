<?php

namespace Netgen\HybridApproachBundle\Components\SearchHandler;

use Netgen\SearchAndFilterBundle\Components\SearchHandler;
use Netgen\SearchAndFilterBundle\Components\SearchCriteriaBuilder;
use Netgen\SearchAndFilterBundle\Components\SearchResultConverter;
use eZFunctionHandler;
use Symfony\Component\Form\Form;

class LegacyListHandler implements SearchHandler {

    protected $kernel;
    protected $repository;

    /**
     * Constructor
     *
     * @param  $kernel
     */
    public function __construct( $kernel, $repository )
    {
        $this->kernel = $kernel;
        $this->repository = $repository;
    }

    /**
     * Executes the search
     *
     * @return result array
     */
    public function search( Form $form, SearchCriteriaBuilder $searchCriteriaBuilder, SearchResultConverter $resultConverter, $offset, $length, $params = array() ) {

        $criteria = $searchCriteriaBuilder->build($form, $offset, $length, $params);

        $legacyKernelClosure = $this->kernel;

        $searchResults = $legacyKernelClosure()->runCallback(
            function () use ( $criteria )
            {
                return eZFunctionHandler::execute(
                    'content',
                    'list',
                    $criteria
                );
            }
        );

        return $resultConverter->convert( $searchResults );
    }


    /**
     * Return total search result count
     * @return count
     */
    public function searchCount( Form $form, SearchCriteriaBuilder $searchCriteriaBuilder, $params = array() ) {

        $criteria = $searchCriteriaBuilder->build($form, 0, 0, $params );

        $legacyKernelClosure = $this->kernel;

        $searchResults = $legacyKernelClosure()->runCallback(
            function () use ( $criteria )
            {
                return eZFunctionHandler::execute(
                    'content',
                    'list',
                    $criteria
                );
            }
        );

        return sizeof($searchResults);
    }
}