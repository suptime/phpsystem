<?php

namespace Admin\Logic;

class MySQLORM implements Orm
{
    public function connect(){
    }

    public function disconnect(){
    }

    public function free($result){
    }

    /**
     * 执行sql写入操作
     * @param $sql
     * @param array $args
     * @return false|int
     */
    public function query($sql, array $args = array()){
        $args = func_get_args();
        $sql = $this->_buildSql($args);
        return M()->execute($sql);
    }

    /**
     * 执行插入操作
     * @param $sql
     * @param array $args
     */
    public function insert($sql, array $args = array()){
        $table = func_get_arg(1);   //获取表名
        $data = func_get_arg(2);    //获取数据
        return M()->table($table)->add($data);  //返回执行结果
    }

    public function update($sql, array $args = array()){
    }

    public function getAll($sql, array $args = array()){
    }

    public function getAssoc($sql, array $args = array()){
    }

    /**
     * 获取一行记录
     * @param $sql
     * @param array $args
     * @return mixed
     */
    public function getRow($sql, array $args = array()){
        $args = func_get_args();
        $sql = $this->_buildSql($args);
        return array_pop(M()->query($sql));
    }

    public function getCol($sql, array $args = array()){
    }

    /**
     * 获取一行一列的字段
     * @param $sql
     * @param array $args   — 返回一个包含函数参数列表的数组
     * @return mixed
     */
    public function getOne($sql, array $args = array()){
        $args = func_get_args();    //返回一个包含函数参数列表的数组
        $sql = $this->_buildSql($args); //获取组装的sql语句
        $rows = M()->query($sql);   //执行sql语句,返回一个二维数组
        return array_pop(array_pop($rows));
    }

    /**
     * 获取sql语句
     * @param $args
     */
    private function _buildSql(array $args){
        $sql = array_shift($args);  //删除数组中的第一个元素（red），并返回被删除元素的值
        $sqls = preg_split('/\?[FTN]/',$sql);   //使用正则将sql转换成数组
        array_pop($sqls);   //删除数组中的最后一个元素
        $sql = '';
        //遍历数组组装sql
        foreach($sqls as $key => $value){
            $sql .=$value.$args[$key];
        }
        return $sql;
    }
}