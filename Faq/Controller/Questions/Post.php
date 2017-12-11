<?php

namespace Inchoo\Faq\Controller\Questions;

use Inchoo\Faq\Api\FaqRepositoryInterface;
use Inchoo\Faq\Controller\Base\Controller;
use Inchoo\Faq\Model\Faq;
use Magento\Customer\Model\Session;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Event\ManagerInterface;

class Post extends Controller
{
    /**
     * @var \Inchoo\Faq\Api\FaqRepositoryInterfaceFactory
     */
    private $faqRepositoryFactory;
    /**
     * @var \Inchoo\Faq\Api\Data\FaqInterfaceFactory
     */
    private $faqFactory;

    /**
     * @var Session
     */
    protected $customerSession;
    /**
     * @var Validator
     */
    private $formKeyValidator;

    private $storeManager;

    private $eventManager;


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Inchoo\Faq\Api\Data\FaqInterfaceFactory $faq,
        \Inchoo\Faq\Api\FaqRepositoryInterfaceFactory $faqRepositoryInterfaceFactory,
        Session $session,
        Validator $formKeyValidator,
        StoreManagerInterface $storeManager,
        ManagerInterface $manager
    ) {

        $this->faqFactory = $faq;
        $this->faqRepositoryFactory = $faqRepositoryInterfaceFactory;
        $this->customerSession = $session;
        $this->formKeyValidator = $formKeyValidator;
        $this->storeManager = $storeManager;
        $this->eventManager = $manager;
        parent::__construct($context, $session);
    }

    /**
     * @return $this|\Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $redirectUrl = $this->_redirect->getRefererUrl();

        if ($this->formKeyValidator->validate($this->getRequest()) && $this->getRequest()->isPost())
        {
            /** @var FaqRepositoryInterface $faqRepository */
            $faqRepository = $this->faqRepositoryFactory->create();
            $webViewId = $this->storeManager->getStore()->getId();
            $question = $this->getRequest()->getParam('question');

            try {
                /** @var Faq $faq */
                $faq = $this->faqFactory->create();
                $faq->setUserId($this->userId);
                $faq->setProductId($this->getRequest()->getParam('id'));
                $faq->setQuestion($question);
                $faq->setWebViewId($webViewId);
                $faqRepository->save($faq);
                $this->eventManager->dispatch(
                    'new_question',
                    ['question' => $question]
                );
            } catch (CouldNotSaveException $e) {
                $this->messageManager->addErrorMessage(__('Question not submitted, please try again.'));
            }

            $this->messageManager->addSuccessMessage(__('Question is submitted'));

        }

        return $resultRedirect->setPath($redirectUrl);
    }
}
