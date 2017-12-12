<?php

namespace Inchoo\Faq\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Catalog\Model\Product\Attribute\Repository;

class Faq extends AbstractDb
{
    /**
     * @var
     */
    private $attributeRepository;

    /**
     * Faq constructor.
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param null $connectionName
     * @param Repository $repository
     */
    public function __construct
    (
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        Repository $repository
    )
    {
        $this->attributeRepository = $repository;
        parent::__construct($context);
    }

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

        $attribute = $this->attributeRepository->get('name');

        $select->joinLeft(
            ['product_table' => $this->getTable('catalog_product_entity_varchar')],
            "inchoo_faq.product_id = product_table.entity_id AND product_table.store_id = 0",['product_name' => 'product_table.value']
        )->where('product_table.attribute_id = ?', $attribute->getAttributeId());

        $select->joinLeft(
            ['url_table' => $this->getTable('url_rewrite')],
            "inchoo_faq.product_id = url_table.entity_id",
            ['url_table.target_path']);

        return $select;
    }
}
