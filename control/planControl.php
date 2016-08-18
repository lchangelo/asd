<?php if (!defined('BASE_PATH')) exit('Access denied!');

class planControl {
    /**
     * ������ʾҳ��
     * viewPage:��ת��ҳ��
     */
    public function showView(){
        try{            
            $base=new base;
            $viewPage = $base->getVal('v');
            $base->loadView($viewPage);
        }
        catch(exception $err){
            
        }
        
    }
    
    function trackUser(){
        try{
          $base=new base(DB_NAME3,DB_CONNECT);//���ݿ���db_kfasd
          $type=$base->getVal('type');//�ж�����ʾ���ǲ���
          $ycc=$base->getVal('ycc');//ԭ������Ա
          $mcc=$base->getVal('mcc');//�ɵ�������Ա
          $Inputdate=date("Y-m-d");//����ĵ���
          if($type==1){
             $base->loadView('trackingUser'); 
          }
          else{
             $updSql="update audit set employer='$mcc' where Inputdate like '$Inputdate%' "
                     . "and c_state='���ڲ���' and employer='$ycc'";
             $row=$base->getRow($updSql);
             if($row>0){
                 $base->alert('����ɹ�');   
             }
             else{
                 $base->alert('����ʧ��');
                 $base->back();
             }
          }
          
            
        }catch(exception $err){
            
        }
        
        
    }
    
    function showTest()
    {
        try{            
            $base=new base(DB_NAME3,DB_CONNECT);//���ݿ���db_kfasd
            $uid=$base->getVal('uid');//��ȡ��ǰ��½�ͷ�ID
            $tel=$base->getVal('tel');//��ȡҵ�����
            $CountResult=array();
            $querySql="select a.c_id,a.tel,a.phone,Dmod,DgTime,DDate,b.DCompany,c_state,Dstate "
                    . "from (audit as a left join tbl_custom_circs as b on a.tel=b.tel) "
                    . "left join tbl_monthuser as c on a.tel=c.tel "
                    . "where a.c_state<>'�����' and a.employer='$uid'";
            $pageNo = 1;
            $pageSize=20;
            $page=$base->getPageList($pageNo,$pageSize,$querySql);
            is_array($page['list'])?null:$page['list']=array();
            foreach($page['list'] as $key=>$val){
                
                $tel=$val['tel'];
                $countSql="select count(*) as cun from audit where tel='$tel'";//��ѯ�Ƿ��ж���Ͷ�߼�¼
                $CountTmp=$base->getResult($countSql);
                array_push($CountResult, $CountTmp['cun']);
                
            }
            
            
           
            $base->loadView('testEasyUi',array('page'=>$page,
                'res'=>$page['list'],
                'CountResult'=>$CountResult
                )
            );
        }
        catch(exception $err){
            
        }
    }
    
    /** ҵ��ʹ�ò�ѯ����*/
    function business_use(){
        $base=new base(DB_NAME2,DB_CONNECT2);
        $dat=$base->getVal('dat');
        $tel=$base->getVal('num');
        if($dat){
            $dat=date('Y-m-d',strtotime($dat)); 
        }
        $sql='select calldate,src,dst,billsec,disposition,uniqueid from cdr where';
        if($dat){
            $sql.=' calldate like \'%'.$dat.'%\'';
        }
        if($dat&&$tel){$sql.=' and ';}
        if($tel){
            $sql.=' (src like \'%'.$tel.'%\' or dst like \'%'.$tel.'%\') ';
        }
        $sql .= ' order by calldate desc ';
        $pageNo = $_GET['pageNo'];
        $pageSize=20;
        $page=$base->getPageList($pageNo,$pageSize,$sql);
        $base->loadView('business_use',array('page'=>$page,
            'res'=>$page['list'],
            'num'=>$tel,
            'dat'=>$dat
            )
        );
    }
    /*
     * angelo ����ͷ������
     */
    function getWorkService(){
        $base=new base(DB_NAME3,DB_CONNECT);//���ݿ���db_kfasd
        $uid=$base->getVal('uid');//��ȡ��ǰ��½�ͷ�ID
        $tel=$base->getVal('tel');//��ȡҵ�����
        $querySql="select c_case,a.tel,a.phone,Dmod,DgTime,DDate,DCompany,c_state,Dstate "
                . "from (audit as a left join tbl_custom_circs as b on a.tel=b.tel) "
                . "left join tbl_monthuser as c on a.tel=c.tel "
                . "where a.c_state<>'�����' and a.employer='$uid'"; 
        $countSql="select count(*) from audit where tel='$tel'";//��ѯ�Ƿ��ж���Ͷ�߼�¼
        $CountResult=$base->getResult($countSql);
        $pageNo = 1;
        $pageSize=20;
        $page=$base->getPageList($pageNo,$pageSize,$querySql);
        $base->loadView('DotheWorkService',array('page'=>$page,
            'res'=>$page['list'],
            'CountResult'=>$CountResult
            )
        );
      
    }
    
    
    /**
     * ��ͨ�����ѯ
	 */
    function getBusinessRecordSelect(){
        $base=new base(DB_NAME1,DB_CONNECT2);
        $tel=$base->getVal('tel');
        $useTimes = array();
		$ctArray=array();//�й����������ֶ�
        $sql='select cTime,cCallTel,cCallName,cKardID,cKardPwd,cColumns,state,customMode,rate,DATE_SUB(bussinesDate, INTERVAL 30 DAY) as enddate,qaId '.
        ' from tbl_monthuserhistory where state=0 ';
        if(!empty($tel)){
            $sql.=' and cCallTel like \'%'.$tel.'%\' ';
        }
        $sql .= ' order by cTime desc ';
        $pageNo = $_GET['pageNo'];
        $pageSize=20;
        $page=$base->getPageList($pageNo,$pageSize,$sql);        
        if(!empty($page['list'])){
            foreach($page['list'] as $key => $val){
                if(!empty($val['cCallTel'])){
                    $times = $this->countUseTimes($val['cCallTel']);//ʹ�ô���
					$CTstate = $this->CtUseState($val['cCallTel']);//��������ϵͳ״̬
                    if(!empty($times)):
                        $useTimes[$val['cCallTel']] = $times;//��������
                    endif;
					if(!empty($CTstate)):
                        $ctArray = $CTstate;//��������
					endif;
                }
            }
        }
        $base->loadView('business_shearSel',array('page'=>$page,
            'res'=>$page['list'],
            'tel'=>$tel,
            'useTimes'=>$useTimes,
			'CTstate'=>$ctArray
            )
        );
    }
	
