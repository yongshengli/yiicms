<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/1/19
 * Time: 14:18
 * Email:liyongsheng@meicai.cn
 */

namespace app\helpers;


use yii\base\Object;
use Yii;

class CategoryHelper extends Object
{
    public $categories = [];

    private $_categoriesMap;

    /**
     *
     */
    public function init()
    {
        $this->_categoriesMap = array_column($this->categories, null, 'id');
        foreach($this->categories as &$item){
            $item['pname'] = $this->getCategory($item['id'], 'name');
            $item['full_pname'] = $this->getFullParentName($item['path']);
            $item['full_name'] = $this->getFullName($item['full_pname'],$item['name']);
            $item['level'] = $this->getLevel($item['path']);
            $this->_categoriesMap[$item['id']] = array_merge($this->_categoriesMap[$item['id']], $item);
        }
    }

    /**
     * 获取KV格式
     * @return array
     */
    public function getKV()
    {
        return array_column($this->_categoriesMap, 'full_name', 'id');
    }
    /**
     * 取树形结构结果
     * @return array
     */
    public function getTreeArray()
    {
        $data = $this->categories;
        $map = [];
        $tree = [];
        foreach($data as $key=>$item){
            $map[$item['id']] = isset($map[$item['id']])?array_merge($item,$map[$item['id']]):$item;
            if($item['pid']==0){
                $tree[$item['id']] = &$map[$item['id']];
            }else{
                if(!isset($map[$item['pid']])){
                    $map[$item['pid']] = [];
                }
                if(!isset($map[$item['pid']]['children'])){
                    $map[$item['pid']]['children'] = [];
                }
                $map[$item['pid']]['children'][$item['id']] = &$map[$item['id']];
            }
        }
        return $tree;
    }
    /**
     * 获取分类级别
     * @param string $path
     * @return int
     */
    protected function getLevel($path)
    {
        return count(explode('/',$path))+1;
    }
    /**
     * 获取分类详情
     * @param int $id
     * @param string $field
     * @return null|array
     */
    protected function getCategory($id, $field=null)
    {
        if(!isset($this->_categoriesMap[$id])){
            return null;
        }
        return $field?$this->_categoriesMap[$id][$field]:$this->_categoriesMap['id'];
    }

    /**
     * @param string $path
     * @return string
     */
    protected function getFullParentName($path)
    {
        $baseName = [];
        $pathArr =  explode('/', $path);
        foreach($pathArr as $id){
            $baseName[] = $this->getCategory($id, 'name');
        }
        return implode('/', $baseName);
    }

    /**
     * @param string $baseName
     * @param string $name
     * @return string
     */
    protected function getFullName($baseName, $name)
    {
        return $baseName?$baseName.'/'.$name:$name;
    }
}