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
 
class CP_Rushorder_Model_Sales_Quote_Address_Total_Rushorder extends Mage_Sales_Model_Quote_Address_Total_Abstract
{

    protected $_code = 'rushorder';

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);

        $this->_setAmount(0);
        $this->_setBaseAmount(0);

        $items = $this->_getAddressItems($address);
        if (!count($items)) {
            return $this;
        }

        $quote = $address->getQuote();
		if(Mage::getSingleton('core/session')->getRushorderapply() == 'rapply') {
			
			if (CP_Rushorder_Model_Rushorder::canApply($address)) {
				$exist_amount = $quote->getRushorderAmount();
				$rushorder = CP_Rushorder_Model_Rushorder::getRushorder();
				$balance = $rushorder - $exist_amount;

				$address->setRushorderAmount($balance);
				$address->setBaseRushorderAmount($balance);

				$quote->setRushorderAmount($balance);

				$address->setGrandTotal($address->getGrandTotal() + $address->getRushorderAmount());
				$address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getBaseRushorderAmount());
			}
		
		}

        return $this;
    }

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        $amount = $address->getRushorderAmount();
		if(Mage::getSingleton('core/session')->getRushorderapply() == 'rapply') {
			$address->addTotal(array(
				'code' => $this->getCode(),
				'title' => Mage::getStoreConfig('rushorder/configuration/title'),
				'value' => $amount
			));
		}
        return $this;
    }

}