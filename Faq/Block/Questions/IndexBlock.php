<?php
/**
 * Created by PhpStorm.
 * User: andrija
 * Date: 12/4/17
 * Time: 10:13 AM
 */

namespace Inchoo\Faq\Block\Questions;

use Inchoo\Faq\Model\ViewModel\Faq;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;

class IndexBlock extends \Magento\Framework\View\Element\Template
{

    /**
     * @var Registry
     */
    private $registry;

    /**
     * IndexBlock constructor.
     * @param Context $context
     * @param array $data
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        array $data = [],
        Registry $registry
    ) {
        $this->registry = $registry;
        parent::__construct($context, $data);
    }


    /**
     * Return single question data
     *
     * @return \Inchoo\Faq\Api\Data\FaqInterface
     */
    public function getQuestionData()
    {
        $question = $this->registry->registry('question');

        return $question;
    }


    /**
     * Return list url
     *
     * @return string
     */
    public function getListUrl()
    {
        return $this->getUrl('faq/questions/list');
    }

    /**
     * Return product url
     *
     * @return string
     */
    public function getProductUrl()
    {
        /** @var Faq $question */
        $question = $this->registry->registry('question');

        return $this->getUrl($question->getProductUrl());
    }




}