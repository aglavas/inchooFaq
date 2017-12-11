<?php

namespace Inchoo\Faq\Model\ViewModel;

use Magento\Framework\Data\OptionSourceInterface;

class Faq extends  \Inchoo\Faq\Model\Faq implements OptionSourceInterface
{
    /**
     * Return product name
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->getData('product_name');
    }

    /**
     * Return product URL
     *
     * @return string
     */
    public function getProductUrl()
    {
        return $this->getData('target_path');
    }

    /**
     * Return select element attributes
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => '0', 'label' => __('No')],
            ['value' => '1', 'label' => __('Yes')]
        ];
    }

}