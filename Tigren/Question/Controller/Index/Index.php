<?php
namespace Tigren\Question\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use PHPUnit\Framework\Constraint\IsEmpty;

class Index extends Action
{
    //     protected $resultPageFactory;

    //     public function __construct(Context $context, PageFactory $resultPageFactory)
//     {
//         $this->resultPageFactory = $resultPageFactory;
//         parent::__construct($context);
//     }

    //     public function execute()
//     {
//         return $this->resultPageFactory->create();
//     }

    protected $_customerSession;
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        // \Magento\Customer\Model\Session $customerSession,
    ) {
        // $this->_customerSession = $customerSession;
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $om = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $om->get('Magento\Customer\Model\Session');
        $customerData = $customerSession->getCustomer()->getData();
        $customerId = $customerSession->getCustomer()->getEmail();

        if (count($customerData) === 0) {
            echo "Đã login đâu";
        } else {
            echo json_encode($customerData);
        }
    }
}
