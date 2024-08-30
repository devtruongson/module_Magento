<?php
namespace Tigren\Blog\Model\Blog\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Tigren\Blog\Model\Blog\Post', 'Tigren\Blog\Model\Blog\ResourceModel\Post');
	}

}