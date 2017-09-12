<?php 
/**
 * @author xiaoxie
 * 考点模块
 */

namespace Common\Service;
use Common\Service\BaseService;
class PlaceService extends BaseService{
	
	// 虚拟模型
	protected $autoCheckFields =false;
	
/**
	 *	统计
	 */
	public function countWhere($arrWhere){
		$result = M('tg_place')->where($arrWhere)->count();
		return $result;
	}

	public function countAll(){
	    $result = M('tg_place')->count();
        return $result;
    }
	public function check($arrWhere){
		$result = M('tg_place')->where($arrWhere)->find();
		return $result;
	}
	
	/**
	 *  查找多个数据
	 */
	public function findAll($arrWhere,$first,$list){
		$result = M('tg_place')->where($arrWhere)->order('pid desc')->limit($first,$list)->select();
		return $result;
	}
	
	/**
	 * 	查找一条数据
	 */
	public function findOne($arrWhere){
		$result = M('tg_place')->where($arrWhere)->find();
		return $result;
	}
	
	/**
	 *  编辑一条数据
	 */
	public function edit($arrWhere){
		$result = M('tg_place')->data($arrWhere)->save();
		return $result;
	}
	
	/**
	 *	删除一条数据
	 */
	public function delete($arrWhere){
		$result = M('tg_place')->where($arrWhere)->delete();
		return $result;
	}
	/**
	 *	增加一条数据
	 */
	public function add($arrWhere){
		$result = M('tg_place')->data($arrWhere)->add();
		return $result;
	}
    
}
?>