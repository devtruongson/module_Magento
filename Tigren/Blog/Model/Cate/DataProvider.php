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
     * @param CollectionFactory $collectionFactory
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
        $this->loadedData = [];

        foreach ($items as $cate) {
            $this->loadedData[$cate->getId()] = $cate->getData();
        }
        return $this->loadedData;
    }

    /**
     * Get category options
     *
     * @return array
     */
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

        return [
            ['value' => '1', 'label' => __('Danh mục 1')],
            ['value' => '2', 'label' => __('Danh mục 2')],
        ];
    }

}
