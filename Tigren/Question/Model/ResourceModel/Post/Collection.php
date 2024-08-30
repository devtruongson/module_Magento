<?php
namespace Tigren\Question\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Tigren\Question\Model\Post', 'Tigren\Question\Model\ResourceModel\Post');
	}

}