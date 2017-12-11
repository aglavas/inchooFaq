<?php

namespace Inchoo\Faq\Controller\Base;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\View\Result\PageFactory;

abstract class Controller extends \Magento\Framework\App\Action\Action
{
    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var
     */
    protected $userId;

    /**
     * @param Context $context
     * @param Session $customerSession
     */
    public function __construct(
        Context $context,
        Session $customerSession
    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->userId = $customerSession->getCustomer()->getId();
    }

    /**
     * Dispatch request
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws NotFoundException
     */
    public function dispatch(RequestInterface $request)
    {
        if (!$this->customerSession->authenticate()) {
            $this->_actionFlag->set('', 'no-dispatch', true);
        }
        return parent::dispatch($request);
    }


    /**
     * Render My questions page
     *
     * @param PageFactory $pageFactory
     * @param $blockName
     * @return \Magento\Framework\View\Result\Page
     */
    protected function renderMyQuestionsPage(PageFactory $pageFactory, $blockName)
    {
        $page = $pageFactory->create();
        $page->getConfig()->getTitle()->set(__('My questions'));
        $page->getLayout()->getBlock($blockName);
        $navigationBlock = $page->getLayout()->getBlock('customer_account_navigation');
        $navigationBlock->setActive('faq/questions/list');

        return $page;
    }
}
