<?php
/**
 * Created by PhpStorm.
 * User: andrija
 * Date: 12/4/17
 * Time: 10:13 AM
 */

namespace Inchoo\Faq\Block\Tab;


use Inchoo\Faq\Model\ResourceModel\Faq\Collection;
use Inchoo\Faq\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

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
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * ListBlock constructor.
     * @param Template\Context $context
     * @param array $data
     * @param CollectionFactory $collectionFactory
     * @param Registry $registry
     */
    public function __construct(
        Template\Context $context,
        array $data = [],
        CollectionFactory $collectionFactory,
        Registry $registry
    )
    {
        $this->faqCollectionFactory = $collectionFactory;
        $this->registry = $registry;
        $this->storeManager = $context->getStoreManager();
        parent::__construct($context, $data);
    }

    /**
     * Returns title
     */
    public function getTitle()
    {
        return __("Previous questions: ");
    }

    /**
     * Returns published questions
     *
     * @return Collection
     */
    public function getPublishedQuestions()
    {
        /** @var Collection $faqCollection */
        $faqCollection = $this->faqCollectionFactory->create();
        $webViewId = $this->storeManager->getStore()->getId();
        $faqCollection->addFieldToFilter('product_id', $this->getProductId());
        $faqCollection->addFieldToFilter('show_on_faq', 1);
        $faqCollection->addFieldToFilter('webview_id', $webViewId); //73,126

        return $faqCollection;
    }

    /**
     * Get review product id
     *
     * @return int
     */
    protected function getProductId()
    {
        return $this->getRequest()->getParam('id', false);
    }

}