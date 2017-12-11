<?php

namespace Inchoo\Faq\Api\Data;

interface FaqInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const FAQ_TABLE     = 'inchoo_faq';
    const FAQ_ID        = 'id';
    const QUESTION      = 'question';
    const ANSWER        = 'answer';
    const USER_ID       = 'user_id';
    const PRODUCT_ID    = 'product_id';
    const SHOW_ON_FAQ   = 'show_on_faq';
    const WEBVIEW_ID    = 'webview_id';
    const CREATED_AT    = 'created_at';
    const UPDATED_AT    = 'updated_at';
    /**#@-*/

    /**
     * Get entity id
     *
     * @return int
     */
    public function getId();

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion();

    /**
     * @param string $question
     * @return FaqInterface
     */
    public function setQuestion($question);

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer();


    /**
     * @param string $answer
     * @return FaqInterface
     */
    public function setAnswer($answer);

    /**
     * Get user id
     *
     * @return int
     */
    public function getUserId();

    /**
     * Set user id
     *
     * @param int $userId
     * @return FaqInterface
     */
    public function setUserId($userId);

    /**
     * Get product id
     *
     * @return int
     */
    public function getProductId();

    /**
     * @param int $productId
     * @return FaqInterface
     */
    public function setProductId($productId);

    /**
     * Get show on faq tiny int value
     *
     * @return int
     */
    public function getShowOnFaq();

    /**
     * Set show on faq tiny int value
     *
     * @param int $showFaq
     * @return FaqInterface
     */
    public function setShowOnFaq($showFaq);


    /**
     * Get web view id
     *
     * @return int
     */
    public function getWebViewId();

    /**
     * Set web view id
     *
     * @param int $webViewId
     * @return FaqInterface
     */
    public function setWebViewId($webViewId);


    /**
     * Get creation date
     *
     * @return string
     */
    public function getDate();

}
