<?php 

namespace Tigren\Blog\Block;

use Magento\Framework\View\Element\Template;
use Tigren\Blog\Model\Blog\ResourceModel\Post\CollectionFactory;

class CustomerQuestions extends Template
{
    /** @var CollectionFactory */
    protected $collectionFactory;

    /**
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get questions collection
     *
     * @return \Tigren\Question\Model\ResourceModel\Post\Collection
     */
    public function getQuestions()
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToSelect('*'); // Select all fields

        return $collection->getItems(); // Use getItems() to return array of items
    }
}



?>