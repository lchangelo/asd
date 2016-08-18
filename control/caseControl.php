<?php if (!defined('BASE_PATH')) exit('Access denied!');

class caseControl {
    /** 回访单填写页面 */
    function case_view(){
        $base=new base;
        $base->loadView('admin/case');
    }
    function case_beath(){
        $base=new base;
        $base->loadView('admin/case_batch');
    }
	
    /**
     * 回访结果填写
     */
    function upd(){
        
        $base=new base(DB_NAME3,DB_CONNECT);//数据库在db_kfasd
        $case=$base->getVal('c_id');//获取唯一单据号
        $isMoney=$base->getVal('isMoney');//获取退费金额
        $state=$base->getVal('state');//结单状态
        $tel=$base->getVal('tel');//业务电话
        $employer=$base->getVal('employer');//处理客服人员
        $contentCall=$base->getVal('contentCall');//回访结果
        $rate=$base->getVal('rate');//备注
        $args=array("uid"=>$employer);
        $overdate=($state=="结单")?date("Y-m-d H:i"):"";
        $deal=($isMoney=="")?"退订":"退费".$isMoney."元";
        $uptSql="update audit set c_return='$contentCall',employer='$employer',overdate='$overdate',"
                . "deal='$deal',c_state='$state',rate='$rate' where c_id='$case'";
     
        $row=$base->getRow($uptSql);
	 if($row>0){
            $base->alert('保存成功');
            if($state=="结单"&&$isMoney<>""){
             $insSql="insert into audit_detail(tel,isMoney,c_id,content) "
                     . "values('$tel','$isMoney','$case','$rate')";
             $row1=$base->getRow($insSql);
             if($row1>0){
                $base->alert('退费信息保存成功');
                
               
             }
             else{
                $base->alert('退费信息保存失败');
                $base->back();
            }
           }
           //$doUrl=$base->doURL("plan", "showTest", $args);//回到待办事项
           $base->loadView("index.php");
         }	
        else{
            $base->alert('保存失败');
            $base->back();
	}
        
       
    }

    /*
     * 批量退订
     *  angelo 重写,多号码批量退订。
     */
    function btch_del(){
        $base=new base(DB_NAME3,DB_CONNECT);//数据库在db_kfasd
        $tel=$base->getVal('tel');//业务电话,以逗号分割
        $Dcity=$base->getval('Dcity');//归属地
        $type=$base->getVal('type');//投诉方式
        $employer=$base->getVal('employer');
        $content=$base->getVal('content');//投诉内容
        $state="结单";
        $array_failtel=array();//失败的sql
        $overdate=date("Y-m-d H:i");
        $arr_tel=explode(",", $tel);
        for($i=0;$i<count($arr_tel);$i++){
            if($arr_tel[$i]<>""){
              $c_id=date("YmdHi").substr($arr_tel[$i],-4);//日期加上号码后4位组成唯一ID
              $var_tel=$arr_tel[$i];
             $var_tel=str_replace(PHP_EOL,"",$var_tel); 
              $insql="insert into "
                . "audit(c_id,c_case,tel,phone,Dfrom,Dcity,Dmod,c_type,content,employer,c_return,deal,overdate,Inputdate,c_state,ModUser) "
                . "values('$c_id','','$var_tel','','','$Dcity','','$type','$content','$employer',"
                . "'','','$overdate',now(),'$state','$employer')";
               $row=$base->getRow($insql);
                if($row>0){
                    //$base->alert('保存成功');
                }
		else{
                    
                    $base->alert('保存失败');
                    array_push($array_failtel, $arr_tel[$i]);
                }	
 
            }
        }
        
    }




    /**
     * 投诉回访单的填写 
	 * angelo 重写,单个号码取消退订退费的投诉单的填写。
     */
	 
