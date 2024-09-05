<?php

namespace Tigren\Blog\Controller\Adminhtml\Cate;

class Deletecate extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	protected $cateFactory;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Tigren\Blog\Model\Cate\CateFactory $cateFactory
	)
	{
		$this->cateFactory = $cateFactory;
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{

        $resultRedirect = $this->resultRedirectFactory->create();
        $id=$this->getRequest()->getParam('category_id');

		try{
			$model = $this->cateFactory->create()->load($id);
			$model->delete();
			$this->messageManager->addSuccessMessage(__('You have deleted the cate.'));
		}catch(\Exception $e){
			$this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the question.'));
		}
	 return $resultRedirect->setPath('*/*/');
	}


}