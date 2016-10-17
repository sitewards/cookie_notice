<?php

class Sitewards_CookieNotice_Block_Html_CookieNotice extends Mage_Page_Block_Html_CookieNotice
{
    /**
     * Get content for cookie restriction block
     *  - extends Mage_Page_Block_Html_CookieNotice::getCookieRestrictionBlockContent to set store id
     *
     * @return string
     */
    public function getCookieRestrictionBlockContent()
    {
        $blockIdentifier = Mage::helper('core/cookie')->getCookieRestrictionNoticeCmsBlockIdentifier();
        /** @var Mage_Cms_Model_Block $block */
        $block = Mage::getModel('cms/block');
        $block->setStoreId(Mage::app()->getStore()->getId());
        $block->load($blockIdentifier, 'identifier');

        $html = '';
        if ($block->getIsActive()) {
            /* @var $helper Mage_Cms_Helper_Data */
            $helper = Mage::helper('cms');
            $processor = $helper->getBlockTemplateProcessor();
            $html = $processor->filter($block->getContent());
        }

        return $html;
    }
}