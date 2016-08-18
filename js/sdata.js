function HS_DateAdd(interval,number,date){
	number = parseInt(number);
	if (typeof(date)=="string"){var date = new Date(date.split("-")[0],date.split("-")[1],date.split("-")[2])}
	if (typeof(date)=="object"){var date = date}
	switch(interval){
	case "y":return new Date(date.getFullYear()+number,date.getMonth(),date.getDate()); break;
	case "m":return new Date(date.getFullYear(),date.getMonth()+number,checkDate(date.getFullYear(),date.getMonth()+number,date.getDate())); break;
	case "d":return new Date(date.getFullYear(),date.getMonth(),date.getDate()+number); break;
	case "w":return new Date(date.getFullYear(),date.getMonth(),7*number+date.getDate()); break;
	}
}
function checkDate(year,month,date){
	var enddate = ["31","28","31","30","31","30","31","31","30","31","30","31"];
	var returnDate = "";
	if (year%4==0){enddate[1]="29"}
	if (date>enddate[month]){returnDate = enddate[month]}else{returnDate = date}
	return returnDate;
}

function WeekDay(date){
	var theDate;
	if (typeof(date)=="string"){theDate = new Date(date.split("-")[0],date.split("-")[1],date.split("-")[2]);}
	if (typeof(date)=="object"){theDate = date}
	return theDate.getDay();
}
function HS_calender(){
	var lis = "";
	var style = "";
	style +="<style type='text/css'>";
	style +=".calender { width:170px; height:auto; font-size:12px; margin-right:14px; background-color:#F8F8FF; border:1px solid #397EAE; padding:1px}";
	style +=".calender ul {list-style-type:none; margin:0; padding:0;}";
	style +=".calender .day { background-color:#E0FFFF; height:20px;}";
	style +=".calender .day li,.calender .date li{ float:left; width:14%; height:20px; line-height:20px; text-align:center}";
	style +=".calender li a { text-decoration:none; font-family:Tahoma; font-size:11px; color:#333}";
	style +=".calender li a:hover { color:#f30; text-decoration:underline}";
	style +=".calender li a.hasArticle {font-weight:bold; color:#f60 !important}";
	style +=".selectThisYear a, .selectThisMonth a{text-decoration:none; margin:0 2px; color:#000; font-weight:bold}";
	style +=".calender .LastMonth, .calender .NextMonth{ text-decoration:none; color:#000; font-size:18px; font-weight:bold; line-height:16px;}";
	style +=".calender .LastMonth { float:left;font-size:12px;}";
	style +=".calender .NextMonth { float:right;font-size:12px;}";
	style +=".calenderBody {clear:both}";
	style +=".calenderTitle {text-align:center;height:20px; line-height:20px; clear:both}";
	style +=".today { background-color:#ffffaa;border:1px solid #f60; padding:2px}";
	style +=".today a { color:#f30; }";
	style +=".calenderBottom {clear:both; border-top:1px solid #ddd; padding: 3px 0; text-align:left}";
	style +=".calenderBottom a {text-decoration:none; margin:2px !important; font-weight:bold; color:#000}";
	style +=".calenderBottom a.closeCalender{float:right}";
	style +=".closeCalenderBox {float:right; border:1px solid #000; background:#fff; font-size:9px; width:11px; height:11px; line-height:11px; text-align:center;overflow:hidden; font-weight:normal !important}";
	style +="</style>";

	var now,now_y,now_m,now_d;
	if (typeof(arguments[0])=="string"){
		selectDate = arguments[0].split("-");
		var year = selectDate[0];
		var month = parseInt(selectDate[1])-1+"";
		var date = selectDate[2];
		now = new Date(year,month,date);
	}else if (typeof(arguments[0])=="object"){
		now = arguments[0];
	}
    now_y=now.getFullYear();
    now_m=now.getMonth();
    now_d=now.getDate();

	var lastMonthEndDate = HS_DateAdd("d","-1",now_y+"-"+now_m+"-01").getDate();
	var lastMonthDate = WeekDay(now_y+"-"+now_m+"-01");
	var thisMonthLastDate = HS_DateAdd("d","-1",now_y+"-"+(parseInt(now_m)+1).toString()+"-01");
	var thisMonthEndDate = thisMonthLastDate.getDate();
	var thisMonthEndDay = thisMonthLastDate.getDay();
	var todayObj = new Date();
	today = todayObj.getFullYear()+"-"+todayObj.getMonth()+"-"+todayObj.getDate();
	
	for (i=0; i<lastMonthDate; i++){  // Last Month's Date
		lis = "<li></li>" + lis;
		lastMonthEndDate--;
	}
    var k,m,t_m;
    m=parseInt(now_m)+1+"";
    if(m.length==1){
        t_m='0'+m;
    }else{
        t_m=m;
    }
    
	for (i=1; i<=thisMonthEndDate; i++){ // Current Month's Date
        if((i+"").length==1){
            k='0'+i;
        }else{
            k=i;
        }
		if(today == now_y+"-"+now_m+"-"+i){
			var todayString = now_y+"-"+t_m+"-"+k;
			lis += "<li><a href=javascript:void(0) class='today' onclick='_selectThisDay(this)' title='"+now_y+"-"+t_m+"-"+k+"'>"+i+"</a></li>";
		}else{
			lis += "<li><a href=javascript:void(0) onclick='_selectThisDay(this)' title='"+now_y+"-"+t_m+"-"+k+"'>"+i+"</a></li>";
		}
		
	}

	lis += style;

	var CalenderTitle = "<a href='javascript:void(0)' class='NextMonth' onclick=HS_calender(HS_DateAdd('m',1,'"+now_y+"-"+now_m+"-"+now_d+"'),this) style='color: blue;'>下月</a>";
	CalenderTitle += "<a href='javascript:void(0)' class='LastMonth' onclick=HS_calender(HS_DateAdd('m',-1,'"+now_y+"-"+now_m+"-"+now_d+"'),this) style='color: blue;'>上月</a>";
	CalenderTitle += "<span class='selectThisYear'><a href='javascript:void(0)' onclick='CalenderselectYear(this,"+now_y+")' title='点击这里选择其他年份' style='color: blue;'>"+now_y+"</a></span>年<span class='selectThisMonth'><a href='javascript:void(0)' onclick='CalenderselectMonth(this)' title='点击这里选择其他月份' style='color: blue;'>"+(parseInt(now_m)+1).toString()+"</a></span>月"; 

	if (arguments.length>1){
		arguments[1].parentNode.parentNode.getElementsByTagName("ul")[1].innerHTML = lis;
		arguments[1].parentNode.innerHTML = CalenderTitle;

	}else{
	   
		var CalenderBox = style+"<div class='calender'><div class='calenderTitle'>"+CalenderTitle+"</div><div class='calenderBody'><ul class='day'><li>日</li><li>一</li><li>二</li><li>三</li><li>四</li><li>五</li><li>六</li></ul><ul class='date' id='thisMonthDate'>"+lis+"</ul></div><div class='calenderBottom'><a href='javascript:void(0)' class='closeCalender' onclick='closeCalender(this)' style='color: blue;'>关闭</a><span><span><a href=javascript:void(0) onclick='_selectThisDay(this)' title='"+todayString+"' style='color: blue;'>今天</a></span></span></div></div>";
		return CalenderBox;
	}
}

