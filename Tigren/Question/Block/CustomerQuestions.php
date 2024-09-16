<?php

namespace Tigren\Question\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;

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
        $om = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $om->get('Magento\Customer\Model\Session');
        $customerEmail = $customerSession->getCustomer()->getEmail();

        $collection = $this->collectionFactory->create();
        $collection->addFieldToSelect('*'); // Chọn tất cả các trường

        // Thêm điều kiện lọc theo email
        $collection->addFieldToFilter('email', "fstack1.edu@gmail.com");

        return $collection->getItems(); // Sử dụng getItems() để trả về mảng các mục
    }
}
?>