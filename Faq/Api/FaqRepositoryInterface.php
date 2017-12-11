<?php

namespace Inchoo\Faq\Api;

use Inchoo\Faq\Api\Data\FaqInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

interface FaqRepositoryInterface
{
    /**
     * Save Faq entity
     *
     * @param FaqInterface $faq
     * @throws CouldNotSaveException
     * @return FaqInterface
     */
    public function save(FaqInterface $faq);

    /**
     * Get Faq entity by id
     *
     * @param int $id
     * @throws NoSuchEntityException
     * @return FaqInterface
     */
    public function getById($id);

    /**
     * @param FaqInterface $faq
     * @throws CouldNotDeleteException
     * @return bool
     */
    public function delete(FaqInterface $faq);

}
