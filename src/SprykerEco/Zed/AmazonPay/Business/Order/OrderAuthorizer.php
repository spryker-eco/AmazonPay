<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AmazonPay\Business\Order;

use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Zed\AmazonPay\Business\Converter\AmazonPayConverterInterface;
use SprykerEco\Zed\AmazonPay\Business\Payment\Handler\Transaction\AmazonpayTransactionInterface;

class OrderAuthorizer implements OrderAuthorizerInterface
{
    /**
     * @var \SprykerEco\Zed\AmazonPay\Business\Converter\AmazonPayConverterInterface
     */
    protected $converter;

    /**
     * @var \SprykerEco\Zed\AmazonPay\Business\Payment\Handler\Transaction\AmazonpayTransactionInterface
     */
    protected $transaction;

    /**
     * @param \SprykerEco\Zed\AmazonPay\Business\Converter\AmazonPayConverterInterface $converter
     * @param \SprykerEco\Zed\AmazonPay\Business\Payment\Handler\Transaction\AmazonpayTransactionInterface $transaction
     */
    public function __construct(AmazonPayConverterInterface $converter, AmazonpayTransactionInterface $transaction)
    {
        $this->converter = $converter;
        $this->transaction = $transaction;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function authorizeOrder(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $amazonpayCallTransfer = $this->converter->mapToAmazonpayCallTransfer($quoteTransfer);
        $amazonpayCallTransfer = $this->transaction->execute($amazonpayCallTransfer);

        $quoteTransfer->fromArray($amazonpayCallTransfer->modifiedToArray(), true);

        return $quoteTransfer;
    }
}