	 /**
     * ҵ����ϸ�ط����
     * tel:�û�ҵ�����
     */
	
	function case_detail(){
	$base=new base(DB_NAME3,DB_CONNECT);//���ݿ���db_tellvisit
        $c_id=$base->getVal('c_id');
        $Dgtime=$base->getVal('Dgtime');
        $querySql="select tel,phone,Dcity,Dmod,c_type,content,ModUser from audit where c_id='$c_id'";
        $result=$base->getResult($querySql);
        $tmpDgtime=array("DgTime"=>$Dgtime);
        $result['DgTime']=$Dgtime;
        $result['c_id']=$c_id;
        $base->loadView('case_detail',array('result'=>$result));
    }
	 
     /**
     * ҵ�������ѯ
     * tel:�û�ҵ�����
     */
    function getBusinessRecord(){
        $base=new base(DB_NAME3,DB_CONNECT);//���ݿ���db_kfasd
        $tel=$base->getVal('tel');
        $CountResult=array();
        $audit=array();
        $querySql="select a.tel,a.Dcity,a.DDate,a.DgTime,a.PlayTime,a.Dstate,a.Type,a.DCompany,b.c_date,b.isMoney"
                . " from (tbl_custom_circs as a left join audit_detail as b on a.tel=b.tel)"
                . "where a.tel='$tel'";
        $countSql="select count(*) as con from audit where tel='$tel'";//��ѯ�Ƿ��ж���Ͷ�߼�¼
        $CountResult=$base->getResult($countSql);
        $pageNo = 1;
        $pageSize=20;
        $page=$base->getPageList($pageNo,$pageSize,$querySql);
        $base->loadView('business_shear',array('page'=>$page,
            'res'=>$page['list'],
            'CountResult'=>$CountResult
            ));

    }
    
    function getAuditRecord(){
        $base=new base(DB_NAME3,DB_CONNECT);//���ݿ���db_kfasd
        $tel=$base->getVal('tel');
        $DCase=$base->getVal('DCase');//�������
        $dd=$base->getVal('dd');//��ȡ�ɵ�����
        $querYAuditSql="";
        $Dcase="";
        $dtmp="";
        $querYAuditSql="select tel,c_type,employer,Dmod,Inputdate,overdate,content,c_return,c_state,"
                    . "rate from audit where tel='$tel'";
        if($Dcase<>""){
              $querYAuditSql.=" or c_case='$DCase'";  
         }
         if($dd<>""){
             $dtmp=date("Y-m-d",strtotime($dd));
              $querYAuditSql.=" or Inputdate like '$dtmp%'";  
         }
        try{
            $pageNo = 1;
            $pageSize=20;
            $page=$base->getPageList($pageNo,$pageSize,$querYAuditSql);
            $base->loadView('case_shear',array('page'=>$page,
                    'res'=>$page['list']));
            
        } catch (Exception $ex) {

        }
        
        
        
    }
	 
