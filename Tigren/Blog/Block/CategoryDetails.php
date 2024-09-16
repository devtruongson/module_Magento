<?php

namespace Tigren\Blog\Block;

use Magento\Framework\View\Element\Template;
use \Tigren\Blog\Model\Cate\CateFactory;
use \Tigren\Blog\Model\Blog\ResourceModel\Post\CollectionFactory;

class CategoryDetails extends Template
{
    protected $postFactory;
    protected $categoryFactory;

    public function __construct(
        Template\Context $context,
        CateFactory $categoryFactory,
        CollectionFactory $postFactory,
        array $data = [],
    ) {
        parent::__construct($context, $data);
        $this->categoryFactory = $categoryFactory;
        $this->postFactory = $postFactory;
    }

    public function getCategory()
    {
        $categoryId = $this->getRequest()->getParam('category_id');
        return $this->categoryFactory->create()->load($categoryId);
    }

    public function getCategoryPosts()
    {
        $categoryId = $this->getRequest()->getParam('category_id');

        $collection = $this->postFactory->create();
        $collection->addFieldToSelect('*'); // Select all fields
        $collection->addFieldToFilter('category_id', $categoryId);

        return $collection->getItems();
    }
}

?>