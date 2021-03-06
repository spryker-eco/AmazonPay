<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AmazonPay\Persistence;

use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface AmazonPayQueryContainerInterface extends QueryContainerInterface
{
    /**
     * @api
     *
     * @param string $orderReferenceId
     *
     * @return \Orm\Zed\AmazonPay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByOrderReferenceId($orderReferenceId);

    /**
     * @api
     *
     * @param string $authorizationReferenceId
     *
     * @return \Orm\Zed\AmazonPay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByAuthorizationReferenceId($authorizationReferenceId);

    /**
     * @api
     *
     * @param string $captureReferenceId
     *
     * @return \Orm\Zed\AmazonPay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByCaptureReferenceId($captureReferenceId);

    /**
     * @api
     *
     * @param string $refundReferenceId
     *
     * @return \Orm\Zed\AmazonPay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function queryPaymentByRefundReferenceId($refundReferenceId);

    /**
     * @api
     *
     * @param string $authorizationReferenceId
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $excludeItems
     *
     * @return \Orm\Zed\AmazonPay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function querySalesOrderItemsByPaymentReferenceId($authorizationReferenceId, array $excludeItems);

    /**
     * @api
     *
     * @param int $salesOrderItemId
     *
     * @return \Orm\Zed\AmazonPay\Persistence\SpyPaymentAmazonpayQuery
     */
    public function queryPaymentBySalesOrderItemId($salesOrderItemId);

    /**
     * @api
     *
     * @param int $salesOrderItemId
     *
     * @return \Orm\Zed\AmazonPay\Persistence\SpyPaymentAmazonpaySalesOrderItemQuery
     */
    public function queryBySalesOrderItemId($salesOrderItemId);
}
