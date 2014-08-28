<?php

namespace Netgen\HybridApproachBundle\Components\SearchCriteriaBuilder;

use Netgen\SearchAndFilterBundle\Components\SearchCriteriaBuilder;
use Symfony\Component\Form\Form;

class LegacyFilterCriteriaBuilder implements SearchCriteriaBuilder {

    /**
     * Builds search criteria
     *
     * @return criteria array
     */
    public function build( Form $form, $offset, $length, $params = array() )
    {
        $data = $form->getData();

    }
}