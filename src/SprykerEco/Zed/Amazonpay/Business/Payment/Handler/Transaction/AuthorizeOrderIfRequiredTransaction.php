<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\AmazonpayCallTransfer;
use SprykerEco\Shared\Amazonpay\AmazonpayConstants;

class AuthorizeOrderIfRequiredTransaction extends ReauthorizeOrderTransaction
{

    /**
     * @param \Generated\Shared\Transfer\AmazonpayCallTransfer $amazonpayCallTransfer
     *
     * @return \Generated\Shared\Transfer\AmazonpayCallTransfer
     */
    public function execute(AmazonpayCallTransfer $amazonpayCallTransfer)
    {
        if ($amazonpayCallTransfer->getAmazonpayPayment()
            ->getAuthorizationDetails()
            ->getAmazonAuthorizationId()) {
            return $amazonpayCallTransfer;
        }

        if ($amazonpayCallTransfer->getAmazonpayPayment()->getCaptureDetails()
            && $amazonpayCallTransfer->getAmazonpayPayment()->getCaptureDetails()->getAmazonCaptureId()) {
            return $amazonpayCallTransfer;
        }

        $amazonpayCallTransfer = parent::execute($amazonpayCallTransfer);

        if (!$amazonpayCallTransfer->getAmazonpayPayment()->getResponseHeader()->getIsSuccess()) {
            return $amazonpayCallTransfer;
        }

        $isPartialProcessing = $this->isPartialProcessing($this->paymentEntity, $amazonpayCallTransfer);

        if ($isPartialProcessing) {
            $this->paymentEntity = $this->duplicatePaymentEntity($this->paymentEntity);
        }

        $this->paymentEntity->setStatus(AmazonpayConstants::OMS_STATUS_CAPTURE_PENDING);
        $this->paymentEntity->save();

        if ($isPartialProcessing) {
            $this->assignAmazonpayPaymentToItemsIfNew($this->paymentEntity, $amazonpayCallTransfer);
        }

        return $amazonpayCallTransfer;
    }

}
