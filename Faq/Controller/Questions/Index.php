<?php

namespace Inchoo\Faq\Controller\Questions;

use Inchoo\Faq\Api\FaqRepositoryInterface;
use Inchoo\Faq\Controller\Base\Controller;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\NotFoundException;
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

    /**
     * @var FaqRepositoryInterface
     */
    private $faqRepository;


    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        Session $session,
        FaqRepositoryInterface $faqRepositoryInterface
    ) {
        $this->faqRepository = $faqRepositoryInterface;
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        parent::__construct($context, $session);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     * @throws NotFoundException
     */
    public function execute()
    {
        $questionId = $this->_request->getParam('id');
        $faq = $this->faqRepository->getById($questionId);

        if($faq->getUserId() != $this->userId)
        {
            throw new NotFoundException(__('Question not found.'));
        }

        $this->registry->register('question', $faq);
        return $this->renderMyQuestionsPage($this->resultPageFactory, 'faq.questions.index' );
    }
}
