<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Amazonpay\Communication\Plugin\Oms\Condition;

use SprykerEco\Shared\Amazonpay\AmazonpayConfig;

class IsCancelNotAllowedConditionPlugin extends AbstractByOrderConditionPlugin
{
    /**
     * @return array
     */
    protected function getStatuses()
    {
        return [
            AmazonpayConfig::OMS_STATUS_CAPTURE_COMPLETED,
            AmazonpayConfig::OMS_STATUS_CAPTURE_PENDING,
        ];
    }
}
