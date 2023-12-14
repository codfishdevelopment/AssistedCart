<?php
/**
 * Copyright © Codfish Development. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Codfish\AssistedCart\Model\ResourceModel\AssistedCart;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'assisted_cart_id';


    protected function _construct()
    {
        $this->_init('Codfish\AssistedCart\Model\AssistedCart', 'Codfish\AssistedCart\Model\ResourceModel\AssistedCart');
    }

}
