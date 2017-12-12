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
use Magento\Customer\Model\Session;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;

class ListBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @var CollectionFactory
     */
    private $faqCollectionFactory;

    /**
     * @var Session
     */
    private $customerSession;

    /**
     * @var Registry
     */
    private $registry;

    /**
     * ListBlock constructor.
     * @param Context $context
     * @param array $data
     * @param CollectionFactory $collectionFactory
     * @param Session $session
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        array $data = [],
        CollectionFactory $collectionFactory,
        Session $session,
        Registry $registry
    ) {
        $this->faqCollectionFactory = $collectionFactory;
        $this->customerSession = $session;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }


    /**
     * Return single url
     *
     * @return string
     */
    public function getSingleUrl($id)
    {
        return $this->getUrl('faq/questions/index/', ['id' => $id]);
    }

    /**
     * Return user's questions
     *
     * @return Collection
     */
    public function getQuestions()
    {
        $userId = $this->customerSession->getId();
        /** @var Collection $faqCollection */
        $faqCollection = $this->faqCollectionFactory->create();
        $faqCollection->addProductInfo();
        $faqCollection->addFieldToFilter('user_id', $userId);
        $faqCollection->addFieldToFilter('webview_id', $this->_storeManager->getStore()->getId()); //73,126

        return $faqCollection;
    }

}