	 /**
     * ҵ������������˶�
     * tel:�绰����
     */
	  function CtUseState($tel){
		$base=new base(DB_NAME1,DB_CONNECT2);
		$arr = '';//storage the array of return
		if(!empty($tel)){
			$sql ='select cCTStart,cCTQuit,cCTDebits from tbl_monthUser1 where cCallTel=\''.$tel.'\'';
			$query = mysql_query($sql);
			 while($row = mysql_fetch_row($query)){
				$arr[0]=$row[0];
				$arr[1]=$row[1];
				$arr[2]=$row[2];
			 }
		}
		return $arr;
	  
	  }
	/**
     * ҵ��Ŀ�ͨʱ��
     * tel:�绰����
     */
	 function getCtim($tel){
		$base=new base(DB_NAME1,DB_CONNECT2);
		$arr = '';//storage the array of return
		if(!empty($tel)){
			$sql ='select min(cTime) from tbl_monthuserhistory where cCallTel=\''.$tel.'\'';
			$query = mysql_query($sql);
			 while($row = mysql_fetch_row($query)){
				$arr[0]=$row[0];
			 }
		}
		return $arr;
	  
	  }
	
	
    /**
     * ҵ��ʹ�ô���
     * tel:�绰����
     */
    function countUseTimes($tel){
        $base=new base(DB_NAME2,DB_CONNECT2);
        $arr = '';//storage the array of return
        if(!empty($tel)){
            $sql =' select substr(calldate,1,7) as month from cdr where src like cast(\''.$tel.'\' as signed) group by substr(calldate,1,7) order by substr(calldate,1,7)';
            $query = mysql_query($sql);
            while($row = mysql_fetch_assoc($query)){
                $times=0;//equals $t_tmp1+$t_tmp2
                $t_tmp1=0;//dstchannel is not null ,then +1
                $t_tmp2=0;//dstchannel is null ,then +0.5
                $getSql = 'select * from cdr where src like cast(\''.$tel.'\' as signed) and calldate like \''.$row['month'].'%\'';
                $getQuere = mysql_query($getSql);
                while($res = mysql_fetch_assoc($getQuere)){
                    if(!empty($row['dstchannel'])){
                        ++$t_tmp1;
                    }
                    else{
                        ++$t_tmp2;
                    }
                    $times = ($t_tmp1/2)+$t_tmp2;//ʹ�ô���
                }
                $arr[date('Y��m��',strtotime($row['month']))] = $times;
            }
        }
        return $arr;
    }
    /**
     * ¼���ļ�����ҳ��
     */
    function record_operation_view(){
        $base=new base;        
        //$base->loadView('record_input');
        $this->history_show();
    }
    /**
     * ¼����ʾ
     */
    function history_show(){
        $base=new base;
        $tel=$base->getVal('tel');
        $sql='select * from tbl_userPlayRecord ';
        if(!empty($tel)){
            $sql .= ' where tel =\''.$tel.'\' ';
        }
        $sql .= ' order by addTime desc';
        $pageNo = $_GET['pageNo'];
        $pageSize=20;
        $page=$base->getPageList($pageNo,$pageSize,$sql);
        $base->loadView('record_input',array('page'=>$page,
            'res'=>$page['list'],
            'tel'=>$tel
            )
        );
    }
    /**
     * ¼������
     */
    function record_input(){
        $base=new base;
        session_start();
        $tel=$base->getVal('tel');
        $uid=$_SESSION['user']['id'];
        $boot = '/var/lib/asterisk/sounds/custom/';//�ļ�ת��Ŀ¼
        $fName = substr($_FILES['fname']['name'],0,strlen($_FILES['fname']['name'])-4);//�ļ���
        $fType = $_FILES['fname']['type'];//�ļ�����
        //if(in_array('audio',explode('/',$fType))){
		if($fType=='audio/wav'){
            if($this->uploadFile()){
                $sql = 'insert into tbl_userPlayRecord (addTime,tel,path,fname,empId,listenTimes) values ('.
                "now(),'$tel','$boot','$fName','$uid','0')";
                mysql_query($sql);
                $this->history_show();
            }
            else{
                echo '<script>alert(\'�ļ��ϴ������г�������!�������ϴ�������ϵ����Ա\');</script>';
				$this->record_operation_view();
            }
        }
        else{
            echo '<script>alert(\'��ѡ��һ��wav��ʽ����Ƶ��ʽ�ļ������ϴ�!\');</script>';
			$this->record_operation_view();
        }
    }
    /**
     * �ϴ��ļ�
     */
    function uploadFile($path='fname'){
        $date = date('Y-m-d');
        $boot = '/var/lib/asterisk/sounds/custom/';//�ļ�ת��Ŀ¼
        $tName = $_FILES['fname']['name'];
        $fType = $_FILES["$path"]['type'];
        if(is_uploaded_file($_FILES["$path"]['tmp_name'])){
            if( move_uploaded_file($_FILES["$path"]['tmp_name'],$boot.$tName) ){
                return $tName;
            }
            else{
                return false;
            }            
        }
    }
    /**
     * ����
     */
    function callout(){
        $base=new base;
        $phone=$base->getVal('phone');//ת�ӵĵ绰
        if(!empty($phone)){
			shell_exec("/var/opt/clickcallPlay.sh " . "88888" . " " . "61$phone" . "");//����shell�ű�����������������            
        }
    }
} 
?>