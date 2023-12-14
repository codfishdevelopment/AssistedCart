<?php
/**
 * Copyright © Codfish Development. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Codfish\AssistedCart\Api;

use Codfish\AssistedCart\Api\Data\AssistedCartInterface;
use Exception;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;

interface AssistedCartRepositoryInterface
{
    /**
     * Get Assisted Cart By ID
     *
     * @param int $assistedCartId
     * @return AssistedCartInterface
     * @throws NoSuchEntityException
     */
    public function get(int $assistedCartId): AssistedCartInterface;

    /**
     * Get by Sharable ID
     *
     * @param string $sharableId
     * @return AssistedCartInterface
     * @throws NoSuchEntityException
     */
    public function getBySharableId(string $sharableId): AssistedCartInterface;

    /**
     * Get By Customer ID
     *
     * @param int $customerId
     * @return AssistedCartInterface
     * @throws NoSuchEntityException
     */
    public function getByCustomerId(int $customerId): AssistedCartInterface;

    /**
     * Get By Quote ID
     *
     * @param int $quoteId
     * @return AssistedCartInterface|bool
     */
    public function getByQuoteId(int $quoteId);

    /**
     * Get Sharable ID By Cart Session
     *
     * @return string
     */
    public function getSharableIdByCartSession(): string;

    /**
     * Save Assisted Cart
     *
     * @param AssistedCartInterface $assistedCart
     * @return void
     * @throws AlreadyExistsException
     * @throws Exception
     */
    public function save(AssistedCartInterface $assistedCart): void;

    /**
     * Delete by Assisted Cart ID
     *
     * @param AssistedCartInterface $assistedCart
     * @return void
     * @throws StateException
     */
    public function delete(AssistedCartInterface $assistedCart): void;
}
