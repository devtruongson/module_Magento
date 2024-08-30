<?php
namespace Tigren\Blog\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        // Create table for Blog Categories
        if (!$installer->tableExists('tigren_blog_cate')) {
            $table = new Table();
            $table->setName($installer->getTable('tigren_blog_cate'))
                ->addColumn('category_id', Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Category ID')
                ->addColumn('name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Category Name')
                ->addColumn('description', Table::TYPE_TEXT, '64k', [], 'Category Description')
                ->addColumn('status', Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false], 'Status')
                ->addColumn('created_at', Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => Table::TIMESTAMP_INIT], 'Creation Time')
                ->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE], 'Update Time')
                ->setComment('Blog Categories Table');
                
            $installer->getConnection()->createTable($table);
        }

        // Create table for Blog Posts
        if (!$installer->tableExists('tigren_blog_post')) {
            $table = new Table();
            $table->setName($installer->getTable('tigren_blog_post'))
                ->addColumn('post_id', Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Post ID')
                ->addColumn('category_id', Table::TYPE_INTEGER, null, ['unsigned' => true, 'nullable' => false], 'Category ID')
                ->addColumn('title', Table::TYPE_TEXT, 255, ['nullable' => false], 'Post Title')
                ->addColumn('post_image', Table::TYPE_TEXT, 255, [], 'Post Image')
                ->addColumn('list_image', Table::TYPE_TEXT, 255, [], 'List Image')
                ->addColumn('full_content', Table::TYPE_TEXT, '64k', [], 'Full Content')
                ->addColumn('short_content', Table::TYPE_TEXT, 255, [], 'Short Content')
                ->addColumn('author', Table::TYPE_TEXT, 255, [], 'Author')
                ->addColumn('status', Table::TYPE_SMALLINT, null, ['unsigned' => true, 'nullable' => false], 'Status')
                ->addColumn('published_at', Table::TYPE_TIMESTAMP, null, [], 'Published At')
                ->addForeignKey(
                    $installer->getFkName('tigren_blog_post', 'category_id', 'tigren_blog_cate', 'category_id'),
                    'category_id',
                    $installer->getTable('tigren_blog_cate'),
                    'category_id',
                    Table::ACTION_CASCADE
                )
                ->setComment('Blog Posts Table');
                
            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
