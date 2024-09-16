<?php

namespace Tigren\Question\Model;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Tigren\Question\Model\ResourceModel\Post\CollectionFactory as QuestionCollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $loadedData = [];
    protected $collection;
    protected $customerRepository;
    protected $questionCollectionFactory;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param QuestionCollectionFactory $questionCollectionFactory
     * @param CollectionFactory $customerCollectionFactory
     * @param CustomerRepositoryInterface $customerRepository
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        QuestionCollectionFactory $questionCollectionFactory,
        CollectionFactory $customerCollectionFactory,
        CustomerRepositoryInterface $customerRepository,
        array $meta = [],
        array $data = []
    ) {
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->collection = $questionCollectionFactory->create();
        $this->customerRepository = $customerRepository;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        $items = $this->collection->getItems();
        $this->loadedData = [];

        foreach ($items as $question) {
            $email = $question->getEmail();
            $customerData = [];

            try {
                $customer = $this->customerRepository->get($email);
                $customerData = $customer->getData();
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                // Customer not found, handle exception if needed
            }

            $this->loadedData[$question->getId()] = array_merge($question->getData(), ['customer' => $customerData]);
        }

        return $this->loadedData;
    }
}



?>