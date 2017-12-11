<?php

namespace Inchoo\Faq\Controller\Adminhtml\Questions\Edit;

use Inchoo\Faq\Api\FaqRepositoryInterface;
use Inchoo\Faq\Api\FaqRepositoryInterfaceFactory;
use Inchoo\Faq\Controller\Adminhtml\Base\Controller;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\CouldNotSaveException;

class Save extends Controller
{
    /**
     * @var FaqRepositoryInterface
     */
    private $faqRepositoryFactory;

    /**
     * Save constructor.
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
     */
    public function execute()
    {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $data = $request->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if($id && $data)
        {
            $faqRepository = $this->faqRepositoryFactory->create();
            $faq = $faqRepository->getById($id);
            $faq->setData($data);

            try{
                $faqRepository->save($faq);
            }catch (CouldNotSaveException $exception)
            {
                $this->messageManager->addErrorMessage(__('Question not updated, please try again.'));
            }

            $this->messageManager->addSuccessMessage(__('Question updated.'));
            return $resultRedirect->setPath('*/questions');
        }

        $this->messageManager->addErrorMessage(__('Bad request.'));
        return $resultRedirect->setPath('*/questions')->setHttpResponseCode(400);
    }
}
