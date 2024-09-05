<?php
namespace Tigren\Blog\Model\Cate;

class Cate extends \Magento\Framework\Model\AbstractModel
{
	protected function _construct()
	{
		$this->_init('Tigren\Blog\Model\Cate\ResourceModel\Cate');
	}
}