<?php

namespace Inchoo\Faq\Controller\Adminhtml\Base;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

abstract class Controller extends Action
{
    /**
     * Controller constructor.
     * @param Context $context
     */
    public function __construct
    (
        Context $context
    )
    {
        parent::__construct($context);
    }

    /**
     * ACL method
     *
     * @return bool
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Inchoo_Faq::questions');
    }


    /**
     * Render admin question page
     *
     * @param $title
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function renderMyQuestionsAdminPage($title)
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Inchoo_Faq::questions');
        $resultPage->getConfig()->getTitle()->prepend(__($title));

        return $resultPage;
    }
}
