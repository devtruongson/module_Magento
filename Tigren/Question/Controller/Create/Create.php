<?php
namespace Tigren\Question\Controller\Create;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Create extends Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
