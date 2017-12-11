<?php

namespace Inchoo\Faq\Controller\Questions;

use Inchoo\Faq\Controller\Base\Controller;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;

class ListAction extends Controller
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    private $objectManager;


    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        Session $session
    ) {

        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        $this->objectManager = $context->getObjectManager();
        parent::__construct($context, $session);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $this->registry->register('userId', $this->userId);

        return $this->renderMyQuestionsPage($this->resultPageFactory, 'faq.questions.list' );
    }
}
