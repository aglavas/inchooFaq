<?php
/**
 * Created by PhpStorm.
 * User: andrija
 * Date: 12/4/17
 * Time: 10:13 AM
 */

namespace Inchoo\Faq\Block\Tab;


class Faq extends \Magento\Framework\View\Element\Template
{
    /**
     * Get FAQ title
     */
    public function getTitle()
    {
        echo __("Frequently asked questions");
    }


}