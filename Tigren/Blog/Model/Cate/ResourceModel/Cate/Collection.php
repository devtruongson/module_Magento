<?php
namespace Tigren\Blog\Model\Cate\ResourceModel\Cate;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Tigren\Blog\Model\Cate\Cate', 'Tigren\Blog\Model\Cate\ResourceModel\Cate');
	}

}