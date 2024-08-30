<?php
namespace Tigren\Question\Model;
class Post extends \Magento\Framework\Model\AbstractModel
{
	protected function _construct()
	{
		$this->_init('Tigren\Question\Model\ResourceModel\Post');
	}
}
