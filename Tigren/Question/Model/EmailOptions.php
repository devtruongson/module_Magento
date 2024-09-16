<?php
namespace Tigren\Question\Model;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;

class EmailOptions implements OptionSourceInterface
{
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        $options = [];
        $collection = $this->collectionFactory->create();
        foreach ($collection as $customer) {
            $options[] = [
                'value' => $customer->getEmail(),
                'label' => $customer->getEmail()
            ];
        }
        return $options;
    }
}



?>