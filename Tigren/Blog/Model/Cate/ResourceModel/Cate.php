<?php
namespace Tigren\Blog\Model\Cate\ResourceModel;


class Cate extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('tigren_blog_cate', 'category_id');
	}
	
}