function _selectThisDay(d){
	var boxObj = d.parentNode.parentNode.parentNode.parentNode.parentNode;
		boxObj.targetObj.value = d.title;
		boxObj.parentNode.removeChild(boxObj);
}
function closeCalender(d){
	var boxObj = d.parentNode.parentNode.parentNode;
		boxObj.parentNode.removeChild(boxObj);
}


function CalenderselectYear(obj,year){
		var opt = "";
		var thisYear = obj.innerHTML;
        var pre=year-15;
        var pre_end=year-1;
        var next=year+1;
        var next_end=year+15;
        
		for (i=pre; i<=pre_end; i++){
            opt += "<option value="+i+">"+i+"</option>";
		}
        opt += "<option value="+year+" selected>"+year+"</option>";
        for (i=next; i<=next_end; i++){
            opt += "<option value="+i+">"+i+"</option>";
		}
        
		opt = "<select onblur='selectThisYear(this)' onchange='selectThisYear(this)' style='font-size:11px'>"+opt+"</select>";
		obj.parentNode.innerHTML = opt;
}

function selectThisYear(obj){
	HS_calender(obj.value+"-"+obj.parentNode.parentNode.getElementsByTagName("span")[1].getElementsByTagName("a")[0].innerHTML+"-1",obj.parentNode);
}

