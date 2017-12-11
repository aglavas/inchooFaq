<?php

namespace Inchoo\Faq\Controller\Adminhtml\Questions\Edit;

use Inchoo\Faq\Controller\Adminhtml\Base\Controller;

class Index extends Controller
{
    /**
     * Render admin Edit question page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->renderMyQuestionsAdminPage(__('Edit question'));
    }
}
