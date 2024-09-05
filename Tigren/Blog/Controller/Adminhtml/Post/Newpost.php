<?php

namespace Tigren\Blog\Controller\Adminhtml\Post;

class Newpost extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$id = $this->getRequest()->getParam('post_id');

		if(!isset($id)){
			$resultPage->getConfig()->getTitle()->prepend((__('Add New Post')));
		}else{
			$resultPage->getConfig()->getTitle()->prepend((__('Edit Post')));
		}

		return $resultPage;
	}


}