<?php

namespace Inchoo\Faq\Controller\Adminhtml\Questions;

use Inchoo\Faq\Controller\Adminhtml\Base\Controller;

class Index extends Controller
{
    /**
     * Render admin Questions page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->renderMyQuestionsAdminPage(__('Questions'));
    }
}
