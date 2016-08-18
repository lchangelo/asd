<?php if (!defined('BASE_PATH')) exit('Access denied!');
/**
 * @author ashley
 * @copyright admin
 * @version 2011-1-27
 * @access public
 */
class base_parent{
    /** 数据库连接 */
    private $db='';
    /** 构造函数,执行连接数据库操作 
    * @dbname 数据库名,默认连接config定义的数据库DB_NAME 
    * @connect 数据库连接,默认连接config定义的数据库DB_CONNECT 
    */
    protected function __construct($dbname=false,$connect=false)
    {
        if($connect){
            $connect=explode(',',$connect);
        }
        else{
            $connect=explode(',',DB_CONNECT);
        }
        $this->db=mysql_connect($connect['0'],$connect['1'],$connect['2'],true,MYSQL_CLIENT_COMPRESS) or die('Could not connect:'.mysql_error());
        if($dbname==false){
            $dbname=DB_NAME;
        }
        mysql_select_db($dbname) or die('Could not connect:'.mysql_error());
        mysql_query('SET NAMES '.CHARSET);
        date_default_timezone_set(TIMEZONE);
    }
    /** 析构函数,关闭数据库 */
    protected function __destruct()
    {
        mysql_close($this->db);
    }
    /** 更改服务器连接 
    * @connect 服务器连接
    * @db 数据库名
    * @charset 数据库字符集,默认config
    * @timezone 数据库时区,默认config
    */
    protected function changeConnect($connect,$db,$charset=false,$timezone=false)
    {
        $connect=explode(',',$connect);
        $this->db=mysql_connect($connect['0'],$connect['1'],$connect['2'],true,MYSQL_CLIENT_COMPRESS) or die('Could not connect:'.mysql_error());
        mysql_select_db($db) or die('Could not connect:'.mysql_error());
        ($charset)? mysql_query('set names '.$charset): mysql_query('set names '.MYSQLCHARSET);
        ($timezone)? date_default_timezone_set($timezone):date_default_timezone_set(TIMEZONE);
    }
    /** 更改数据库连接
     * @dbname 数据库名
     */
    protected function changeDB($dbname)
    {
        mysql_select_db($dbname) or die('Could not connect:'.mysql_error());
    }
    /** 显示异常消息 
    * @e try catch(Exception $e)
    */
    private function errorMessage($e)
    { 
        if($e->getTrace()){
            $error=$e->getTrace();//获取错误消息
            $sequence=count($error)-1;
            for($i=$sequence;$i>=0;--$i){//倒序输出错误消息，使其符合程序执行顺序
                echo 'Message:Error on line '.$error[$i]['line'].' in '.$error[$i]['file'].'</br>';
            }
            echo 'Execute:<b>'.$error['0']['args']['0'].'</b></br>';//执行语句
            echo 'Reason:<b>'.$e->getMessage().'</b></br>';//原因
        }
    }
    /** 执行SQL语句,出错会抛出异常
     * @sql 要执行的SQL语句
     */
    protected function query($sql)
    {
        $query = mysql_query($sql);
        if(!$query){
            if(DEBUG_MODEL){
                throw new Exception(mysql_error());    
            }
            else{
                exit('<h1 style="color:red;" align="center">Program execution error!<h1>');
            }
            return true;
        }
        else{
            return $query;
        }
    }
    /** 
    * 返回分页结果
    * @pageNo 页码
    * @pageSize 每页显示数量
    * @sql SQL语句
    */
    protected function getPageList($pageNo,&$pageSize,$sql)
    {
        if(!$pageNo){//没有页码，默认第一页
            $pageNo=1;
        }
        $begin = ($pageNo-1)*$pageSize;	//起始记录
        $result=$this->getResult($sql,true);//执行传递的SQL
        if($result){
            $rows=count($result);//获取总记录数
            $userList = array_slice($result,$begin,$pageSize);//取出指定值
        }
        unset($result);   
        // 计算总页数
        if($rows){
            $pageList['maxpage']=($rows%$pageSize)?intval($rows/$pageSize)+1:$rows/$pageSize;
        }
        $pageList['list'] = $userList;//结果集
        $pageList['sum'] = $rows;//总数
        $pageList['begin']=$begin;//开始记录
        $pageList['prepg']=$pageNo-1;//上一页
        $pageList['nextpg']=$pageNo+1;//下一页
        $pageList['pageNo']=$pageNo;//当前页码
        return $pageList;
    }
    /** SQL查询的结果用此方法返回数据
    * @sql SQL语句
    * @isList 查询结果是否为多条,单条默认false,多条添加true
    */
    protected function getResult($sql,$isList=false)
    {
        try{
            $query = $this->query($sql); 
            if($isList==true){
                $result=array();
                while ($rs = mysql_fetch_assoc($query)){
                    $result[] = $rs;
                }
            }
            else{
                $result=mysql_fetch_assoc($query);
            }
            return $result;
        }
        catch(Exception $e)
        {
            $this->errorMessage($e);
        }
    }
    /** 返回执行SQL语句影响的行数
     * @sql SQL语句
     */
    protected function getRow($sql)
    {
        try{
            $this->query($sql); 
            return  mysql_affected_rows();
        }
        catch(Exception $e)
        {
            $this->errorMessage($e);
        }
    }
    /** 对get和post数据进行sql过滤处理
     * @name get或者post的name
     */
    protected function getVal($name)
    {
        $param=($_POST[$name])?$_POST[$name]:$_GET[$name];
        return (is_array($param))?$this->date_filter($param):mysql_real_escape_string($param);
    }
    /** 调用view类方法
     * @viewPath 视图基于view/的路径,不带后缀.php
     * @param 传进一个数组，包含任意数量参数，在view页面输出
     * @filter 是否进行HTML过滤
     */
    protected function loadView($viewPath,$param=false,$filter=true)
    {
        $view_path=BASE_PATH.'view/'.$viewPath.'.php';
        if($param&&is_array($param)){
            extract(($filter)?$this->date_filter($param):$param);
        } 
        if(file_exists($view_path)){
            include($view_path);
        }
        else{
            die('Error:can not find view file:<b>'.$view_path.'<b>');
        }
    }
    /** 加载类，并实例化
     * @classname 类名
     * @path 自定义路径,例如'view/shop'
     */
    protected function loadClass($className,$path=false){
        if($className){
            $path=($path)?$path:'class';
            include (BASE_PATH.$path.'/'.$className.'.php');
            return new $className;
        }
    }
    /** 用于数组过滤
    * @array 数组
    * @type 过滤类型,HTML,SQL 
    */
    public function date_filter($array)
    {        
        $arr=($arr)?$arr:array();
        foreach($array as $key=>$val){
            $arr[$key]=(is_array($val))?$this->date_filter($val,$type):htmlspecialchars($val);
        }
        return $arr;
    } 
    /** 弹出对话框
     * @content 对话框内容
     */
    public static function alert($content)
    {
        echo '<script>alert(\''.$content.'\');</script>';
    }
    /** 页面跳转
     * @url 跳转地址
     */
    public static function href($url)
    {
        echo '<script>location.href=\''.$url.'\';</script>';
    }
    /** 页面后退 */
    public static function back()
    {
        echo '<script>history.back();window.location.reload(true);</script>';
        //echo '<script>history.go(-1);</script>';
    }
    /** 页面刷新 */
    public static function refresh()
    {
        echo '<script>location.reload();</script>';
        //echo '<script>history.go(0);</script>';
    }
    /** 后退并刷新 */
    public static function back_refresh()
    {
        echo '<script>location.replace(document.referrer);</script>';
        //echo '<script>location.replace(location.href);</script>';
    }
    /** 分页显示的url代码
    * @control control页面
    * @function 方法
    * @args 用数组形式array('name1'=>'value1','name2'=>'value2')
    */
    public function doURL($control,$function,$args)
    {
        $url=array();
        foreach($args as $key=>$arg){
            $url['url'].='&'.$key.'='.$arg;
        }
        $url['path']='index.php?c='.$control.'&f='.$function.'&';
        return $url;
    } 
    /** 插入表数据
     * @table 表名
     * @data 数组array(列名=>值)
     */
    protected function sql_add($table,$data)
    {
        $insert=' insert into `'.$table.'` (';
        $values=' values (';
        if($data){
            foreach($data as $key=>$val){
                $insert.='`'.$key.'`,';
                $values.='\''.$val.'\',';
            } 
        }
        $sql=substr($insert,0,-1).')'.substr($values,0,-1).')';
        return $this->getRow($sql); 
    }  
    
