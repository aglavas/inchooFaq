<?php

namespace Inchoo\Mailer\Observer;


use Inchoo\Mailer\Model\ConfigInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class QuestionObserver implements ObserverInterface
{

    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var LoggerInterface
     */
    protected $logger;


    public function __construct(
        TransportBuilder $transportBuilder,
        ConfigInterface $config,
        StoreManagerInterface $manager,
        LoggerInterface $logger
    )
    {
        $this->transportBuilder = $transportBuilder;
        $this->config = $config;
        $this->storeManager = $manager;
        $this->logger = $logger;
    }


    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->config->isEnabled()) {
            $question = array(
                'question' => $observer->getEvent()->getData('question')
            );

            $sender = [
                'name' => 'Question',
                'email' => 'question@self.com',
            ];

            $transport = $this->transportBuilder
                ->setTemplateIdentifier($this->config->emailTemplate())
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => $this->storeManager->getStore()->getId()
                    ]
                )
                ->setTemplateVars($question)
                ->setFrom($sender)
                ->addTo($this->config->emailRecipient())
                ->getTransport();

            try{
                $transport->sendMessage();
            }catch (\Exception $exception)
            {
                $this->logger->critical($exception);
            }
        }

    }
}