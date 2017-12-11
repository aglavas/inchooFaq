<?php
/**
 * Created by PhpStorm.
 * User: andrija
 * Date: 12/4/17
 * Time: 10:13 AM
 */

namespace Inchoo\Faq\Block\Tab;

use Magento\Framework\View\Element\Template\Context;

class Form extends \Magento\Framework\View\Element\Template
{

    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get form title
     */
    public function getTitle()
    {
        echo __("Ask question");
    }

    /**
     * Get faq form post action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->getUrl(
            'faq/questions/post',
            [
                '_secure' => $this->getRequest()->isSecure(),
                'id' => $this->getProductId(),
            ]
        );
    }

    /**
     * Get product id
     *
     * @return int
     */
    protected function getProductId()
    {
        return $this->getRequest()->getParam('id', false);
    }

}