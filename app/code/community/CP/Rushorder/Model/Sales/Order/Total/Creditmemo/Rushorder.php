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
 
class CP_Rushorder_Model_Sales_Order_Total_Creditmemo_Rushorder extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{

    /**
     * Collect credit memo total
     *
     * @param Mage_Sales_Model_Order_Creditmemo $creditmemo
     * @return CP_Rushorder_Model_Sales_Order_Total_Creditmemo_Rushorder
     */
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {
        $order = $creditmemo->getOrder();

        if($order->getRushorderAmountInvoiced() > 0) {

            $rushorderAmountLeft = $order->getRushorderAmountInvoiced() - $order->getRushorderAmountRefunded();
            $baserushorderAmountLeft = $order->getBaseRushorderAmountInvoiced() - $order->getBaseRushorderAmountRefunded();

            if ($baserushorderAmountLeft > 0) {
                $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $rushorderAmountLeft);
                $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baserushorderAmountLeft);
                $creditmemo->setRushorderAmount($rushorderAmountLeft);
                $creditmemo->setBaseRushorderAmount($baserushorderAmountLeft);
            }

        } else {

            $rushorderAmount = $order->getRushorderAmountInvoiced();
            $baserushorderAmount = $order->getBaseRushorderAmountInvoiced();

            $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $rushorderAmount);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baserushorderAmount);
            $creditmemo->setRushorderAmount($rushorderAmount);
            $creditmemo->setBaseRushorderAmount($baserushorderAmount);

        }

        return $this;
    }

}
