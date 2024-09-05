<?php

namespace Tigren\Blog\Ui\Component\Listing\Blog\Form\Categories;

use Magento\Framework\Data\OptionSourceInterface;
use Tigren\Blog\Model\Cate\ResourceModel\Cate\CollectionFactory as CateCollectionFactory;

/**
 * Options tree for "Categories" field
 */
class Options implements OptionSourceInterface
{
    /**
     * @var CateCollectionFactory
     */
    protected $cateCollectionFactory;

    /**
     * Options constructor.
     *
     * @param CateCollectionFactory $cateCollectionFactory
     */
    public function __construct(CateCollectionFactory $cateCollectionFactory)
    {
        $this->cateCollectionFactory = $cateCollectionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        $options = [];

        // Create a new category collection
        $collection = $this->cateCollectionFactory->create();

        // Load the collection
        // $collection->addFieldToSelect(['name']); // Ensure the 'name' attribute is selected

        foreach ($collection as $item) {
            $options[] = [
                'value' => $item->getId(),
                'label' => $item->getName()
            ];
        }

        return $options;
    }
}
