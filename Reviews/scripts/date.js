/*##############################################################################
#    ____________________________________________________________________
#   /                                                                    \
#  |               ____  __      ___          _____  /     ___    ___     |
#  |     ____       /  \/  \  ' /   \      / /      /__   /   \  /   \    |
#  |    / _  \     /   /   / / /    /  ___/  \__   /     /____/ /    /    |
#  |   / |_  /    /   /   / / /    / /   /      \ /     /      /____/     |
#  |   \____/    /   /    \/_/    /  \__/  _____/ \__/  \___/ /           |
#  |                                                         /            |
#  |                                                                      |
#  |   Copyright (c) 2000-2007                      All rights reserved   |
#  |   MindStep SCOP SARL                                                 |
#  |                                                                      |
#  |      www.mindstep.com                              www.mjslib.com    |
#  |   info-oss@mindstep.com                           mjslib@mjslib.com  |
#   \____________________________________________________________________/
#
#  [This product is distributed under a BSD-like license]
#  
#  Redistribution and use in source and binary forms, with or without
#  modification, are permitted provided that the following conditions
#  are met:
#  
#     1. Redistributions of source code must retain the above copyright
#        notice, this list of conditions and the following disclaimer.
#  
#     2. Redistributions in binary form must reproduce the above copyright
#        notice, this list of conditions and the following disclaimer in
#        the documentation and/or other materials provided with the
#        distribution. 
#  
#  THIS SOFTWARE IS PROVIDED BY THE MINDSTEP CORP PROJECT ``AS IS'' AND
#  ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
#  THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
#  PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL MINDSTEP CORP OR CONTRIBUTORS
#  BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY,
#  OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT
#  OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR
#  BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
#  WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE
#  OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
#  EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
#  
#  The views and conclusions contained in the software and documentation
#  are those of the authors and should not be interpreted as representing
#  official policies, either expressed or implied, of MindStep Corp.
#  
##############################################################################*/

var gDAT_dflEditingFormat  = "YYYY-MM-DD";
var gDAT_dflStorageFormat  = "YYYY-MM-DD";
var gDAT_fmtAttrName       = "mjsdateformat";
var gDAT_splitter          = "/";
var gDAT_tooltips	       = { day: "Day", month: "Month", year: "Year" };

function _dat_adjustDateFormat(fmt,dfl)
{
	if(mjs_empty(fmt))
	{
		return dfl;
	}
	if(mjs_match(fmt,/DD\/MM\/YYYY/i))
	{
		return "DD/MM/YYYY";
	}
	else if(mjs_match(fmt,/MM\/DD\/YYYY/i))
	{
		return "MM/DD/YYYY";
	}
	else if(mjs_match(fmt,/YYYY\/MM\/DD/i))
	{
		return "YYYY/MM/DD";
	}
	else if(mjs_match(fmt,/YYYY-MM-DD/i))
	{
		return "YYYY-MM-DD";
	}
	else if(mjs_match(fmt,/DD\|MM\|YYYY/i))
	{
		return "DD|MM|YYYY";
	}
	else if(mjs_match(fmt,/MM\|DD\|YYYY/i))
	{
		return "MM|DD|YYYY";
	}
	else if(mjs_match(fmt,/DDMMYYYY/i))
	{
		return "DDMMYYYY";
	}
	else if(mjs_match(fmt,/MMDDYYYY/i))
	{
		return "MMDDYYYY";
	}
	else if(mjs_match(fmt,/YYYYMMDD/i))
	{
		return "YYYYMMDD";
	}
	LOGERROR("unknown date format: <%s> - using default (%s)",fmt,dfl);
	return dfl;
}

