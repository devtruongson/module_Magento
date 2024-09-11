<?php

namespace Tigren\Blog\Controller\Adminhtml\Post;

class Savepost extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	protected $postFactory;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Tigren\Blog\Model\Blog\PostFactory $postFactory
	) {
		$this->postFactory = $postFactory;
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$data = $this->getRequest()->getPostValue();
		/** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
		$resultRedirect = $this->resultRedirectFactory->create();
		$id = $this->getRequest()->getParam('post_id');
		//echo $id; exit;

		\Magento\Framework\App\ObjectManager::getInstance()
			->get('Psr\Log\LoggerInterface')
			->info(json_encode($data["post_image"]));

		try {
			/** @var \Magento\Cms\Model\Page $model */
			if (isset($id) && !empty($id)) {
				// $model = $this->postFactory->create()->load($id);
				// $model->addData($data);
				// $model->setCategoryId($data["data"]["parent"]);
				// $model->save();
			} else {
				unset($data['post_id']);
				$model = $this->postFactory->create();

				// Set the fields manually
				$model->setAuthor($data["author"]);
				$model->setTitle($data["title"]);
				$model->setShortContent($data["short_content"]);
				$model->setFullContent($data["full_content"]);
				$model->setStatus($data["status"]);
				$model->setPublishedAt($data["published_at"]);
				$model->setCategoryId($data["data"]["parent"]); // Assuming this is the category ID

				// Handling the post image
				if (isset($data['post_image'][0]['file'])) {
					$model->setPostImage($data['post_image'][0]['file']);
				} else {
					// Handle the case where there is no image or set a default value if needed
					$model->setPostImage(null);
				}

				// Save the model
				$model->save();
			}
			$this->messageManager->addSuccessMessage(__('You saved the post.'));
		} catch (\Exception $e) {
			$this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
		}

		return $resultRedirect->setPath('*/*/');
	}


}

//post_image[0][file]

/*
post_id: 
title: sad
author: asd
short_content: asd
full_content: asd
status: true
published_at: 9/24/2024
data[parent]: 1
post_image[0][name]: Screenshot_from_2024-09-10_11-32-49_2.png
post_image[0][full_path]: Screenshot from 2024-09-10 11-32-49.png
post_image[0][type]: image/png
post_image[0][tmp_name]: /tmp/phpff059M
post_image[0][error]: 0
post_image[0][size]: 96891
post_image[0][file]: Screenshot_from_2024-09-10_11-32-49_2.png
post_image[0][url]: http://magento3.localhost.com/media/tigrenblog/tmp/images/Screenshot_from_2024-09-10_11-32-49_2.png
post_image[0][previewType]: image
post_image[0][id]: U2NyZWVuc2hvdF9mcm9tXzIwMjQtMDktMTBfMTEtMzItNDlfMi5wbmc,
form_key: p5Kiqhqy9nTQoPFX
*/
