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

        return array(
            'parent_node_id' => 75,
            'extended_attribute_filter' =>
                array(
                    'id' => 'PriceAttributeFilter',
                    'params' => array( 'price' => $data['price'] )
                ),
            'sort_by' => array('attribute', true, 'product/price'));
    }
}