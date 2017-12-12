<?php

namespace Inchoo\Faq\Model\ResourceModel\Faq;

use Magento\Catalog\Model\Product\Attribute\Repository;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var Repository
     */
    private $attributeRepository;

    /**
     * Collection constructor.
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param Repository $repository
     * @param \Magento\Framework\DB\Adapter\AdapterInterface|null $connection
     * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb|null $resource
     */
    public function __construct
    (
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        Repository $repository,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null

    )
    {
        $this->attributeRepository = $repository;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

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
        $attribute = $this->attributeRepository->get('name');

        $this->getSelect()->joinLeft(
            ['product_table' => $this->getTable('catalog_product_entity_varchar')],
            "main_table.product_id = product_table.entity_id AND product_table.store_id = 0",['product_name' => 'product_table.value']
        )->where('product_table.attribute_id = ?', $attribute->getAttributeId());

        return $this;
    }
}
