<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Amazonpay\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerEco\Zed\Amazonpay\AmazonpayDependencyProvider;
use SprykerEco\Zed\Amazonpay\Business\Converter\AmazonpayEntityToTransferConverter;
use SprykerEco\Zed\Amazonpay\Business\Payment\RequestAmountCalculator;

/**
 * @method \SprykerEco\Shared\Amazonpay\AmazonpayConfig getConfig()
 * @method \SprykerEco\Zed\Amazonpay\Persistence\AmazonpayQueryContainerInterface getQueryContainer()
 */
class AmazonpayCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \SprykerEco\Zed\Amazonpay\Dependency\Facade\AmazonpayToSalesInterface
     */
    public function getSalesFacade()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_SALES);
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Dependency\Facade\AmazonpayToOmsInterface
     */
    public function getOmsFacade()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_OMS);
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Dependency\Facade\AmazonpayToRefundInterface
     */
    public function getRefundFacade()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_REFUND);
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Payment\RequestAmountCalculatorInterface
     */
    public function createRequestAmountCalculator()
    {
        return new RequestAmountCalculator($this->getOmsFacade());
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Converter\AmazonpayEntityToTransferConverterInterface
     */
    public function createPaymentAmazonpayConverter()
    {
        return new AmazonpayEntityToTransferConverter();
    }
}
