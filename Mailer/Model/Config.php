<?php

namespace Inchoo\Mailer\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;


/**
 * Contact module configuration
 */
class Config implements ConfigInterface
{

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->scopeConfig->getValue(
            self::MAILER_ENABLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function emailTemplate()
    {
        return $this->scopeConfig->getValue(
            self::MAILER_TEMPLATE,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function emailRecipient()
    {
        return $this->scopeConfig->getValue(
            self::MAILER_RECIPIENT,
            ScopeInterface::SCOPE_STORE
        );
    }
}
