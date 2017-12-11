<?php

namespace Inchoo\Faq\Model;

use Inchoo\Faq\Api\Data\FaqInterface;
use Inchoo\Faq\Api\FaqRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Inchoo\Faq\Model\ResourceModel\Faq;
use Inchoo\Faq\Model\ViewModel\FaqFactory;

class FaqRepository implements FaqRepositoryInterface
{

    /**
     * @var Faq
     */
    private $faqResource;

    /**
     * @var FaqFactory
     */
    private $faqModelFactory;

    /**
     * FaqRepository constructor.
     * @param Faq $faqResource
     * @param FaqFactory $faqFactory
     */
    public function __construct(
        Faq $faqResource,
        FaqFactory $faqFactory
    ) {
        $this->faqResource = $faqResource;
        $this->faqModelFactory = $faqFactory;
    }

    /**
     * Get FAQ entity by id
     *
     * @param int $faqId
     * @return Faq
     * @throws NoSuchEntityException
     */
    public function getById($faqId)
    {
        /** @var Faq $faq */
        $faq = $this->faqModelFactory->create();
        $this->faqResource->load($faq, $faqId);
        if (!$faq->getId()) {
            throw new NoSuchEntityException(__('News with id "%1" does not exist.', $faqId));
        }
        return $faq;
    }

    /**
     * Delete FAQ entity
     *
     * @param FaqInterface $faq
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(FaqInterface $faq)
    {
        try {
            $this->faqResource->delete($faq);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Save FAQ entity
     *
     * @param FaqInterface $faq
     * @return FaqInterface
     * @throws CouldNotSaveException
     */
    public function save(FaqInterface $faq)
    {
        try {
            $this->faqResource->save($faq);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $faq;
    }


}