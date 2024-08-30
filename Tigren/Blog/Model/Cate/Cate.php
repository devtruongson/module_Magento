<?php
namespace Tigren\Blog\Model\Blog;
class Post extends \Magento\Framework\Model\AbstractModel
{
	protected function _construct()
	{
		$this->_init('Tigren\Blog\Model\Cate\ResourceModel\Cate');
	}
}