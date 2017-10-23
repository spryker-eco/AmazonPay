<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\Amazonpay;

use Spryker\Client\Kernel\AbstractFactory;
use SprykerEco\Client\Amazonpay\Zed\AmazonpayStub;

class AmazonpayFactory extends AbstractFactory
{

    /**
     * @return \SprykerEco\Client\Amazonpay\Zed\AmazonpayStubInterface
     */
    public function createZedStub()
    {
        return new AmazonpayStub($this->getProvidedDependency(AmazonpayDependencyProvider::CLIENT_ZED_REQUEST));
    }

}
