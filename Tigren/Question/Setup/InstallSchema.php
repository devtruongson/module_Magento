<?php
namespace Tigren\Question\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        // Create tigren_testimonial table
        $table = $installer->getConnection()->newTable(
            $installer->getTable('tigren_question')
        )->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'Entity ID'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Name'
        )->addColumn(
            'email',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Email'
        )->addColumn(
            'message',
            Table::TYPE_TEXT,
            '64k',
            [],
            'Message'
        )->addColumn(
            'company',
            Table::TYPE_TEXT,
            255,
            [],
            'Company'
        )->addColumn(
            'rating',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'default' => '0'],
            'Rating'
        )->addColumn(
            'profile_image',
            Table::TYPE_TEXT,
            255,
            [],
            'Profile Image'
        )->addColumn(
            'status',
            Table::TYPE_BOOLEAN,
            null,
            ['nullable' => false, 'default' => '0'],
            'Status'
        )->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
            'Created At'
        )->setComment(
            'Testimonial Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
