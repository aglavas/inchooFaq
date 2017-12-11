<?php

namespace Inchoo\Faq\Controller\Questions;

use Inchoo\Faq\Controller\Base\Controller;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;

class Index extends Controller
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;


    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        Session $session
    ) {

        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        parent::__construct($context, $session);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $questionId = $this->_request->getParam('id');
        $this->registry->register('userId', $this->userId);
        $this->registry->register('questionId', $questionId);
        return $this->renderMyQuestionsPage($this->resultPageFactory, 'faq.questions.index' );
    }
}
