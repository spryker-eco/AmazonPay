<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AmazonPay\Business\Api\Converter\Ipn;

use Generated\Shared\Transfer\AmazonpayIpnRequestMessageTransfer;
use SprykerEco\Zed\AmazonPay\Business\Api\Converter\AbstractConverter;

abstract class IpnPaymentAbstractRequestConverter extends AbstractConverter implements IpnConverterInterface
{
    /**
     * @param array $request
     *
     * @return \Generated\Shared\Transfer\AmazonpayIpnRequestMessageTransfer
     */
    protected function extractMessage(array $request)
    {
        $ipnRequestMessageTransfer = new AmazonpayIpnRequestMessageTransfer();
        $ipnRequestMessageTransfer->fromArray($request, true);

        return $ipnRequestMessageTransfer;
    }
}
