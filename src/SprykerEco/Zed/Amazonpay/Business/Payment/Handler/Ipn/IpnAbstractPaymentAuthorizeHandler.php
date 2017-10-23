<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use SprykerEco\Shared\Amazonpay\AmazonpayConstants;

abstract class IpnAbstractPaymentAuthorizeHandler extends IpnAbstractTransferRequestHandler
{

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer | \Generated\Shared\Transfer\AmazonpayIpnPaymentAuthorizeRequestTransfer $amazonpayIpnPaymentAuthorizeRequestTransfer
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay|null
     */
    protected function retrievePaymentEntity(AbstractTransfer $amazonpayIpnPaymentAuthorizeRequestTransfer)
    {
        return $this->amazonpayQueryContainer->queryPaymentByAuthorizationReferenceId(
            $amazonpayIpnPaymentAuthorizeRequestTransfer->getAuthorizationDetails()->getAuthorizationReferenceId()
        )->findOne();
    }

    /**
     * @return string
     */
    protected function getOmsEventId()
    {
        return AmazonpayConstants::OMS_EVENT_UPDATE_AUTH_STATUS;
    }

}
