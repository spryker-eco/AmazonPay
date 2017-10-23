<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\Amazonpay\Business;

use SprykerEcoTest\Zed\Amazonpay\Business\Mock\Adapter\Sdk\AbstractResponse;
use Generated\Shared\Transfer\AmazonpayCallTransfer;
use SprykerEco\Shared\Amazonpay\AmazonpayConstants;

class AmazonpayFacadeUpdateAuthorizationStatusTest extends AmazonpayFacadeAbstractTest
{

    /**
     * @dataProvider updateAuthStatusDataProvider
     *
     * @param \Generated\Shared\Transfer\AmazonpayCallTransfer $amazonpayCallTransfer
     * @param string $expectedStatus
     *
     * @return void
     */
    public function testUpdateAuthStatus(AmazonpayCallTransfer $amazonpayCallTransfer, $expectedStatus)
    {
        $result = $this->createFacade()->updateAuthorizationStatus($amazonpayCallTransfer);
        $this->validateResult($result, $expectedStatus);
    }

    /**
     * @return array
     */
    public function updateAuthStatusDataProvider()
    {
        $this->prepareFixtures();

        return [
            [
                $this->getAmazonpayCallTransferByOrderReferenceId(AbstractResponse::ORDER_REFERENCE_ID_1),
                AmazonpayConstants::OMS_STATUS_AUTH_OPEN,
            ],
            [
                $this->getAmazonpayCallTransferByOrderReferenceId(AbstractResponse::ORDER_REFERENCE_ID_2),
                AmazonpayConstants::OMS_STATUS_AUTH_CLOSED,
            ],
            [
                $this->getAmazonpayCallTransferByOrderReferenceId(AbstractResponse::ORDER_REFERENCE_ID_3),
                AmazonpayConstants::OMS_STATUS_AUTH_SUSPENDED,
            ],
        ];
    }

}
