<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AmazonPay\Communication\Plugin\Oms\Condition;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface;

abstract class AbstractByOrderConditionPlugin implements ConditionInterface
{
    /**
     * @return array
     */
    abstract protected function getOmsStatuses();

    /**
     * @api
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function check(SpySalesOrderItem $orderItem)
    {
        foreach ($orderItem->getOrder()->getItems() as $salesOrderItem) {
            if (in_array($salesOrderItem->getState()->getName(), $this->getOmsStatuses(), true)) {
                return true;
            }
        }

        return false;
    }
}
