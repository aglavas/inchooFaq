<?php

namespace Inchoo\Faq\Controller\Adminhtml\Questions\Edit;

use Inchoo\Faq\Api\FaqRepositoryInterface;
use Inchoo\Faq\Controller\Adminhtml\Base\Controller;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\CouldNotSaveException;

class Save extends Controller
{
    /**
     * @var FaqRepositoryInterface
     */
    private $faqRepository;

    /**
     * Save constructor.
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
     */
    public function execute()
    {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $data = $request->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if($id && $data)
        {
            $faq = $this->faqRepository->getById($id);
            $faq->setData($data);

            try{
                $this->faqRepository->save($faq);
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
