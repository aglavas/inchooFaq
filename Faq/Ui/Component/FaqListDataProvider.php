<?php

namespace Inchoo\Faq\Ui\Component;

use Inchoo\Faq\Model\ResourceModel\Faq\Collection;
use Inchoo\Faq\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Catalog\Model\Product\Attribute\RepositoryFactory;

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
        /** @var Collection $collection */
        $collection = $this->getCollection();
        $data = $collection->addProductInfo()->toArray();

        return $data;
    }
}