    function add(){
        $base=new base(DB_NAME3,DB_CONNECT);//数据库在db_kfasd
        $case=$base->getVal('case');//CRM单号
        $tel=$base->getVal('tel');//业务电话
        $phone=$base->getVal('phone');//联系电话
        $Dcity=$base->getval('Dcity');//归属地
        $Dmod=$base->getval('Dmod');//处理方式
        $Dfrom=$base->getval('Dfrom');//工单来源
        $type=$base->getVal('type');//投诉方式
        $content=$base->getVal('content');//投诉内容
        $contentCall=$base->getVal('contentCall');//回访内容
        $back=$base->getVal('back',false);//退订,退费选择
        $money=$base->getVal('money');//退费金额
        $employer=$base->getVal('employer');//处理客服人员
        $state=$base->getVal('state');//结单状态
        $ModUser=$base->getVal('ModUser');//填单客服人员
        $deal="";//操作结果
        if($state=="结单")
        {
            $deal=count(back)>=2?"退订,退费":"退订";
        }
        
        $overdate=($state=="结单")?date("Y-m-d H:i"):"";
        $c_id=date("YmdHi").substr($tel,-4);//日期加上号码后4位组成唯一ID
        $insql="insert into "
            . "audit(c_id,c_case,tel,phone,Dfrom,Dcity,Dmod,c_type,content,employer,c_return,deal,overdate,Inputdate,c_state,ModUser) "
            . "values('$c_id','$case','$tel','$phone','$Dfrom','$Dcity','$Dmod','$type','$content','$employer',"
            . "'$contentCall','$deal','$overdate',now(),'$state','$ModUser')";
	  
			
         $row=$base->getRow($insql);
	 if($row>0){
            $base->alert('保存成功');
            $base->back_refresh();
	 }
		
        else{
            $base->alert('保存失败');
            $base->back();
	}	  
        


    }
	
	
    /**
     * 投诉回访单的填写 
     */
	 /*
	 2012-06-19，新业务逻辑”退订，退费清单。xls“。进行修改。angelo
    function add(){
        $base=new base;
        $case=$base->getVal('case');//单号
        $tel=$base->getVal('tel');//业务电话
        $phone=$base->getVal('phone');//联系电话
        $type=$base->getVal('type');//投诉方式
        $content=$base->getVal('content');//投诉内容
        $back=$base->getVal('back',false);//退订服务
        $opentype=$base->getVal('opentype');//开通方式
        $employer=$base->getVal('employer');//营销人员编号
        if($back){$back=implode(',',$back);}
        $sql="insert into audit (`case`,tel,phone,`type`,content,back,opentype,employer,dingcase) 
        values ('$case','$tel','$phone','$type','$content','$back','$opentype','$employer','$dingcase')";
		$row=$base->getRow($sql);
		if($row>0){
            $base->alert('保存成功');
            $base->back_refresh();
		}
		else{
            $base->alert('保存失败');
            $base->back();
		}
    }
	*/
    function case_detail(){
        $base=new base;
        $id=$base->getVal('id');
        $sql = "select type,content,back,opentype,`return`,deal,audit,state,employer from audit where id='$id' order by id desc";
        $result=$base->getResult($sql);
        $back=strtr($result['back'],array("1" => "家庭作业", "2" => "知心朋友","3"=>"益智乐园"));
        $state=strtr($result['state'],array("1" =>"需回访","2" =>"已回访","3"=>"已审批","4"=>"已结单"));
        $base->loadView('admin/case_detail',array('result'=>$result,'back'=>$back,'state'=>$state),false);
    }
    function getHistory(){
        $base=new base;
        $tel=$base->getVal('tel');
        $sql='select id,`case`,phone from audit where tel='.$tel.' order by `case` desc';
        $result=$base->getResult($sql,true);
        echo '<div class="table">';
            echo '<div class="tabletop">';
                echo '<h1 style="width:15%;">日期</h1>';
                echo '<h1 style="width:30%;">单号</h1>';
                echo '<h1 style="width:35%;">联系电话</h1>';
                echo '<h1 style="width:10%;">详细</h1>';
            echo '</div>';
        foreach($result as $key=>$val){
            $color=($key%2)?'EEEEEE':'FFFFFF';
            $date=substr($val['case'],0,4).'-'.substr($val['case'],4,2).'-'.substr($val['case'],6,2);
            echo '<div class="tabletr" style="background-color:#'.$color.';">';
                echo '<div class="tabletd" style="width:15%;">'.$date.'</div>';
                echo '<div class="tabletd" style="width:30%;">'.$val['case'].'</div>';
                echo '<div class="tabletd" style="width:35%;">'.$val['phone'].'</div>';
                echo '<div class="tabletd" style="width:10%;">
                        <a class="thickbox" onclick="tb_show(\'newwindow\',\'index.php?c=case&f=case_detail&id='.$val['id'].'&height=400&width=550&modal=true\')" href="#">详情</a>
                      </div>';
            echo '</div>';    
        }
        echo '</div>';
    }  
    
} 
?>