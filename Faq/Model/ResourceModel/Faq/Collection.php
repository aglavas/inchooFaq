<?php

namespace Inchoo\Faq\Model\ResourceModel\Faq;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Initialize news Collection
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Inchoo\Faq\Model\ViewModel\Faq::class,
            \Inchoo\Faq\Model\ResourceModel\Faq::class
        );
    }

    /**
     * Add product info to collection
     *
     * @return $this
     */
    public function addProductInfo()
    {
        $this->getSelect()->joinLeft(
            ['product_table' => $this->getTable('catalog_product_entity_varchar')],
            "main_table.product_id = product_table.entity_id",['product_name' => 'product_table.value']
        );

        return $this;
    }
}
