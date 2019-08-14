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
 
class CP_Rushorder_Block_Sales_Order_Rushorder extends Mage_Core_Block_Template
{

    /**
     * Get order store object
     *
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        return $this->getParentBlock()->getOrder();
    }

    /**
     * Get totals source object
     *
     * @return Mage_Sales_Model_Order
     */
    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }

    /**
     * Initialize rushorder totals
     *
     * @return CP_Rushorder_Block_Sales_Order_Rushorder
     */
    public function initTotals()
    {
		if(Mage::getSingleton('core/session')->getRushorderapply() == 'rapply') { 
		
			if ((float) $this->getOrder()->getBaseRushorderAmount()) {
				$source = $this->getSource();
				$value  = $source->getRushorderAmount();

				$this->getParentBlock()->addTotal(new Varien_Object(array(
					'code'   => 'rushorder',
					'strong' => false,
					'label'  => Mage::getStoreConfig('rushorder/configuration/title'),
					'value'  => $value
				)));
			}
		}

        return $this;
    }
}