function _dat_computeDateFormat(field)
{
	var fmt;

	if(!mjs_valued(fmt=mjs_attr(field,'dteditingfmt')))
	{
		var edfmt,stfmt;

		// Inherit for ancestors
		mjs_inheritAttr(field,gDAT_fmtAttrName);

		// Parses the attribute
		if(mjs_valued(fmt=mjs_attr(field,gDAT_fmtAttrName)))
		{
			var match;

			if(mjs_valued(match=mjs_rextract(fmt,/^(.*):(.*)$/)))
			{
				stfmt=match[1];
				edfmt=match[2];
			}
			else
			{
				stfmt=fmt;
				edfmt=fmt;
			}
		}

		// Make sure those values are ok
		edfmt=_dat_adjustDateFormat(edfmt,gDAT_dflEditingFormat);
		stfmt=_dat_adjustDateFormat(stfmt,gDAT_dflStorageFormat);

		// Final adjustments: replaces mm|dd|yyyy by mm/dd/yyyy in storage
		switch(stfmt)
		{
		case "DD|MM|YYYY":	stfmt="DD/MM/YYYY";break;
		case "MM|DD|YYYY":	stfmt="MM/DD/YYYY";break;
		case "YYYY|MM|DD":	stfmt="YYYY/MM/DD";break;
		}

		// Store them for later use
		field.setAttribute('dteditingfmt',edfmt);
		field.setAttribute('dtstoragefmt',stfmt);
	}
}

function _dat_getEditingFormat(field)
{
	_dat_computeDateFormat(field);
	return mjs_attr(field,"dteditingfmt");
}

function _dat_getStorageFormat(field)
{
	_dat_computeDateFormat(field);
	return mjs_attr(field,"dtstoragefmt");
}

//--------------------------------------------------------------------------------
//
//	This callback is called when the user modify the value of any of the 
//	date fragment. It's beeing used to recompute the complete date field
//	which will be sent to the server-side program once submitted.
//
//--------------------------------------------------------------------------------

function mjs_changedDateField(field,id)
{
	// Find the original date field
	var master=document.getElementById(id);
	var d=document.getElementById(id+"_d");
	var newval;

	if(mjs_valued(d))
	{
		var m=document.getElementById(id+"_m");
		var y=document.getElementById(id+"_y");
		var fmt=_dat_getStorageFormat(master);
		var dt=mjs_formatDateValue({ day:d.value, month:m.value, year:y.value },fmt);
		newval=dt;
	}
	else
	{
		var edFmt=_dat_getEditingFormat(master);
		var stFmt=_dat_getStorageFormat(master);
		var el=document.getElementById(id+"_date");

		if(!mjs_valued(newval=mjs_transformDateValue(el.value,edFmt,stFmt)))
		{
			// There is an error => store the bad value
			newval=el.value;
		}
	}
	LOGDEBUG("date field <%s> changed from <%s> to <%s>",id,master.value,newval);
	master.value=newval;

	// Runs the 'change' callbacks for this object
	mjs_runCallback(master,"change")
}

//--------------------------------------------------------------------------------
//
//	When necessary, replaces the date field by other(s)
//
//--------------------------------------------------------------------------------

