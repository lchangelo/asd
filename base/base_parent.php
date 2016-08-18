<?php if (!defined('BASE_PATH')) exit('Access denied!');
/**
 * @author ashley
 * @copyright admin
 * @version 2011-1-27
 * @access public
 */
class base_parent{
    /** ���ݿ����� */
    private $db='';
    /** ���캯��,ִ���������ݿ���� 
    * @dbname ���ݿ���,Ĭ������config��������ݿ�DB_NAME 
    * @connect ���ݿ�����,Ĭ������config��������ݿ�DB_CONNECT 
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
    /** ��������,�ر����ݿ� */
    protected function __destruct()
    {
        mysql_close($this->db);
    }
    /** ���ķ��������� 
    * @connect ����������
    * @db ���ݿ���
    * @charset ���ݿ��ַ���,Ĭ��config
    * @timezone ���ݿ�ʱ��,Ĭ��config
    */
    protected function changeConnect($connect,$db,$charset=false,$timezone=false)
    {
        $connect=explode(',',$connect);
        $this->db=mysql_connect($connect['0'],$connect['1'],$connect['2'],true,MYSQL_CLIENT_COMPRESS) or die('Could not connect:'.mysql_error());
        mysql_select_db($db) or die('Could not connect:'.mysql_error());
        ($charset)? mysql_query('set names '.$charset): mysql_query('set names '.MYSQLCHARSET);
        ($timezone)? date_default_timezone_set($timezone):date_default_timezone_set(TIMEZONE);
    }
    /** �������ݿ�����
     * @dbname ���ݿ���
     */
    protected function changeDB($dbname)
    {
        mysql_select_db($dbname) or die('Could not connect:'.mysql_error());
    }
    /** ��ʾ�쳣��Ϣ 
    * @e try catch(Exception $e)
    */
    private function errorMessage($e)
    { 
        if($e->getTrace()){
            $error=$e->getTrace();//��ȡ������Ϣ
            $sequence=count($error)-1;
            for($i=$sequence;$i>=0;--$i){//�������������Ϣ��ʹ����ϳ���ִ��˳��
                echo 'Message:Error on line '.$error[$i]['line'].' in '.$error[$i]['file'].'</br>';
            }
            echo 'Execute:<b>'.$error['0']['args']['0'].'</b></br>';//ִ�����
            echo 'Reason:<b>'.$e->getMessage().'</b></br>';//ԭ��
        }
    }
    /** ִ��SQL���,������׳��쳣
     * @sql Ҫִ�е�SQL���
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
    * ���ط�ҳ���
    * @pageNo ҳ��
    * @pageSize ÿҳ��ʾ����
    * @sql SQL���
    */
    protected function getPageList($pageNo,&$pageSize,$sql)
    {
        if(!$pageNo){//û��ҳ�룬Ĭ�ϵ�һҳ
            $pageNo=1;
        }
        $begin = ($pageNo-1)*$pageSize;	//��ʼ��¼
        $result=$this->getResult($sql,true);//ִ�д��ݵ�SQL
        if($result){
            $rows=count($result);//��ȡ�ܼ�¼��
            $userList = array_slice($result,$begin,$pageSize);//ȡ��ָ��ֵ
        }
        unset($result);   
        // ������ҳ��
        if($rows){
            $pageList['maxpage']=($rows%$pageSize)?intval($rows/$pageSize)+1:$rows/$pageSize;
        }
        $pageList['list'] = $userList;//�����
        $pageList['sum'] = $rows;//����
        $pageList['begin']=$begin;//��ʼ��¼
        $pageList['prepg']=$pageNo-1;//��һҳ
        $pageList['nextpg']=$pageNo+1;//��һҳ
        $pageList['pageNo']=$pageNo;//��ǰҳ��
        return $pageList;
    }
    /** SQL��ѯ�Ľ���ô˷�����������
    * @sql SQL���
    * @isList ��ѯ����Ƿ�Ϊ����,����Ĭ��false,�������true
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
    /** ����ִ��SQL���Ӱ�������
     * @sql SQL���
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
    /** ��get��post���ݽ���sql���˴���
     * @name get����post��name
     */
    protected function getVal($name)
    {
        $param=($_POST[$name])?$_POST[$name]:$_GET[$name];
        return (is_array($param))?$this->date_filter($param):mysql_real_escape_string($param);
    }
    /** ����view�෽��
     * @viewPath ��ͼ����view/��·��,������׺.php
     * @param ����һ�����飬��������������������viewҳ�����
     * @filter �Ƿ����HTML����
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
    /** �����࣬��ʵ����
     * @classname ����
     * @path �Զ���·��,����'view/shop'
     */
    protected function loadClass($className,$path=false){
        if($className){
            $path=($path)?$path:'class';
            include (BASE_PATH.$path.'/'.$className.'.php');
            return new $className;
        }
    }
    /** �����������
    * @array ����
    * @type ��������,HTML,SQL 
    */
    public function date_filter($array)
    {        
        $arr=($arr)?$arr:array();
        foreach($array as $key=>$val){
            $arr[$key]=(is_array($val))?$this->date_filter($val,$type):htmlspecialchars($val);
        }
        return $arr;
    } 
    /** �����Ի���
     * @content �Ի�������
     */
    public static function alert($content)
    {
        echo '<script>alert(\''.$content.'\');</script>';
    }
    /** ҳ����ת
     * @url ��ת��ַ
     */
    public static function href($url)
    {
        echo '<script>location.href=\''.$url.'\';</script>';
    }
    /** ҳ����� */
    public static function back()
    {
        echo '<script>history.back();window.location.reload(true);</script>';
        //echo '<script>history.go(-1);</script>';
    }
    /** ҳ��ˢ�� */
    public static function refresh()
    {
        echo '<script>location.reload();</script>';
        //echo '<script>history.go(0);</script>';
    }
    /** ���˲�ˢ�� */
    public static function back_refresh()
    {
        echo '<script>location.replace(document.referrer);</script>';
        //echo '<script>location.replace(location.href);</script>';
    }
    /** ��ҳ��ʾ��url����
    * @control controlҳ��
    * @function ����
    * @args ��������ʽarray('name1'=>'value1','name2'=>'value2')
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
    /** ���������
     * @table ����
     * @data ����array(����=>ֵ)
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
    
    /** ���·�����Ϊ����д�� */
    
    /** ɾ��������
     * @table ����
     * @condition where����Ĳ�ѯ����
     */
    protected function sql_del($table,$condition)
    {
        $del=' delete from `'.$table.'` ';
        if($condition){
            $del.=' where '.$condition;
        }
        return $this->getRow($del); 
    }
    /** ���±�����
     * @table ����
     * @data ����array(����=>ֵ)
     * @condition where����Ĳ�ѯ����
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
    /** ��ѯ������
     * @table ����
     * @col ����
     * @condition where����Ĳ�ѯ����
     * @isList ��ѯ����Ƿ�Ϊ����,����Ĭ��false,�������true
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