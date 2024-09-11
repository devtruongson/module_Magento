<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Tigren\Blog\Controller\Adminhtml\Upload;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
/**
 * Class Upload
 */
class Upload extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    protected $imageUploader;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Model\ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tigren_Blog::save');
    }
    public function execute()
    {
        $imageId = $this->_request->getParam('param_name', 'post_image');

        if (isset($imageId)) {
            try {
                $result = $this->imageUploader->saveFileToTmpDir($imageId);
            } catch (\Exception $e) {
                // $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
            }
            return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
        }
    }
}