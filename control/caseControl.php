<?php if (!defined('BASE_PATH')) exit('Access denied!');

class caseControl {
    /** �طõ���дҳ�� */
    function case_view(){
        $base=new base;
        $base->loadView('admin/case');
    }
    function case_beath(){
        $base=new base;
        $base->loadView('admin/case_batch');
    }
	
    /**
     * �طý����д
     */
    function upd(){
        
        $base=new base(DB_NAME3,DB_CONNECT);//���ݿ���db_kfasd
        $case=$base->getVal('c_id');//��ȡΨһ���ݺ�
        $isMoney=$base->getVal('isMoney');//��ȡ�˷ѽ��
        $state=$base->getVal('state');//�ᵥ״̬
        $tel=$base->getVal('tel');//ҵ��绰
        $employer=$base->getVal('employer');//����ͷ���Ա
        $contentCall=$base->getVal('contentCall');//�طý��
        $rate=$base->getVal('rate');//��ע
        $args=array("uid"=>$employer);
        $overdate=($state=="�ᵥ")?date("Y-m-d H:i"):"";
        $deal=($isMoney=="")?"�˶�":"�˷�".$isMoney."Ԫ";
        $uptSql="update audit set c_return='$contentCall',employer='$employer',overdate='$overdate',"
                . "deal='$deal',c_state='$state',rate='$rate' where c_id='$case'";
     
        $row=$base->getRow($uptSql);
	 if($row>0){
            $base->alert('����ɹ�');
            if($state=="�ᵥ"&&$isMoney<>""){
             $insSql="insert into audit_detail(tel,isMoney,c_id,content) "
                     . "values('$tel','$isMoney','$case','$rate')";
             $row1=$base->getRow($insSql);
             if($row1>0){
                $base->alert('�˷���Ϣ����ɹ�');
                
               
             }
             else{
                $base->alert('�˷���Ϣ����ʧ��');
                $base->back();
            }
           }
           //$doUrl=$base->doURL("plan", "showTest", $args);//�ص���������
           $base->loadView("index.php");
         }	
        else{
            $base->alert('����ʧ��');
            $base->back();
	}
        
       
    }

    /*
     * �����˶�
     *  angelo ��д,����������˶���
     */
    function btch_del(){
        $base=new base(DB_NAME3,DB_CONNECT);//���ݿ���db_kfasd
        $tel=$base->getVal('tel');//ҵ��绰,�Զ��ŷָ�
        $Dcity=$base->getval('Dcity');//������
        $type=$base->getVal('type');//Ͷ�߷�ʽ
        $employer=$base->getVal('employer');
        $content=$base->getVal('content');//Ͷ������
        $state="�ᵥ";
        $array_failtel=array();//ʧ�ܵ�sql
        $overdate=date("Y-m-d H:i");
        $arr_tel=explode(",", $tel);
        for($i=0;$i<count($arr_tel);$i++){
            if($arr_tel[$i]<>""){
              $c_id=date("YmdHi").substr($arr_tel[$i],-4);//���ڼ��Ϻ����4λ���ΨһID
              $var_tel=$arr_tel[$i];
             $var_tel=str_replace(PHP_EOL,"",$var_tel); 
              $insql="insert into "
                . "audit(c_id,c_case,tel,phone,Dfrom,Dcity,Dmod,c_type,content,employer,c_return,deal,overdate,Inputdate,c_state,ModUser) "
                . "values('$c_id','','$var_tel','','','$Dcity','','$type','$content','$employer',"
                . "'','','$overdate',now(),'$state','$employer')";
               $row=$base->getRow($insql);
                if($row>0){
                    //$base->alert('����ɹ�');
                }
		else{
                    
                    $base->alert('����ʧ��');
                    array_push($array_failtel, $arr_tel[$i]);
                }	
 
            }
        }
        
    }




    /**
     * Ͷ�߻طõ�����д 
	 * angelo ��д,��������ȡ���˶��˷ѵ�Ͷ�ߵ�����д��
     */
	 
