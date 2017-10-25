<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Amazonpay\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Shared\Amazonpay\AmazonpayConfig;
use SprykerEco\Zed\Amazonpay\AmazonpayDependencyProvider;
use SprykerEco\Zed\Amazonpay\Business\Api\Adapter\AdapterFactory;
use SprykerEco\Zed\Amazonpay\Business\Api\Converter\ConverterFactory;
use SprykerEco\Zed\Amazonpay\Business\Converter\AmazonpayConverter;
use SprykerEco\Zed\Amazonpay\Business\Converter\AmazonpayTransferToEntityConverter;
use SprykerEco\Zed\Amazonpay\Business\Order\RefundOrderModel;
use SprykerEco\Zed\Amazonpay\Business\Order\Saver;
use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Ipn\IpnFactory;
use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLogger;
use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\TransactionFactory;
use SprykerEco\Zed\Amazonpay\Business\Quote\QuoteUpdateFactory;

/**
 * @method \SprykerEco\Zed\Amazonpay\Persistence\AmazonpayQueryContainer getQueryContainer()
 */
class AmazonpayBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\TransactionFactoryInterface
     */
    public function createTransactionFactory()
    {
        return new TransactionFactory(
            $this->createAdapterFactory(),
            $this->createAmazonpayConfig(),
            $this->createTransactionLogger(),
            $this->getQueryContainer(),
            $this->createAmazonpayConverter(),
            $this->createAmazonpayTransferToEntityConverter(),
            $this->createRefundOrderModel()
        );
    }

    /**
     * @return \SprykerEco\Shared\Amazonpay\AmazonpayConfigInterface
     */
    public function createAmazonpayConfig()
    {
        return new AmazonpayConfig();
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Quote\QuoteUpdateFactoryInterface
     */
    public function createQuoteUpdateFactory()
    {
        return new QuoteUpdateFactory(
            $this->createAdapterFactory(),
            $this->getShipmentFacade(),
            $this->getMessengerFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Ipn\IpnFactoryInterface
     */
    public function createIpnFactory()
    {
        return new IpnFactory(
            $this->getOmsFacade(),
            $this->getQueryContainer(),
            $this->getUtilEncodingService(),
            $this->createRefundOrderModel()
        );
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Dependency\Facade\AmazonpayToRefundInterface
     */
    public function getRefundFacade()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_REFUND);
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface
     */
    protected function getMoneyFacade()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_MONEY);
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Dependency\Facade\AmazonpayToOmsInterface
     */
    protected function getOmsFacade()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_OMS);
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Dependency\Facade\AmazonpayToShipmentInterface
     */
    protected function getShipmentFacade()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::FACADE_SHIPMENT);
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Dependency\Facade\AmazonpayToUtilEncodingInterface
     */
    protected function getUtilEncodingService()
    {
        return $this->getProvidedDependency(AmazonpayDependencyProvider::SERVICE_UTIL_ENCODING);
    }

   /**
    * @return \SprykerEco\Zed\Amazonpay\Business\Api\Adapter\AdapterFactoryInterface
    */
    public function createAdapterFactory()
    {
        return new AdapterFactory(
            $this->createAmazonpayConfig(),
            $this->createConverterFactory(),
            $this->getMoneyFacade()
        );
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Api\Converter\ConverterFactoryInterface
     */
    protected function createConverterFactory()
    {
        return new ConverterFactory();
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Order\SaverInterface
     */
    public function createOrderSaver()
    {
        return new Saver();
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLoggerInterface
     */
    public function createTransactionLogger()
    {
        return new TransactionLogger($this->createAmazonpayConfig()->getErrorReportLevel());
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Dependency\Facade\AmazonpayToSalesInterface
     */
    public function getSalesFacade()
    {
        return $this->getProvidedDependency(
            AmazonpayDependencyProvider::FACADE_SALES
        );
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Dependency\Facade\AmazonpayToMessengerInterface
     */
    protected function getMessengerFacade()
    {
        return $this->getProvidedDependency(
            AmazonpayDependencyProvider::FACADE_MESSENGER
        );
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Converter\AmazonpayConverterInterface
     */
    protected function createAmazonpayConverter()
    {
        return new AmazonpayConverter();
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Converter\AmazonpayTransferToEntityConverterInterface
     */
    protected function createAmazonpayTransferToEntityConverter()
    {
        return new AmazonpayTransferToEntityConverter();
    }

    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Order\RefundOrderInterface
     */
    protected function createRefundOrderModel()
    {
        return new RefundOrderModel($this->getRefundFacade());
    }
}
