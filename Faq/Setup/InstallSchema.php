<?php

namespace Inchoo\Faq\Setup;

use Inchoo\Faq\Api\Data\FaqInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{

    private function createFaqTable(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()->newTable(
            $setup->getTable(FaqInterface::FAQ_TABLE)
        )->addColumn(
            FaqInterface::FAQ_ID,
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Faq Id'
        )->addColumn(
            FaqInterface::QUESTION,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            1000,
            [],
            'Faq question'
        )->addColumn(
            FaqInterface::ANSWER,
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            1000,
            ['nullable' => true],
            'Faq answer'
        )->addColumn(
            FaqInterface::USER_ID,
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false],
            'To which user this question belongs'
        )->addColumn(
            FaqInterface::PRODUCT_ID,
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false],
            'To which product this question belongs'
        )->addColumn(
            FaqInterface::SHOW_ON_FAQ,
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            ['nullable' => false, 'default' => false],
            'Show on Faq page flag'
        )->addColumn(
            FaqInterface::WEBVIEW_ID,
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['unsigned' => true],
            'Show on Faq page flag'
        )->addColumn(
            FaqInterface::CREATED_AT,
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Created at timestamp'
        )->addColumn(
            FaqInterface::UPDATED_AT,
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
            'Updated at timestamp'
        )->addForeignKey(
            $setup->getFkName('inchoo_faq', 'user_id', 'customer_entity', 'entity_id'),
            'user_id',
            $setup->getTable('customer_entity'),
            'entity_id',
            null
        )->addForeignKey(
            $setup->getFkName('inchoo_faq', 'product_id', 'catalog_product_entity', 'entity_id'),
            'product_id',
            $setup->getTable('catalog_product_entity'),
            'entity_id',
            null
        )->setComment(
            'Faq Table'
        );

        return $table;
    }

    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $setup->getConnection()->createTable($this->createFaqTable($setup));

        $setup->endSetup();
    }

}