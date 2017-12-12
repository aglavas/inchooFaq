<?php

namespace Inchoo\Faq\Controller\Questions;

use Inchoo\Faq\Controller\Base\Controller;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class ListAction extends Controller
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * ListAction constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Session $session
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Session $session
    ) {

        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $session);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->renderMyQuestionsPage($this->resultPageFactory, 'faq.questions.list' );
    }
}
