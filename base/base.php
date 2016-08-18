<?php if (!defined('BASE_PATH')) exit('Access denied!');
require 'base_parent.php';
/**
 * @author ashley
 * @copyright admin
 * @version 2011-1-27
 * @access public
 */
final class base extends base_parent{
    
    /** 构造函数,执行连接数据库操作 
    * @dbname 数据库名,默认连接config定义的数据库DB_NAME 
    * @connect 数据库连接,默认连接config定义的数据库DB_CONNECT 
    */
    public function __construct($dbname=false,$connect=false)
    {
        parent::__construct($dbname,$connect);
    }
    /** 析构函数,关闭数据库 */
    public function __destruct()
    {
        parent::__destruct();
    }
    /** 更改服务器连接 
    * @connect 服务器连接
    * @db 数据库名
    * @charset 数据库字符集,默认config
    * @timezone 数据库时区,默认config
    */
    public function changeConnect($connect,$db,$charset=false,$timezone=false)
    {
        parent::changeConnect($connect,$db,$charset,$timezone);
    }
    /** 更改数据库连接
     * @dbname 数据库名
     */
    public function changeDB($dbname)
    {
        parent::changeDB($dbname);
    }
    /** 
    * 返回分页结果
    * @pageNo 页码
    * @pageSize 每页显示数量
    * @sql SQL语句
    */
    public function getPageList($pageNo,$pageSize,$sql)
    {
        return parent::getPageList($pageNo,$pageSize,$sql);
    }
    /** SQL查询的结果用此方法返回数据
    * @sql SQL语句
    * @isList 查询结果是否为多条,单条默认false,多条添加true
    */
    public function getResult($sql,$isList=false)
    {
        return parent::getResult($sql,$isList);
    }
    /** 返回执行SQL语句影响的行数
     * @sql SQL语句
     */
    public function getRow($sql)
    {
        return parent::getRow($sql);
    }
    /** 对get和post数据进行sql过滤处理
     * @name get或者post的name
     */
    public function getVal($name)
    {
        return parent::getVal($name);
    }
    /** 调用view类方法
     * @viewPath 视图基于view/的路径,不带后缀.php
     * @param 传进一个数组，包含任意数量参数，在view页面输出
     * @filter 是否进行HTML过滤
     */
    public function loadView($viewPath,$param=false,$filter=true)
    {
        parent::loadView($viewPath,$param,$filter);
    }
    /** 加载类，并实例化
     * @classname 类名
     * @path 自定义路径,例如'view/shop'
     */
    public function loadClass($className,$path=false){
        return parent::loadClass($className,$path);
    }
    
    /** 弹出对话框
     * @content 对话框内容
     */
    static function alert($content)
    {
        parent::alert($content);
    }
    /** 页面跳转
     * @url 跳转地址
     */
    static function href($url)
    {
        parent::href($url);
    }
    /** 页面后退 */
    static function back()
    {
       parent::back();
    }
    /** 页面刷新 */
    static function refresh()
    {
        parent::refresh();
    }
    /** 后退并刷新 */
    static function back_refresh()
    {
        parent::back_refresh();
    }
    /** 分页显示的url代码
    * @control control页面
    * @function 方法
    * @args 用数组形式array('name1'=>'value1','name2'=>'value2')
    */
    public function doURL($control,$function,$args)
    {
        return parent::doURL($control,$function,$args);
    } 
    /** 插入表数据
     * @table 表名
     * @data 数组array(列名=>值)
     */
    public function sql_add($table,$data)
    {
        return parent::sql_add($table,$data); 
    }  
    /** 删除表数据
     * @table 表名
     * @condition where后面的查询条件
     */
    public function sql_del($table,$condition)
    {
        return parent::sql_del($table,$condition);
    }
    /** 更新表数据
     * @table 表名
     * @data 数组array(列名=>值)
     * @condition where后面的查询条件
     */
    public function sql_upt($table,$data,$condition)
    {
        return parent::sql_upt($table,$data,$condition);
    }
    /** 查询表数据
     * @table 表名
     * @col 列名
     * @condition where后面的查询条件
     * @isList 查询结果是否为多条,单条默认false,多条添加true
     */
    public function sql_sel($table,$col,$condition,$isList=false)
    {
        return parent::sql_sel($table,$col,$condition,$isList);
    }
    /**
     * 防止XSS攻击
     * @val 传入值
    */
    function xssCheck($val){
        $result=htmlspecialchars($val,ENT_QUOTES);
        return $result;
    }
}
?>