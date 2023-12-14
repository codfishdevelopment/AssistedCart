<?php
/**
 * Copyright © Codfish Development. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Codfish\AssistedCart\Model\ResourceModel;

class AssistedCart extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('codfish_assisted_cart', 'assisted_cart_id');
    }

}
