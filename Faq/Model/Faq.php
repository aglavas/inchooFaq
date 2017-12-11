<?php

namespace Inchoo\Faq\Model;

use Inchoo\Faq\Api\Data\FaqInterface;
use Magento\Framework\Model\AbstractModel;

class Faq extends AbstractModel implements FaqInterface
{
    /**
     * Initialize news Model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Inchoo\Faq\Model\ResourceModel\Faq::class);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * Get answer
     *
     * @return string|null
     */
    public function getAnswer()
    {
        return $this->getData('answer');
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return $this
     */
    public function setAnswer($answer)
    {
        return $this->setData('answer', $answer);
    }

    /**
     * Get question
     *
     * @return string|null
     */
    public function getQuestion()
    {
        return $this->getData('question');
    }

    /**
     * Set question
     *
     * @param string $question
     * @return $this
     */
    public function setQuestion($question)
    {
        return $this->setData('question', $question);
    }

    /**
     * Get user id
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->getData('user_id');
    }

    /**
     * Set user id
     *
     * @param int $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        return $this->setData('user_id', $userId);
    }

    /**
     * Get product id
     *
     * @return int
     */
    public function getProductId()
    {
        return $this->getData('product_id');
    }

    /**
     * Set product id
     *
     * @param int $productId
     * @return $this
     */
    public function setProductId($productId)
    {
        return $this->setData('product_id', $productId);
    }

    /**
     * Get show on faq flag
     *
     * @return int
     */
    public function getShowOnFaq()
    {
        return $this->getData('show_on_faq');
    }

    /**
     * Set show on faq flag
     *
     * @param int $showFaq
     * @return $this
     */
    public function setShowOnFaq($showFaq)
    {
        return $this->setData('show_on_faq', $showFaq);
    }

    /**
     * Get web view id
     *
     * @return int
     */
    public function getWebViewId()
    {
        return $this->getData('webview_id');
    }

    /**
     * Set web view id
     *
     * @param int $webViewId
     * @return $this
     */
    public function setWebViewId($webViewId)
    {
        return $this->setData('webview_id', $webViewId);
    }

    /**
     * Get created at date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->getData('created_at');
    }

}