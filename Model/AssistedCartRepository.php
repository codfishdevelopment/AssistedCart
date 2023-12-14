<?php
/**
 * Copyright © Codfish Development. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Codfish\AssistedCart\Model;

use Codfish\AssistedCart\Api\AssistedCartRepositoryInterface;
use Codfish\AssistedCart\Api\Data\AssistedCartInterface;
use Codfish\AssistedCart\Model\ResourceModel\AssistedCart as AssistedCartResource;
use Exception;
use Magento\Checkout\Model\Session;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Psr\Log\LoggerInterface;

class AssistedCartRepository implements AssistedCartRepositoryInterface
{

    private AssistedCartFactory $assistedCart;
    private AssistedCartResource $assistedCartResource;
    private Session $cartSession;
    private LoggerInterface $logger;

    public function __construct(
        AssistedCartFactory $assistedCart,
        AssistedCartResource $assistedCartResource,
        Session $cartSession,
        LoggerInterface $logger
    ) {
        $this->assistedCart = $assistedCart;
        $this->assistedCartResource = $assistedCartResource;
        $this->cartSession = $cartSession;
        $this->logger = $logger;
    }


    /**
     * @inheritDoc
     */
    public function get(int $assistedCartId): AssistedCartInterface
    {
        $assistedCart = $this->assistedCart->create();
        $this->assistedCartResource->load($assistedCart, $assistedCartId);

        if (!$assistedCart->getId()) {
            throw New NoSuchEntityException(
                __(
                    'An Assisted Cart with the Assisted Cart ID %1 could not be found.',
                    $assistedCartId
                )
            );
        }

        return $assistedCart;
    }

    /**
     * @inheritDoc
     */
    public function getBySharableId(string $sharableId): AssistedCartInterface
    {
        $assistedCart = $this->assistedCart->create();
        $this->assistedCartResource->load($assistedCart, $sharableId, AssistedCartInterface::SHARABLE_ID);

        if (!$assistedCart->getId()) {
            throw New NoSuchEntityException(
                __(
                    'An Assisted Cart with the Sharable ID %1 could not be found.',
                    $sharableId
                )
            );
        }

        return $assistedCart;
    }

    /**
     * @inheritDoc
     */
    public function getByCustomerId(int $customerId): AssistedCartInterface
    {
        $assistedCart = $this->assistedCart->create();
        $this->assistedCartResource->load($assistedCart, $customerId, AssistedCartInterface::CUSTOMER_ID);

        if (!$assistedCart->getId()) {
            throw New NoSuchEntityException(
                __(
                    'An Assisted Cart with the Customer ID %1 could not be found.',
                    $customerId
                )
            );
        }

        return $assistedCart;
    }

    /**
     * @inheritDoc
     */
    public function getByQuoteId(int $quoteId)
    {
        $assistedCart = $this->assistedCart->create();
        $this->assistedCartResource->load($assistedCart, $quoteId, AssistedCartInterface::QUOTE_ID);

        if (!$assistedCart->getId()) {
            return false;
        }

        return $assistedCart;
    }

    /**
     * @inheritDoc
     */
    public function getSharableIdByCartSession(): string
    {
        $cart = $this->cartSession->getQuote();
        try {
            if ($quoteId = $cart->getId()) {
                $assistedCart = $this->getByQuoteId($quoteId);
                return $assistedCart->getSharableId();
            } else {
                return '';
            }
        } catch (Exception $exception) {
            /* There was an error, return null so no sharable ID is presented, and page doesn't break. Log error.*/
            $this->logger->error(__('There was an error getting the sharable id with the quote id %1', $cart->getId()));
            return '';
        }
    }

    /**
     * @inheritDoc
     */
    public function save(AssistedCartInterface $assistedCart): void
    {
        try {
            $this->assistedCartResource->save($assistedCart);
        } catch (AlreadyExistsException $exception) {
            throw new AlreadyExistsException(
                __(
                    'This sharable ID has already been used: %1' ,
                    $exception->getMessage()
                )
            );
        } catch (Exception $exception) {
            throw new Exception(
                __(
                    'There was an error saving this Assisted Cart: %1' ,
                    $exception->getMessage()
                )
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(AssistedCartInterface $assistedCart): void
    {
        try {
            $this->assistedCartResource->delete($assistedCart);
        } catch (StateException $exception) {
            throw new StateException(
                __(
                    'Cannot delete category with id %1',
                    $assistedCart->getId()
                ),
                $exception
            );
        }

    }
}
