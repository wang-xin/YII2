<?php
/**
 * Created by PhpStorm.
 * User: King
 * Date: 2016/12/9
 * Time: 11:48
 */

namespace common\helpers;


class Tree
{
    /**
     * 把返回的数据集转换成Tree(多位数组)
     * @auth King
     *
     * @param        $list
     * @param string $pk
     * @param string $pid
     * @param string $child
     * @param int    $root
     *
     * @return array
     */
    public static function list2tree($list, $pk = 'id', $pid = 'parent_id', $child = '_child', $root = 0)
    {
        // 创建Tree
        $tree = [];
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = [];
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                } else {
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $list[$key]['name'] = $list[$key]['name'];
                        $parent[$child][] = &$list[$key];
                    }
                }
            }
        }

        return $tree;
    }

    /**
     * unLimitedForLevel
     * @auth King
     *
     * @param        $list
     * @param string $pid
     * @param int    $level
     * @param string $html
     * @param int    $root
     *
     * @return array
     */
    public static function unLimitedForLevel($list, $pid = 'parent_id', $level = 0, $html = '--', $root = 0)
    {
        $arr = [];
        if (is_array($list)) {
            foreach ($list as $data) {
                if ($data[$pid] == $root) {
                    $data['level'] = $level + 1;
                    $data['html'] = str_repeat($html, $level);
                    $arr[] = $data;
                    $arr = array_merge($arr, self::unLimitedForLevel($list, $pid, $level + 1, $html, $data['id']));
                }
            }
        }

        return $arr;
    }
}