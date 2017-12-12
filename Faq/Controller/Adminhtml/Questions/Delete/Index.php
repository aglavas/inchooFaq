<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Inchoo\Faq\Controller\Adminhtml\Questions\Delete;

use Inchoo\Faq\Api\FaqRepositoryInterface;
use Inchoo\Faq\Controller\Adminhtml\Base\Controller;
use Inchoo\Faq\Model\Faq;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

class Index extends Controller
{
    /**
     * @var FaqRepositoryInterface
     */
    private $faqRepository;


    /**
     * Index constructor.
     * @param Context $context
     * @param FaqRepositoryInterface $faqRepositoryInterface
     */
    public function __construct
    (
        Context $context,
        FaqRepositoryInterface $faqRepositoryInterface
    )
    {
        $this->faqRepository = $faqRepositoryInterface;
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
            try {
                /** @var Faq $faq */
                $faq = $this->faqRepository->getById($id);

                if (!$faq->getId()) {
                    throw new NoSuchEntityException(__('Question with id "%1" does not exist.', $id));
                }

                $this->faqRepository->delete($faq);

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
