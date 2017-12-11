<?php

namespace Inchoo\Faq\Ui\Component;

class FaqDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * FaqDataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \Inchoo\Faq\Model\ResourceModel\Faq\CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        \Inchoo\Faq\Model\ResourceModel\Faq\CollectionFactory $collectionFactory,
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
        $dataObject = $this->getCollection()->getFirstItem();

        $data = [
            $dataObject->getId() => $dataObject->toArray()
        ];

        return $data;
    }
}