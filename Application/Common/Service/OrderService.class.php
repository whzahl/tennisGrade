<?php 
/**
 * @author xiaoxie
 * 订单表模块
 */

namespace Common\Service;
use Common\Service\BaseService;
class OrderService extends BaseService{
	
	// 虚拟模型
	protected $autoCheckFields =false;
	
/**
	 *	统计
	 */
	public function count($arrWhere){
		$result = M('tg_order')->where($arrWhere)->count();
		return $result;
	}
	
	public function check($arrWhere){
		$result = M('tg_order')->where($arrWhere)->find();
		return $result;
	}
	
	/**
	 *  查找多个数据
	 */
	public function findAll($arrWhere,$first,$list){
		$result = M('tg_order')->where($arrWhere)->order('oid desc')->limit($first,$list)->select();
		return $result;
	}
	
	/**
	 * 	查找一条数据
	 */
	public function findOne($arrWhere){
		$result = M('tg_order')->where($arrWhere)->find();
		return $result;
	}
	
	/**
	 *  编辑一条数据
	 */
	public function edit($arrWhere){
		$result = M('tg_order')->data($arrWhere)->save();
		return $result;
	}
	
	/**
	 *	删除一条数据
	 */
	public function delete($arrWhere){
		$result = M('tg_order')->where($arrWhere)->delete();
		return $result;
	}
	/**
	 *	增加一条数据
	 */
	public function add($arrWhere){
		$result = M('tg_order')->data($arrWhere)->add();
		return $result;
	}
    
}
?>