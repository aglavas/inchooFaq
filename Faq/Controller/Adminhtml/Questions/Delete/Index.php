<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Inchoo\Faq\Controller\Adminhtml\Questions\Delete;

use Inchoo\Faq\Api\FaqRepositoryInterfaceFactory;
use Inchoo\Faq\Controller\Adminhtml\Base\Controller;
use Inchoo\Faq\Model\Faq;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

class Index extends Controller
{
    /**
     * @var FaqRepositoryInterfaceFactory
     */
    private $faqRepositoryFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param FaqRepositoryInterfaceFactory $faqRepositoryInterfaceFactory
     */
    public function __construct
    (
        Context $context,
        FaqRepositoryInterfaceFactory $faqRepositoryInterfaceFactory
    )
    {
        $this->faqRepositoryFactory = $faqRepositoryInterfaceFactory;
        parent::__construct($context);
    }

    /**
     * @return Redirect
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if($id)
        {
            $faqRepository = $this->faqRepositoryFactory->create();
            try {
                /** @var Faq $faq */
                $faq = $faqRepository->getById($id);

                if (!$faq->getId()) {
                    throw new NoSuchEntityException(__('Question with id "%1" does not exist.', $id));
                }

                $faqRepository->delete($faq);

                $this->messageManager->addSuccessMessage(__('The question  has been deleted.'));

            } catch (CouldNotDeleteException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }

            return $resultRedirect->setPath('*/questions');

        }

        $this->messageManager->addSuccessMessage(__('Bad request.'));
        return $resultRedirect->setPath('*/questions')->setHttpResponseCode(400);
    }

}