    function add(){
        $base=new base(DB_NAME3,DB_CONNECT);//���ݿ���db_kfasd
        $case=$base->getVal('case');//CRM����
        $tel=$base->getVal('tel');//ҵ��绰
        $phone=$base->getVal('phone');//��ϵ�绰
        $Dcity=$base->getval('Dcity');//������
        $Dmod=$base->getval('Dmod');//����ʽ
        $Dfrom=$base->getval('Dfrom');//������Դ
        $type=$base->getVal('type');//Ͷ�߷�ʽ
        $content=$base->getVal('content');//Ͷ������
        $contentCall=$base->getVal('contentCall');//�ط�����
        $back=$base->getVal('back',false);//�˶�,�˷�ѡ��
        $money=$base->getVal('money');//�˷ѽ��
        $employer=$base->getVal('employer');//����ͷ���Ա
        $state=$base->getVal('state');//�ᵥ״̬
        $ModUser=$base->getVal('ModUser');//��ͷ���Ա
        $deal="";//�������
        if($state=="�ᵥ")
        {
            $deal=count(back)>=2?"�˶�,�˷�":"�˶�";
        }
        
        $overdate=($state=="�ᵥ")?date("Y-m-d H:i"):"";
        $c_id=date("YmdHi").substr($tel,-4);//���ڼ��Ϻ����4λ���ΨһID
        $insql="insert into "
            . "audit(c_id,c_case,tel,phone,Dfrom,Dcity,Dmod,c_type,content,employer,c_return,deal,overdate,Inputdate,c_state,ModUser) "
            . "values('$c_id','$case','$tel','$phone','$Dfrom','$Dcity','$Dmod','$type','$content','$employer',"
            . "'$contentCall','$deal','$overdate',now(),'$state','$ModUser')";
	  
			
         $row=$base->getRow($insql);
	 if($row>0){
            $base->alert('����ɹ�');
            $base->back_refresh();
	 }
		
        else{
            $base->alert('����ʧ��');
            $base->back();
	}	  
        


    }
	
	
    /**
     * Ͷ�߻طõ�����д 
     */
	 /*
	 2012-06-19����ҵ���߼����˶����˷��嵥��xls���������޸ġ�angelo
    function add(){
        $base=new base;
        $case=$base->getVal('case');//����
        $tel=$base->getVal('tel');//ҵ��绰
        $phone=$base->getVal('phone');//��ϵ�绰
        $type=$base->getVal('type');//Ͷ�߷�ʽ
        $content=$base->getVal('content');//Ͷ������
        $back=$base->getVal('back',false);//�˶�����
        $opentype=$base->getVal('opentype');//��ͨ��ʽ
        $employer=$base->getVal('employer');//Ӫ����Ա���
        if($back){$back=implode(',',$back);}
        $sql="insert into audit (`case`,tel,phone,`type`,content,back,opentype,employer,dingcase) 
        values ('$case','$tel','$phone','$type','$content','$back','$opentype','$employer','$dingcase')";
		$row=$base->getRow($sql);
		if($row>0){
            $base->alert('����ɹ�');
            $base->back_refresh();
		}
		else{
            $base->alert('����ʧ��');
            $base->back();
		}
    }
	*/
    function case_detail(){
        $base=new base;
        $id=$base->getVal('id');
        $sql = "select type,content,back,opentype,`return`,deal,audit,state,employer from audit where id='$id' order by id desc";
        $result=$base->getResult($sql);
        $back=strtr($result['back'],array("1" => "��ͥ��ҵ", "2" => "֪������","3"=>"������԰"));
        $state=strtr($result['state'],array("1" =>"��ط�","2" =>"�ѻط�","3"=>"������","4"=>"�ѽᵥ"));
        $base->loadView('admin/case_detail',array('result'=>$result,'back'=>$back,'state'=>$state),false);
    }
    function getHistory(){
        $base=new base;
        $tel=$base->getVal('tel');
        $sql='select id,`case`,phone from audit where tel='.$tel.' order by `case` desc';
        $result=$base->getResult($sql,true);
        echo '<div class="table">';
            echo '<div class="tabletop">';
                echo '<h1 style="width:15%;">����</h1>';
                echo '<h1 style="width:30%;">����</h1>';
                echo '<h1 style="width:35%;">��ϵ�绰</h1>';
                echo '<h1 style="width:10%;">��ϸ</h1>';
            echo '</div>';
        foreach($result as $key=>$val){
            $color=($key%2)?'EEEEEE':'FFFFFF';
            $date=substr($val['case'],0,4).'-'.substr($val['case'],4,2).'-'.substr($val['case'],6,2);
            echo '<div class="tabletr" style="background-color:#'.$color.';">';
                echo '<div class="tabletd" style="width:15%;">'.$date.'</div>';
                echo '<div class="tabletd" style="width:30%;">'.$val['case'].'</div>';
                echo '<div class="tabletd" style="width:35%;">'.$val['phone'].'</div>';
                echo '<div class="tabletd" style="width:10%;">
                        <a class="thickbox" onclick="tb_show(\'newwindow\',\'index.php?c=case&f=case_detail&id='.$val['id'].'&height=400&width=550&modal=true\')" href="#">����</a>
                      </div>';
            echo '</div>';    
        }
        echo '</div>';
    }  
    
} 
?>