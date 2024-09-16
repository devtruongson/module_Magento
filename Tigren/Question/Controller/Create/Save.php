<?php

namespace Tigren\Question\Controller\Create;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Customer\Model\Session;
use Tigren\Question\Model\PostFactory; // Sử dụng PostFactory thay vì CollectionFactory
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Io\File as IoFile;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action
{
    protected $postFactory; // Sử dụng PostFactory
    protected $customerSession;
    protected $ioFile;
    protected $directoryList;

    public function __construct(
        Context $context,
        PostFactory $postFactory,
        Session $customerSession,
        IoFile $ioFile,
        DirectoryList $directoryList
    ) {
        $this->postFactory = $postFactory;
        $this->customerSession = $customerSession;
        $this->ioFile = $ioFile;
        $this->directoryList = $directoryList;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            return $this->_redirect('*/*/create');
        }

        try {
            // Xử lý upload file ảnh
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['name']) {
                $uploader = new \Magento\MediaStorage\Model\File\Uploader('profile_image');
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                $path = $this->directoryList->getPath(DirectoryList::MEDIA) . '/testimonial';
                $result = $uploader->save($path);
                $data['profile_image'] = $result['file'];
            }

            // Lấy email khách hàng
            $om = \Magento\Framework\App\ObjectManager::getInstance();
            $customerSession = $om->get('Magento\Customer\Model\Session');
            $customerEmail = $customerSession->getCustomer()->getEmail();
            $customerName = $customerSession->getCustomer()->getName();

            // Thêm email khách hàng vào dữ liệu
            $data['customer_email'] = $customerEmail;
            $data['name'] = $customerName;

            // Lưu dữ liệu testimonial
            $post = $this->postFactory->create(); // Sử dụng postFactory để tạo model
            $post->setData($data);
            $post->setCreatedAt(date('Y-m-d H:i:s'));
            $post->save();

            $this->messageManager->addSuccessMessage(__('Your testimonial has been submitted successfully.'));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred while saving the testimonial.'));
        }

        return $this->_redirect('tigrenquestion');
    }

}


?>