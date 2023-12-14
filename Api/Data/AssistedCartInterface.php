<?php
/**
 * Copyright © Codfish Development. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Codfish\AssistedCart\Api\Data;

interface AssistedCartInterface
{
    const ASSISTED_CART_ID = 'assisted_cart_id';
    const SHARABLE_ID = 'sharable_id';
    const IS_LOGGED_IN = 'is_logged_in';
    const CUSTOMER_ID = 'customer_id';
    const QUOTE_ID = 'quote_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * Set Assisted Cart ID (explicit setter)
     *
     * @param int $id
     * @return void
     */
    public function setAssistedCartId(int $assistedCartId): void;

    /**
     * Set Sharable ID (UUID format)
     *
     * @param string $sharableId
     * @return void
     */
    public function setSharableId(string $sharableId): void;

    /**
     * Set is Logged In
     *
     * @param bool $isLoggedIn
     * @return void
     */
    public function setIsLoggedIn(bool $isLoggedIn): void;

    /**
     * Set Customer ID
     *
     * @param int $customerId
     * @return void
     */
    public function setCustomerId(int $customerId): void;

    /**
     * Set Quote ID
     *
     * @param int $quoteId
     * @return void
     */
    public function setQuoteId(int $quoteId): void;

    /**
     * Set Created At
     *
     * @param string $createdAt
     * @return void
     */
    public function setCreatedAt(string $createdAt): void;

    /**
     * Set Updated At
     *
     * @param string $updatedAt
     * @return void
     */
    public function setUpdatedAt(string $updatedAt): void;

    /**
     * Get Assisted Cart ID (Explicitly)
     *
     * @return int
     */
    public function getAssistedCartId(): int;

    /**
     * Get sharable ID (UUID format)
     *
     * @return string
     */
    public function getSharableId(): string;

    /**
     * Get Is Logged In
     *
     * @return bool
     */
    public function getIsLoggedIn(): bool;

    /**
     * Get Customer ID
     *
     * @return int
     */
    public function getCustomerId(): int;

    /**
     * Get Quote ID
     *
     * @return int
     */
    public function getQuoteId(): int;

    /**
     * Get Created At
     *
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * Get Updated At
     *
     * @return string
     */
    public function getUpdatedAt(): string;
}
