<?php

namespace Inchoo\Faq\Ui\Component;

use Inchoo\Faq\Model\ResourceModel\Faq\CollectionFactory;

class FaqListDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * FaqListDataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collection = $collectionFactory->create();
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        /**
         * This is just a hack-around to use one DataProvider for both grid and form,
         * it's probably really bad idea
         */
        $data = $this->getCollection()
            ->addProductInfo()
            ->addFieldToFilter('product_table.attribute_id', 73)
            ->toArray();

        return $data;
    }
}