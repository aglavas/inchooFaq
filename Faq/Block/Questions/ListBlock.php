<?php
/**
 * Created by PhpStorm.
 * User: andrija
 * Date: 12/4/17
 * Time: 10:13 AM
 */

namespace Inchoo\Faq\Block\Questions;

use Inchoo\Faq\Model\ResourceModel\Faq\Collection;
use Inchoo\Faq\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;

class ListBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @var CollectionFactory
     */
    private $faqCollectionFactory;

    /**
     * @var Registry
     */
    private $registry;

    /**
     * ListBlock constructor.
     * @param Context $context
     * @param array $data
     * @param CollectionFactory $collectionFactory
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        array $data = [],
        CollectionFactory $collectionFactory,
        Registry $registry
    ) {
        $this->faqCollectionFactory = $collectionFactory;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Returns title
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTitle()
    {
        return  __("My questions");
    }

    /**
     * Return single url
     *
     * @return string
     */
    public function getSingleUrl()
    {
        return $this->getBaseUrl() . 'faq/questions/index/id/';
    }

    /**
     * Return user's questions
     *
     * @return Collection
     */
    public function getQuestions()
    {
        $userId = $this->registry->registry('userId');
        /** @var Collection $faqCollection */
        $faqCollection = $this->faqCollectionFactory->create();
        $faqCollection->addProductInfo();
        $faqCollection->addFieldToFilter('product_table.attribute_id', 73);
        $faqCollection->addFieldToFilter('user_id', $userId);
        $faqCollection->addFieldToFilter('webview_id', $this->_storeManager->getStore()->getId()); //73,126

        return $faqCollection;
    }

}