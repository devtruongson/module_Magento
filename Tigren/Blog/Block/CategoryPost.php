<?php

namespace Tigren\Blog\Block;

use Magento\Framework\View\Element\Template;
use \Tigren\Blog\Model\Blog\ResourceModel\Post\CollectionFactory;

class CategoryPost extends Template
{
    protected $postFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $postFactory,
        array $data = [],
    ) {
        parent::__construct($context, $data);
        $this->postFactory = $postFactory;
    }

    public function getPost()
    {
        $postId = $this->getRequest()->getParam('post_id');

        $collection = $this->postFactory->create();
        $collection->addFieldToSelect('*'); // Select all fields
        $collection->addFieldToFilter('post_id', $postId);

        return $collection->getFirstItem(); // Return the first item from the collection
    }


}

?>