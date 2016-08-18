<?php
class Excel_XML
{

    /** 定义文件头*/
    private $header = "<?xml version=\"1.0\" encoding=\"GBK\"?\>
    <Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\"
    xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
    xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\"
    xmlns:html=\"http://www.w3.org/TR/REC-html40\">";

    /** 定义文件尾*/
    private $footer = "</Workbook>";

    /** 定义文件每行内容*/
    private $lines = array ();

    /** 定义文件标题,默认Table1*/
    private $worksheet_title = "Table1";

    /**
     * 添加一行数据
     * @array 一维数组
     */
    public function addRow ($array)
    {
        $cells = "";//EXCEL列

        foreach ($array as $k => $v):

            $cells .= "<Cell><Data ss:Type=\"String\">" . $v . "</Data></Cell>\n";

        endforeach;
        
        $this->lines[] = "<Row>\n" . $cells . "</Row>\n";
    }

    /**
     * 添加一个二维数组的内容到文本
     * @array  二维数组
     */
    public function addArray ($array)
    {
        foreach ($array as $k => $v):
            $this->addRow ($v);
        endforeach;
    }

    /**
     * 设置文件标题
     * @title 自定义文件标题
     */
    public function setWorksheetTitle ($title)
    {
        $title = preg_replace ("/[\\\|:|\/|\?|\*|\[|\]]/", "", $title);
        $title = substr ($title, 0, 31);
        $this->worksheet_title = $title;
    }

    /**
     * 生成并自动保存excel
     * @filename 文件名，不带后缀名
     * @path 存储路径,基于根目录
     */
    function saveGenerate ($filename,$path)
    {
        //创建文件名格式为“起始日期-结束日期”的文本文件，往里写入XML格式，再转换成excel保存
        $dir=BASE_PATH.$path;//目录路径
        $path=$dir.'/'.$filename.'.txt';//文件路径
        if(!file_exists($dir)){//创建目录
            mkdir($dir);
        }
        $excel_path=substr($path,0,-4).'.xls';//EXCEL路径
        if(file_exists($path)){unlink($path);}//删除重复文件
        if(file_exists($excel_path)){unlink($excel_path);}//删除重复EXCEL
        file_put_contents($path,stripslashes ($this->header),FILE_APPEND);
        file_put_contents($path,"\n<Worksheet ss:Name=\"" . $this->worksheet_title . "\">\n<Table>\n",FILE_APPEND);
        file_put_contents($path,"<Column ss:Index=\"1\" ss:AutoFitWidth=\"0\" ss:Width=\"110\"/>\n",FILE_APPEND);
        foreach($this->lines as $val){
            file_put_contents($path,$val,FILE_APPEND);    
        }
        file_put_contents($path,"</Table>\n</Worksheet>\n",FILE_APPEND);
        file_put_contents($path,$this->footer,FILE_APPEND);
        rename($path,$excel_path);//重命名格式
        return $excel_path;
    }
     /**
     * 生成并提示用户保存excel
     * @filename 文件名，不带后缀名
     */
    function tipGenerate($filename){
        //提示用户是否保存文件
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