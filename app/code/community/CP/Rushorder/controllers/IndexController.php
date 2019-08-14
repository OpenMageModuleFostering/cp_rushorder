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
 
class CP_Rushorder_IndexController extends Mage_Core_Controller_Front_Action
{
  public function applyrushorderAction()
   {
	   if (isset($_POST['applyrushorder'])) {
		   
			if (isset($_POST['rushorderapply'])) {
				Mage::getSingleton('core/session')->setRushorderapply('rapply');
				Mage::getSingleton('core/session')->addSuccess('Rush order has been apply.');
			} else {
				Mage::getSingleton('core/session')->addSuccess(Mage::helper('fee')->__('Please select checkbox before apply rush order.'));
			}
		   
	   } else {
		   
		   // Reset button event
		   Mage::getSingleton('core/session')->setRushorderapply('');
		   Mage::getSingleton('core/session')->addSuccess('Rush order has been reset.');
	   }
		$this->_redirectUrl(Mage::helper('checkout/cart')->getCartUrl());
   }
}