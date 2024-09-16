<?php

namespace Tigren\Question\Controller\Adminhtml\Post;

class Newpost extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	) {
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$id = $this->getRequest()->getParam('entity_id');

		if (!empty($id)) {
			$resultPage->getConfig()->getTitle()->prepend((__('Add New Questions')));
		} else {
			$resultPage->getConfig()->getTitle()->prepend((__('Edit Questions')));
		}

		return $resultPage;
	}


}