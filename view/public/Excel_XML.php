<?php
class Excel_XML
{

    /** �����ļ�ͷ*/
    private $header = "<?xml version=\"1.0\" encoding=\"GBK\"?\>
    <Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\"
    xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
    xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\"
    xmlns:html=\"http://www.w3.org/TR/REC-html40\">";

    /** �����ļ�β*/
    private $footer = "</Workbook>";

    /** �����ļ�ÿ������*/
    private $lines = array ();

    /** �����ļ�����,Ĭ��Table1*/
    private $worksheet_title = "Table1";

    /**
     * ���һ������
     * @array һά����
     */
    public function addRow ($array)
    {
        $cells = "";//EXCEL��

        foreach ($array as $k => $v):

            $cells .= "<Cell><Data ss:Type=\"String\">" . $v . "</Data></Cell>\n";

        endforeach;
        
        $this->lines[] = "<Row>\n" . $cells . "</Row>\n";
    }

    /**
     * ���һ����ά��������ݵ��ı�
     * @array  ��ά����
     */
    public function addArray ($array)
    {
        foreach ($array as $k => $v):
            $this->addRow ($v);
        endforeach;
    }

    /**
     * �����ļ�����
     * @title �Զ����ļ�����
     */
    public function setWorksheetTitle ($title)
    {
        $title = preg_replace ("/[\\\|:|\/|\?|\*|\[|\]]/", "", $title);
        $title = substr ($title, 0, 31);
        $this->worksheet_title = $title;
    }

    /**
     * ���ɲ��Զ�����excel
     * @filename �ļ�����������׺��
     * @path �洢·��,���ڸ�Ŀ¼
     */
    function saveGenerate ($filename,$path)
    {
        //�����ļ�����ʽΪ����ʼ����-�������ڡ����ı��ļ�������д��XML��ʽ����ת����excel����
        $dir=BASE_PATH.$path;//Ŀ¼·��
        $path=$dir.'/'.$filename.'.txt';//�ļ�·��
        if(!file_exists($dir)){//����Ŀ¼
            mkdir($dir);
        }
        $excel_path=substr($path,0,-4).'.xls';//EXCEL·��
        if(file_exists($path)){unlink($path);}//ɾ���ظ��ļ�
        if(file_exists($excel_path)){unlink($excel_path);}//ɾ���ظ�EXCEL
        file_put_contents($path,stripslashes ($this->header),FILE_APPEND);
        file_put_contents($path,"\n<Worksheet ss:Name=\"" . $this->worksheet_title . "\">\n<Table>\n",FILE_APPEND);
        file_put_contents($path,"<Column ss:Index=\"1\" ss:AutoFitWidth=\"0\" ss:Width=\"110\"/>\n",FILE_APPEND);
        foreach($this->lines as $val){
            file_put_contents($path,$val,FILE_APPEND);    
        }
        file_put_contents($path,"</Table>\n</Worksheet>\n",FILE_APPEND);
        file_put_contents($path,$this->footer,FILE_APPEND);
        rename($path,$excel_path);//��������ʽ
        return $excel_path;
    }
     /**
     * ���ɲ���ʾ�û�����excel
     * @filename �ļ�����������׺��
     */
    function tipGenerate($filename){
        //��ʾ�û��Ƿ񱣴��ļ�
        header("Content-Type: application/vnd.ms-excel; charset=GBK");
        header("Content-Disposition: inline; filename=\"" . $filename . ".xls\"");
        echo stripslashes ($this->header);
        echo "\n<Worksheet ss:Name=\"" . $this->worksheet_title . "\">\n<Table>\n";
        echo "<Column ss:Index=\"1\" ss:AutoFitWidth=\"0\" ss:Width=\"110\"/>\n";
        echo implode ("\n", $this->lines);
        echo "</Table>\n</Worksheet>\n";
        echo $this->footer;
        
    }
    
    
}
?>