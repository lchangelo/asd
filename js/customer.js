	//this js file is defined by admin programmer,the most function is about ICONS shows 
    function login_on(obj){//login onmouseover
	   obj.src="images/login1.gif";
    }
	function login_out(obj){//login onmouseout
	   obj.src="images/login.gif";
    }
	function reset_on(obj){
	   obj.src="images/rest1.gif";
    }
	function reset_out(obj){
	   obj.src="images/rest.gif";
    }
   	function login_check(){//this function need jquery support
	   var userId=$("#userId").val();
       var password=$("#pass1").val();
		if(userId==null||userId==''||userId==' '){
            $("#error")[0].innerText="请输入您的用户名";
            return false;
		} 
        if(password==null||password==''||password==' '){
            $("#error")[0].innerText="请输入您的密码";
            return false;
		}
		return true;
	}
    function report_on(obj){
        obj.src="images/dk2.gif";
    }
    function report_out(obj){
        obj.src="images/dk1.gif";
    }
    function unreport_on(obj){
        obj.src="images/dkx2.gif";
    }
    function unreport_out(obj){
        obj.src="images/dkx1.gif";
    }
    function submit_on(obj){
        obj.src="images/t1.gif";
    }
    function submit_out(obj){
        obj.src="images/tj1.gif";
    }
    function return_on(obj){
        obj.src="images/f2.gif";
    }
    function return_out(obj){
    obj.src="images/f1.gif";
    }
    function open_on(obj){
        obj.src="images/kt2.gif";
    }
    function open_out(obj){
        obj.src="images/kt1.gif";
    }
    function allopen_on(obj){
        obj.src="images/qb2.gif";
    }
    function allopen_out(obj){
        obj.src="images/qb1.gif";
    }
    /*this function is used by check the invalid  input,
     add param like ('check_input_id1','error_msg1','check_input_id2','error_msg2',...)*/
    function check(){
        var nums = arguments.length;//the param nums
        for (i=0;i< nums;i++){      // get each param
            if(!(i%2)){
                if(arguments[i]=='editor'){
                    val=p_desc.document.getBody().getText(); 
                }
                else{
                    val=$("#"+arguments[i]).val();
                }
                if(val==null||val.replace(/^\s\s*/,'').replace(/\s\s*$/,'')==''){
                    alert(arguments[i+1]);
                    return false;
                }
            }
        }
        return true;
    }