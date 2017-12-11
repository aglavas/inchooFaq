<?php
/**
 * Created by PhpStorm.
 * User: andrija
 * Date: 12/4/17
 * Time: 10:13 AM
 */

namespace Inchoo\Faq\Block\Questions;

use Inchoo\Faq\Api\FaqRepositoryInterfaceFactory;
use Inchoo\Faq\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;

class IndexBlock extends \Magento\Framework\View\Element\Template
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
     * @var FaqRepositoryInterfaceFactory
     */
    private $faqRepositoryFactory;

    /**
     * IndexBlock constructor.
     * @param Context $context
     * @param array $data
     * @param CollectionFactory $collectionFactory
     * @param Registry $registry
     * @param FaqRepositoryInterfaceFactory $faqRepositoryInterfaceFactory
     */
    public function __construct(
        Context $context,
        array $data = [],
        CollectionFactory $collectionFactory,
        Registry $registry,
        FaqRepositoryInterfaceFactory $faqRepositoryInterfaceFactory
    ) {
        $this->faqCollectionFactory = $collectionFactory;
        $this->registry = $registry;
        $this->faqRepositoryFactory = $faqRepositoryInterfaceFactory;
        parent::__construct($context, $data);
    }

    /**
     * Returns title
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTitle()
    {
        return __("Question id: ");
    }

    /**
     * Return single question data
     *
     * @return \Inchoo\Faq\Api\Data\FaqInterface
     */
    public function getQuestionData()
    {
        $questionId = $this->registry->registry('questionId');
        $faqRepository = $this->faqRepositoryFactory->create();
        $question = $faqRepository->getById($questionId);
        return $question;
    }


    /**
     * Return list url
     *
     * @return string
     */
    public function getListUrl()
    {
        return $this->getBaseUrl() . 'faq/questions/list';
    }




}