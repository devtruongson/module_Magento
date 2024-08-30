<?php
namespace Tigren\Question\Model;

use Tigren\Question\Model\ResourceModel\Post\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    
	protected $collection;
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $postCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
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

        // \Magento\Framework\App\ObjectManager::getInstance()
        // ->get('Psr\Log\LoggerInterface')
        // ->info('SQL Query: ' . $this->collection->getSelect()->__toString());

        \Magento\Framework\App\ObjectManager::getInstance()
        ->get('Psr\Log\LoggerInterface')
        ->info(json_encode($items));
        
        $this->loadedData = array();
        /** @var Customer $customer */
        foreach ($items as $blog) {
            $this->loadedData[$blog->getId()] = $blog->getData();
        }
        return $this->loadedData;
    }

}
