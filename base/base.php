<?php if (!defined('BASE_PATH')) exit('Access denied!');
require 'base_parent.php';
/**
 * @author ashley
 * @copyright admin
 * @version 2011-1-27
 * @access public
 */
final class base extends base_parent{
    
    /** ���캯��,ִ���������ݿ���� 
    * @dbname ���ݿ���,Ĭ������config��������ݿ�DB_NAME 
    * @connect ���ݿ�����,Ĭ������config��������ݿ�DB_CONNECT 
    */
    public function __construct($dbname=false,$connect=false)
    {
        parent::__construct($dbname,$connect);
    }
    /** ��������,�ر����ݿ� */
    public function __destruct()
    {
        parent::__destruct();
    }
    /** ���ķ��������� 
    * @connect ����������
    * @db ���ݿ���
    * @charset ���ݿ��ַ���,Ĭ��config
    * @timezone ���ݿ�ʱ��,Ĭ��config
    */
    public function changeConnect($connect,$db,$charset=false,$timezone=false)
    {
        parent::changeConnect($connect,$db,$charset,$timezone);
    }
    /** �������ݿ�����
     * @dbname ���ݿ���
     */
    public function changeDB($dbname)
    {
        parent::changeDB($dbname);
    }
    /** 
    * ���ط�ҳ���
    * @pageNo ҳ��
    * @pageSize ÿҳ��ʾ����
    * @sql SQL���
    */
    public function getPageList($pageNo,$pageSize,$sql)
    {
        return parent::getPageList($pageNo,$pageSize,$sql);
    }
    /** SQL��ѯ�Ľ���ô˷�����������
    * @sql SQL���
    * @isList ��ѯ����Ƿ�Ϊ����,����Ĭ��false,�������true
    */
    public function getResult($sql,$isList=false)
    {
        return parent::getResult($sql,$isList);
    }
    /** ����ִ��SQL���Ӱ�������
     * @sql SQL���
     */
    public function getRow($sql)
    {
        return parent::getRow($sql);
    }
    /** ��get��post���ݽ���sql���˴���
     * @name get����post��name
     */
    public function getVal($name)
    {
        return parent::getVal($name);
    }
    /** ����view�෽��
     * @viewPath ��ͼ����view/��·��,������׺.php
     * @param ����һ�����飬��������������������viewҳ�����
     * @filter �Ƿ����HTML����
     */
    public function loadView($viewPath,$param=false,$filter=true)
    {
        parent::loadView($viewPath,$param,$filter);
    }
    /** �����࣬��ʵ����
     * @classname ����
     * @path �Զ���·��,����'view/shop'
     */
    public function loadClass($className,$path=false){
        return parent::loadClass($className,$path);
    }
    
    /** �����Ի���
     * @content �Ի�������
     */
    static function alert($content)
    {
        parent::alert($content);
    }
    /** ҳ����ת
     * @url ��ת��ַ
     */
    static function href($url)
    {
        parent::href($url);
    }
    /** ҳ����� */
    static function back()
    {
       parent::back();
    }
    /** ҳ��ˢ�� */
    static function refresh()
    {
        parent::refresh();
    }
    /** ���˲�ˢ�� */
    static function back_refresh()
    {
        parent::back_refresh();
    }
    /** ��ҳ��ʾ��url����
    * @control controlҳ��
    * @function ����
    * @args ��������ʽarray('name1'=>'value1','name2'=>'value2')
    */
    public function doURL($control,$function,$args)
    {
        return parent::doURL($control,$function,$args);
    } 
    /** ���������
     * @table ����
     * @data ����array(����=>ֵ)
     */
    public function sql_add($table,$data)
    {
        return parent::sql_add($table,$data); 
    }  
    /** ɾ��������
     * @table ����
     * @condition where����Ĳ�ѯ����
     */
    public function sql_del($table,$condition)
    {
        return parent::sql_del($table,$condition);
    }
    /** ���±�����
     * @table ����
     * @data ����array(����=>ֵ)
     * @condition where����Ĳ�ѯ����
     */
    public function sql_upt($table,$data,$condition)
    {
        return parent::sql_upt($table,$data,$condition);
    }
    /** ��ѯ������
     * @table ����
     * @col ����
     * @condition where����Ĳ�ѯ����
     * @isList ��ѯ����Ƿ�Ϊ����,����Ĭ��false,�������true
     */
    public function sql_sel($table,$col,$condition,$isList=false)
    {
        return parent::sql_sel($table,$col,$condition,$isList);
    }
    /**
     * ��ֹXSS����
     * @val ����ֵ
    */
    function xssCheck($val){
        $result=htmlspecialchars($val,ENT_QUOTES);
        return $result;
    }
}
?>