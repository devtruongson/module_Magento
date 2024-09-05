<?php

namespace Tigren\Blog\Controller\Adminhtml\Cate;

class Savecate extends \Magento\Backend\App\Action
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
		$data = $this->getRequest()->getPostValue();
      /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id=$this->getRequest()->getParam('category_id');
        //echo $id; exit;
	     try{
	        /** @var \Magento\Cms\Model\Page $model */
	           if(isset($id) && !empty($id)){
	           	   $model = $this->cateFactory->create()->load($id);
				   $model->addData($data);
				   $model->save();
	           }else{
	           	unset($data['category_id']);
		       $model = $this->cateFactory->create();
				   $model->setData($data);
				   $model->save();
			   }
		    	$this->messageManager->addSuccessMessage(__('You saved or create the cate.'));
			}catch(\Exception $e){
				 $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the cate.'));
			}
	 return $resultRedirect->setPath('*/*/');
	}


}