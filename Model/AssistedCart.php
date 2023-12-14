<?php
/**
 * Copyright © Codfish Development. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Codfish\AssistedCart\Model;

/**
 * @method \Codfish\AssistedCart\Model\ResourceModel\AssistedCart getResource()
 * @method \Codfish\AssistedCart\Model\ResourceModel\AssistedCart\Collection getCollection()
 */
class AssistedCart extends \Magento\Framework\Model\AbstractModel implements \Codfish\AssistedCart\Api\Data\AssistedCartInterface,
    \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'codfish_assistedcart_assistedcart';
    protected $_cacheTag = 'codfish_assistedcart_assistedcart';
    protected $_eventPrefix = 'codfish_assistedcart_assistedcart';

    protected function _construct()
    {
        $this->_init('Codfish\AssistedCart\Model\ResourceModel\AssistedCart');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @inheritDoc
     */
    public function setAssistedCartId(int $assistedCartId): void
    {
        $this->setData(self::ASSISTED_CART_ID, $assistedCartId);
    }

    /**
     * @inheritDoc
     */
    public function setSharableId(string $sharableId): void
    {
        $this->setData(self::SHARABLE_ID, $sharableId);
    }

    /**
     * @inheritDoc
     */
    public function setIsLoggedIn(bool $isLoggedIn): void
    {
        $this->setData(self::IS_LOGGED_IN, $isLoggedIn);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerId(int $customerId): void
    {
        $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @inheritDoc
     */
    public function setQuoteId(int $quoteId): void
    {
        $this->setData(self::QUOTE_ID, $quoteId);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * @inheritDoc
     */
    public function getAssistedCartId(): int
    {
        return $this->getData(self::ASSISTED_CART_ID);
    }

    /**
     * @inheritDoc
     */
    public function getSharableId(): string
    {
        return $this->getData(self::SHARABLE_ID);
    }

    /**
     * @inheritDoc
     */
    public function getIsLoggedIn(): bool
    {
        return $this->getData(self::IS_LOGGED_IN);
    }

    /**
     * @inheritDoc
     */
    public function getCustomerId(): int
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function getQuoteId(): int
    {
        return $this->getData(self::QUOTE_ID);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }
}
