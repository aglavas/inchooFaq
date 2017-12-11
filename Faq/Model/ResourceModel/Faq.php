<?php

namespace Inchoo\Faq\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Faq extends AbstractDb
{
    /**
     * Initialize news Resource
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('inchoo_faq', 'id');
    }

    /**
     * Add product name and product URL to load
     *
     * @param string $field
     * @param mixed $value
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return \Magento\Framework\DB\Select
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);

        $select->joinLeft(
            ['product_table' => $this->getTable('catalog_product_entity_varchar')],
            "inchoo_faq.product_id = product_table.entity_id",
            ['product_name' => 'product_table.value'])->where('attribute_id', 126);

        $select->joinLeft(
            ['url_table' => $this->getTable('url_rewrite')],
            "inchoo_faq.product_id = url_table.entity_id",
            ['url_table.target_path']);

        return $select;
    }
}
