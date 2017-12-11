<?php

namespace Inchoo\Faq\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class EditActions
 */
class EditActions extends Column
{
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as & $item) {
            if (isset($item['id'])) {
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => $this->context->getUrl(
                            'faq/questions_edit/index',
                            ['id' => $item['id']]
                        ),
                        'label' => __('Edit')
                    ],
                    'delete' => [
                        'href' => $this->context->getUrl(
                            'faq/questions_delete/index',
                            ['id' => $item['id']]
                        ),
                        'label' => __('Delete')
                    ]
                ];
            }
        }

        return $dataSource;
    }
}
