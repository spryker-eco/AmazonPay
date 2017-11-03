<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\AmazonPay\Dependency\Client;

interface AmazonPayToCustomerInterface
{
    /**
     * Gets current logged in customer.
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getCustomer();
}