<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\Amazonpay\Business\Api\Converter;

class CaptureOrderConverter extends AbstractCaptureOrderConverter
{
    /**
     * @return string
     */
    protected function getResponseType()
    {
        return 'CaptureResult';
    }
}
