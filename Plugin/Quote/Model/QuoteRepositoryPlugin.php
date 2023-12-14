<?php
/**
 * Copyright © Codfish Development. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Codfish\AssistedCart\Plugin\Quote\Model;

use Codfish\AssistedCart\Api\AssistedCartRepositoryInterface;
use Codfish\AssistedCart\Model\AssistedCartFactory;
use Exception;
use Magento\Framework\DataObject\IdentityService;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Model\QuoteRepository;
use Psr\Log\LoggerInterface;

class QuoteRepositoryPlugin
{
    private AssistedCartRepositoryInterface $assistedCartRepository;
    private AssistedCartFactory $assistedCartFactory;
    private IdentityService $identityService;
    private LoggerInterface $logger;

    public function __construct(
        AssistedCartRepositoryInterface $assistedCartRepository,
        AssistedCartFactory $assistedCartFactory,
        IdentityService $identityService,
        LoggerInterface $logger
    ) {
        $this->assistedCartRepository = $assistedCartRepository;
        $this->assistedCartFactory = $assistedCartFactory;
        $this->identityService = $identityService;
        $this->logger = $logger;
    }


    /**
     * Upon saving quote create Assisted Cart with UUID Sharable ID if it doesn't already exist.
     *
     * @param QuoteRepository $subject
     * @param $result
     * @param CartInterface $quote
     * @return mixed
     */
    public function afterSave(\Magento\Quote\Model\QuoteRepository $subject, $result, CartInterface $quote)
    {
        try {
            if ($quoteId = $quote->getId()) {
                $assistedCart = $this->assistedCartFactory->create();

                if ($this->assistedCartRepository->getByQuoteId($quoteId)) {
                    $assistedCart = $this->assistedCartRepository->getByQuoteId($quoteId);
                } else {
                    $assistedCart->setQuoteId($quoteId);
                }

                if (!$assistedCart->getSharableId()) {
                    $sharableId = $this->generateSharableId();
                    $assistedCart->setSharableId($sharableId);
                }

                if ($customerId = $quote->getCustomer()->getId() && !$assistedCart->getCustomerId()) {
                    $assistedCart->setCustomerId($customerId);
                    $assistedCart->setIsLoggedIn(true);
                }

                if (!$quote->getCustomer()->getId()) {
                    $assistedCart->setIsLoggedIn(false);
                }

                $this->assistedCartRepository->save($assistedCart);
            }
        } catch(Exception $exception) {
            /** Avoid breaking the frontend over an error here, just log it */
            $this->logger->error(
                __('There was a problem creating an Assisted Cart for the Quote ID %1', $quote->getId())
            );
        }

        return $result;
    }

    /**
     * Generates a sharable UUID for
     *
     * @return string
     */
    private function generateSharableId(): string
    {
        return $this->identityService->generateId();
    }
}
