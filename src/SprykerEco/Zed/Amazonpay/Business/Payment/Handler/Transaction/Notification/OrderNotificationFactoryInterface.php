<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

interface OrderNotificationFactoryInterface
{
    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\AmazonpayTransactionInterface
     */
    public function createOrderAuthFailedTransaction();
}
