<?php

namespace Tigren\Question\Controller\Adminhtml\Post;

use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Tigren\Question\Model\ResourceModel\Post\CollectionFactory;
use Tigren\Question\Model\PostFactory;

class Massdelete extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	protected $postFactory;

	public $collectionFactory;

    public $filter;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
	 	Filter $filter,
        CollectionFactory $collectionFactory,
        PostFactory $postFactory
	)
	{
		parent::__construct($context);
		$this->postFactory = $postFactory;
	 	$this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{  
	    $ids=$this->getRequest()->getParams();

        try {
            $count = 0;

            foreach ($ids['selected'] as $id) {
                $model = $this->postFactory->create()->load($id);
                $model->delete();
                $count++;
            } 

            $this->messageManager->addSuccess(__('A total of %1 question(s) have been deleted.', $count));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
	}


}