function CalenderselectMonth(obj){
		var opt = "";
		var thisMonth = obj.innerHTML;
		for (i=1; i<=12; i++){
			if (i==thisMonth){
				opt += "<option value="+i+" selected>"+i+"</option>";
			}else{
				opt += "<option value="+i+">"+i+"</option>";
			}
		}
		opt = "<select onblur='selectThisMonth(this)' onchange='selectThisMonth(this)' style='font-size:11px'>"+opt+"</select>";
		obj.parentNode.innerHTML = opt;
}
function selectThisMonth(obj){
	HS_calender(obj.parentNode.parentNode.getElementsByTagName("span")[0].getElementsByTagName("a")[0].innerHTML+"-"+obj.value+"-1",obj.parentNode);
}
/** when only==true Calender will only to month  */
function HS_setDate(inputObj,only){
	var calenderObj = document.createElement("span");
    if(typeof(only)=='undefined'){only=false;}
    if(only==false){
        calenderObj.innerHTML = HS_calender(new Date());        
    }
    else{
        calenderObj.innerHTML = HS_calender_to_month(new Date());        
    }
    calenderObj.style.position = "absolute";
    calenderObj.targetObj = inputObj;
    inputObj.parentNode.insertBefore(calenderObj,inputObj.nextSibling);
}
/** under function is about only to month */
function HS_calender_to_month(){
	var lis = "";
	var style = "";
	style +="<style type='text/css'>";
	style +=".calender { width:170px; height:auto; font-size:12px; margin-right:14px; background-color:#F8F8FF; border:1px solid #397EAE; padding:1px}";
	style +=".calender ul {list-style-type:none; margin:0; padding:0;}";
	style +=".calender .day { background-color:#EDF5FF; height:20px;}";
	style +=".calender .day li,.calender .date li{ float:left; width:22%; height:20px; line-height:20px; text-align:center}";
	style +=".calender li a { text-decoration:none; font-family:Tahoma; font-size:11px; color:#333}";
	style +=".calender li a:hover { color:#f30; text-decoration:underline}";
	style +=".calender li a.hasArticle {font-weight:bold; color:#f60 !important}";
	style +=".selectThisYear a, .selectThisMonth a{text-decoration:none; margin:0 2px; color:#000; font-weight:bold}";
	style +=".calenderBody {clear:both}";
	style +=".calenderTitle {text-align:center;height:20px; line-height:20px; clear:both}";
	style +=".today { background-color:#ffffaa;border:1px solid #f60; padding:2px}";
	style +=".today a { color:#f30; }";
	style +=".calenderBottom {clear:both; border-top:1px solid #ddd; padding: 3px 0; text-align:left}";
	style +=".calenderBottom a {text-decoration:none; margin:2px !important; font-weight:bold; color:#000}";
	style +=".calenderBottom a.closeCalender{float:right}";
	style +=".closeCalenderBox {float:right; border:1px solid #000; background:#fff; font-size:9px; width:11px; height:11px; line-height:11px; text-align:center;overflow:hidden; font-weight:normal !important}";
	style +="</style>";

	var now,now_y,now_m;
	if (typeof(arguments[0])=="string"){
		selectDate = arguments[0].split("-");
		var year = selectDate[0];
		var month = parseInt(selectDate[1])-1+"";
		var date = selectDate[2];
		now = new Date(year,month,date);
	}else if (typeof(arguments[0])=="object"){
		now = arguments[0];
	}
    now_y=now.getFullYear();
    now_m=now.getMonth()+1;
    
	for (i=1; i<=12; i++){ // Current Month
        if((i+"").length==1){
            k='0'+i;
        }else{
            k=i;
        }
		if(i == now_m){
			lis += "<li><a href=javascript:void(0) class='today' onclick='_selectThisDay(this)' title='"+now_y+"-"+k+"'>"+i+"</a></li>";
		}else{
			lis += "<li><a href=javascript:void(0) onclick='_selectThisDay(this)' title='"+now_y+"-"+k+"'>"+i+"</a></li>";
		}
	}
	lis += style;
	var CalenderTitle= "<span class='selectThisYear'><a href='javascript:void(0)' onclick='CalenderselectYearToMonth(this,"+now_y+","+now_m+")' title='点击这里选择其他年份' style='color: blue;'>"+now_y+"</a></span>年"; 
	if (arguments.length>1){
		arguments[1].parentNode.parentNode.getElementsByTagName("ul")[0].innerHTML = lis;
		arguments[1].parentNode.innerHTML = CalenderTitle;
	}else{
	    var CalenderBox = style+"<div class='calender'><div class='calenderTitle'>"+CalenderTitle+"</div><div class='calenderBody'><ul class='date' id='thisMonthDate'>"+lis+"</ul></div><div class='calenderBottom'><a href='javascript:void(0)' class='closeCalender' onclick='closeCalender(this)' style='color: blue;'>关闭</a></div></div>";
        return CalenderBox;
	}
}
function CalenderselectYearToMonth(obj,year,mon){
		var opt = "";
		var thisYear = obj.innerHTML;
        var pre=year-15;
        var pre_end=year-1;
        var next=year+1;
        var next_end=year+15;
        
		for (i=pre; i<=pre_end; i++){
            opt += "<option value="+i+">"+i+"</option>";
		}
        opt += "<option value="+year+" selected>"+year+"</option>";
        for (i=next; i<=next_end; i++){
            opt += "<option value="+i+">"+i+"</option>";
		}
        
		opt = "<select onblur='selectThisYearToMonth(this,"+mon+")' onchange='selectThisYearToMonth(this,"+mon+")' style='font-size:11px'>"+opt+"</select>";
		obj.parentNode.innerHTML = opt;
}

function selectThisYearToMonth(obj,mon){
	HS_calender_to_month(obj.value+"-"+mon+"-1",obj.parentNode);
}
