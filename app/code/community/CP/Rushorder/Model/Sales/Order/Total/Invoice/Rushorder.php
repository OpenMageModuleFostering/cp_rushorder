<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Commerce Pundit Technologies
 * @package     CP_Rushorder
 * @copyright   Copyright (c) 2016 Commerce Pundit Technologies. (http://www.commercepundit.com)    
 * @author      <<Niranjan Gondaliya>>    
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class CP_Rushorder_Model_Sales_Order_Total_Invoice_Rushorder extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{

    /**
     * Collect invoice total
     *
     * @param Mage_Sales_Model_Order_Invoice $invoice
     * @return CP_Rushorder_Model_Sales_Order_Total_Invoice_Rushorder
     */
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        $order = $invoice->getOrder();

        $rushorderAmountLeft = $order->getRushorderAmount() - $order->getRushorderAmountInvoiced();
        $baseRushorderAmountLeft = $order->getBaseRushorderAmount() - $order->getBaseRushorderAmountInvoiced();

        if (abs($baseRushorderAmountLeft) < $invoice->getBaseGrandTotal()) {
            $invoice->setGrandTotal($invoice->getGrandTotal() + $rushorderAmountLeft);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $baseRushorderAmountLeft);
        } else {
            $rushorderAmountLeft = $invoice->getGrandTotal() * -1;
            $baseRushorderAmountLeft = $invoice->getBaseGrandTotal() * -1;

            $invoice->setGrandTotal(0);
            $invoice->setBaseGrandTotal(0);
        }

        $invoice->setRushorderAmount($rushorderAmountLeft);
        $invoice->setBaseRushorderAmount($baseRushorderAmountLeft);

        return $this;
    }

}