function _dat_expandDateField(field)
{
	var	id=mjs_allocateElementID(field);
	var name=field.name;
	var html,dHtml,mHtml,yHtml,dtHtml;

	var edFmt=_dat_getEditingFormat(field);
	var stFmt=_dat_getStorageFormat(field);

	LOGTRACE("register date <%s> with storage: '%s', editing: '%s'",id,stFmt,edFmt);

	if(edFmt==stFmt)
	{
		// Same formats for edition and storage ?
		// => just keeps the date field as it is
		return true;
	}

	// Obtains fragment values
	var dt=mjs_parseDateValue(field.value,stFmt);
	if(!mjs_valued(dt))
	{
		dt={ day:"--", month:"--", year:"----" };
	}

	var start="<input type=textfield ";
	var end="\" onchange=\"mjs_changedDateField(this,'" + id + "')\"";
	var t=gDAT_tooltips;
	var linkid;
	var title=mjs_attr(field,"title");

	title=mjs_valued(title)?" - "+title:"";

	// Replaces ' by its ASCII escape sequence (this value will be used between quotes)
	title=title.replace(/'/g,"&#39;")

	if(!mjs_empty(field.className))
	{
		start += "class='"+field.className+"' ";
	}

	if(field.disabled)
	{
		// Propagate the disabled attribute
		end += " disabled";
	}
	end += ">";

	switch(edFmt)
	{
	case "DD|MM|YYYY":
	case "MM|DD|YYYY":
	case "YYYY|DD|MM":
		LOGDEBUG("splitting date field into 3 fragments");
		dHtml = sprintf("%stitle='%s' maxlength=2 size=2 name=%s id=%s value='%s'%s",
			start,t['day']+title,name+".day",id+'_d',dt['day'],end);
		mHtml = sprintf("%stitle='%s' maxlength=2 size=2 name=%s id=%s value='%s'%s",
			start,t['month']+title,name+".month",id+'_m',dt['month'],end);
		yHtml = sprintf("%stitle='%s' maxlength=4 size=4 name=%s id=%s value='%s'%s",
			start,t['year']+title,name+".year",id+'_y',dt['year'],end);
		break;

	case "DD/MM/YYYY":
	case "MM/DD/YYYY":
	case "YYYY/MM/DD":
	case "YYYY-MM-DD":
	case "DDMMYYYY":
	case "MMDDYYYY":
	case "YYYYMMDD":
		LOGDEBUG("creating a shadow date field for implementing editing format");
		var value=mjs_formatDateValue(dt,edFmt);
		dtHtml = sprintf("%sname=%s size=10 id=%s value='%s'%s",start,name+'.date',id+'_date',value,end);
		linkid = sprintf("%s_date",id);
		break;

	default:
		return false;
	}

	switch(edFmt)
	{
	case "DD|MM|YYYY":
		html=dHtml+gDAT_splitter+mHtml+gDAT_splitter+yHtml;
		linkid = sprintf("%s_d %s_m %s_y",id,id,id);
		break;
	case "MM|DD|YYYY":
		html=mHtml+gDAT_splitter+dHtml+gDAT_splitter+yHtml;
		linkid = sprintf("%s_m %s_d %s_y",id,id,id);
		break;
	case "YYYY|MM|DD":
		html=yHtml+gDAT_splitter+mHtml+gDAT_splitter+dHtml;
		linkid = sprintf("%s_y %s_m %s_d",id,id,id);
		break;
	default:
		html=dtHtml;
		break;
	}

	var root=document.createElement('span');
	root.innerHTML=html;

	// Resize the original field to the minimum because otherwise the layout won't be
	// properly recomputed (moz and IE will keep space for the hidden element)
	field.size=1;

	// Hide the original element
	mjs_hide(field);

	// And links it to sub-field(s)
	mjs_setAttr(field,gMJS_linkidAttrName,linkid);

	// Finally, insert sub-field(s) in the DOM tree
	field.parentNode.insertBefore(root,field);
	return true;
}


//--------------------------------------------------------------------------------
//
//	Extends the form validation API with a few more, date oriented
//
//--------------------------------------------------------------------------------

function _mjs_checkDateConstraint(el,cons,value)
{
	var stFmt=_dat_getStorageFormat(el);
	var edFmt=_dat_getEditingFormat(el);

	LOGTRACE("check date value <%s> with formats <%s:%s>",value,stFmt,edFmt);

	var dt=mjs_parseDateValue(value,stFmt);

	if(value=="")
	{
		return true;
	}

	// Check if we have a date value
	if(!mjs_valued(dt))
	{
		return mjs_formValidationFailed("Date is incorrect");
	}

	// Check if this date value corresponds to an existing day
	var d=dt['day'],m=dt['month']-1,y=dt['year'];
	var date=new Date(y,m,d);

	if((m<0) || (m>11))
	{
		return mjs_formValidationFailed("Month is incorrect");
	}
	if(y<1970)
	{
		return mjs_formValidationFailed("Year is incorrect");
	}
	if(date.getDate()!=d || date.getMonth()!=m || date.getFullYear()!=y)
	{
		// We need to do this test because "mktime" is smart enought to
		// turn dates such as "sep 32" into "oct 1". We don't want this
		// to be done automatically, and we need to report broken dates
		return mjs_formValidationFailed("This date does not exist");
	}

	var v;
	if(mjs_valued(v=cons['min']))
	{
		var cdt=mjs_parseDateExpr(v,stFmt);
		if(mjs_valued(cdt) && cdt>date)
		{
			return mjs_formValidationFailed("This date must be set after %s",mjs_formatDateValue(cdt,edFmt));
		}
	}
	if(mjs_valued(v=cons['max']))
	{
		var cdt=mjs_parseDateExpr(v,stFmt);
		if(mjs_valued(cdt) && cdt<date)
		{
			return mjs_formValidationFailed("This date must be set before %s",mjs_formatDateValue(cdt,edFmt));
		}
	}
	return true;
}

//--------------------------------------------------------------------------------
//
//	Parses the document and convert date fields
//
//--------------------------------------------------------------------------------

function _dat_dateInitialize()
{
	var list=new Array;
	var type,field,i;

	list=mjs_formElementList();
	for(i=list.length-1;i>=0;i--)
	{
		field=list[i];

		if(!mjs_valued(type=mjs_attr(field,gMJS_typeAttrName)))
		{
			continue;
		}
		if(strcasecmp(type,"date"))
		{
			continue;
		}
		_dat_expandDateField(field);
	}
}

mjs_registerConstraintType("date",_mjs_checkDateConstraint,"trim");
mjs_registerModule("date",_dat_dateInitialize);


//--------------------------------------------------------------------------------
//
//	TODO: adjust the following function to make them API-ready
//	(they should manipulate Date objects instead of hand-made hashes)
//
//--------------------------------------------------------------------------------

function mjs_parseDateValue(val,fmt)
{
	var	match;

	if(val=="")
	{
		return { day:"", month:"", year:"" };
	}
	switch(fmt)
	{
	case "DDMMYYYY":
		if(mjs_valued(match=mjs_rextract(val,/^(\d\d)(\d\d)(\d\d\d\d)$/)))
		{
			return { day: match[1]|0, month:match[2]|0, year:match[3]|0 };
		}
		break;
	case "DD/MM/YYYY":
		if(mjs_valued(match=mjs_rextract(val,/^(\d\d?)\/(\d\d?)\/(\d\d\d\d)$/)))
		{
			return { day: match[1]|0, month:match[2]|0, year:match[3]|0 };
		}
		break;
	case "MMDDYYYY":
		if(mjs_valued(match=mjs_rextract(val,/^(\d\d)(\d\d)(\d\d\d\d)$/)))
		{
			return { day: match[2]|0, month:match[1]|0, year:match[3]|0 };
		}
		break;
	case "MM/DD/YYYY":
		if(mjs_valued(match=mjs_rextract(val,/^(\d\d?)\/(\d\d?)\/(\d\d\d\d)$/)))
		{
			return { day: match[2]|0, month:match[1]|0, year:match[3]|0 };
		}
		break;
	case "YYYY/MM/DD":
		if(mjs_valued(match=mjs_rextract(val,/^(\d\d\d\d)\/(\d\d?)\/(\d\d?)$/)))
		{
			return { day: match[3]|0, month:match[2]|0, year:match[1]|0 };
		}
		break;
	case "YYYY-MM-DD":
		if(mjs_valued(match=mjs_rextract(val,/^(\d\d\d\d)-(\d\d?)-(\d\d?)$/)))
		{
			return { day: match[3]|0, month:match[2]|0, year:match[1]|0 };
		}
		break;
	case "YYYYMMDD":
		if(mjs_valued(match=mjs_rextract(val,/^(\d\d\d\d)(\d\d)(\d\d)$/)))
		{
			return { day: match[3]|0, month:match[2]|0, year:match[1]|0 };
		}
		break;
	}
	LOGERROR("failed to parse date <%s> with format <%s>",val,fmt);
	return null;
}

function mjs_parseDateExpr(str,fmt)
{
	if(!strcasecmp(str,"today"))
	{
		return new Date();
	}
	if(!strcasecmp(str,"tomorrow"))
	{
		return new Date().dayOffset(1);
	}
	if(!strcasecmp(str,"yesterday"))
	{
		return new Date().dayOffset(-1);
	}
	var dt=mjs_parseDateValue(str,fmt);
	if(!mjs_valued(dt))
	{
		LOGERROR("date constraint '%s' is incorrect",str);
		return null;
	}
	var d=dt['day'],m=dt['month']-1,y=dt['year'];
	return new Date(y,m,d);
}


function mjs_formatDateValue(dt,fmt)
{
	var d,m,y;

	if(dt.getMonth)
	{
		// This is a Date object
		d=dt.getDate();
		m=dt.getMonth()+1;
		y=dt.getFullYear();
	}
	else
	{
		// This is a hash
		d=dt['day'];
		m=dt['month'];
		y=dt['year'];
	}

	switch(fmt)
	{
	case "DDMMYYYY":	return sprintf("%02d%02d%04d",d,m,y);
	case "DD|MM|YYYY":
	case "DD/MM/YYYY":	return sprintf("%02d/%02d/%04d",d,m,y);
	case "MMDDYYYY":	return sprintf("%02d%02d%04d",m,d,y);
	case "MM|DD|YYYY":
	case "MM/DD/YYYY":	return sprintf("%02d/%02d/%04d",m,d,y);
	case "YYYYMMDD":	return sprintf("%04d%02d%02d",y,m,d);
	case "YYYY|MM|DD":
	case "YYYY/MM/DD":	return sprintf("%04d/%02d/%02d",y,m,d);
	case "YYYY-MM-DD":	return sprintf("%04d-%02d-%02d",y,m,d);
	}

	LOGERROR("failed to format date with unknown format <%s>",fmt);
	return null;
}

function mjs_transformDateValue(str,srcFmt,destFmt)
{
	var dt=mjs_parseDateValue(str,srcFmt);

	if(mjs_valued(dt))
	{
		return mjs_formatDateValue(dt,destFmt);
	}
	return null;
}


//--------------------------------------------------------------------------------
//
//	Public javascript API 
//
//--------------------------------------------------------------------------------

function mjs_setDateFormat(fmt)
{
	gDAT_dflEditingFormat=fmt;
}

function mjs_setDateSplitter(str)
{
	gDAT_splitter=str;
}

function mjs_setDateField(field,value)
{
	var edFmt=_dat_getEditingFormat(field);
	var stFmt=_dat_getStorageFormat(field);
	var	id=mjs_allocateElementID(field);

	if(edFmt == stFmt)
	{
		// There is no shoadowed field
		field.value=value;
		return;
	}

	var dt=mjs_parseDateValue(value,stFmt);
	if(!mjs_valued(dt))
	{
		return;
	}

	var d=document.getElementById(id+"_d");

	if(mjs_valued(d))
	{
		var m=document.getElementById(id+"_m");
		var y=document.getElementById(id+"_y");

		d.value=dt['day'];
		m.value=dt['month'];
		y.value=dt['year'];
	}
	else
	{
		var el=document.getElementById(id+"_date");
		el.value=mjs_transformDateValue(value,edFmt,stFmt);
	}
	mjs_runCallback(field,"change")
}


//--------------------------------------------------------------------------------
//
//	Date class extensions
//
//--------------------------------------------------------------------------------

function mjs_date_dayOffset(count)
{
	this.setDate(this.getDate()+count);
	return this;
}

Date.prototype.dayOffset=mjs_date_dayOffset;