    /** 以下方法仅为尝试写法 */
    
    /** 删除表数据
     * @table 表名
     * @condition where后面的查询条件
     */
    protected function sql_del($table,$condition)
    {
        $del=' delete from `'.$table.'` ';
        if($condition){
            $del.=' where '.$condition;
        }
        return $this->getRow($del); 
    }
    /** 更新表数据
     * @table 表名
     * @data 数组array(列名=>值)
     * @condition where后面的查询条件
     */
    protected function sql_upt($table,$data,$condition)
    {
        $upt=' update from `'.$table.'` ';
        if($data){
            $set=' set ';
            foreach($data as $key=>$val){
                $set.='`'.$key.'`=\''.$val.'\',';
            }
            $upt.=substr($set,0,-1); 
        }
        if($condition){
            $upt.=' where '.$condition;
        }
        return $this->getRow($upt);
    }
    /** 查询表数据
     * @table 表名
     * @col 列名
     * @condition where后面的查询条件
     * @isList 查询结果是否为多条,单条默认false,多条添加true
     */
    protected function sql_sel($table,$col,$condition,$isList=false)
    {
        $sel=' select '.$col.' from `'.$table.'` ';
        if($condition){
           $sel.=' where '.$condition;
        }
        return $this->getResult($sel,$isList);
    }
    
    
    
}
?>