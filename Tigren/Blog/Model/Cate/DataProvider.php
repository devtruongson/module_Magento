<?php
namespace Tigren\Blog\Model\Cate;

use Tigren\Blog\Model\Cate\ResourceModel\Cate\CollectionFactory;

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
        $this->loadedData = array();

        /** @var Customer $customer */
        foreach ($items as $blog) {
            $this->loadedData[$blog->getId()] = $blog->getData();
        }
        return $this->loadedData;
    }

    public function getOptions()
    {
        $options = [];
        foreach ($this->collection->getItems() as $item) {
            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getName()
            ];
        }
        return $options;
    }

}
