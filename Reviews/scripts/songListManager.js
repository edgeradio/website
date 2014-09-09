// JavaScript Document
// Functions for managing the List of songs on the Album Review Form.
// Author: Tristan Garland

function removeCode(str)
{
	
	var newStr= str.replace(/</g,"&lt;");
	newStr = newStr.replace(/>/g,"&gt;");
	return(newStr);
}

function countSongs()
{
	var songList = this.document.getElementById("songs");
	var songsArray = songList.value.split("<");
	return ((songsArray.length));
}



function addSong(title,mood,energy,sc1,sc2,sc3,language,notes)
{

	if (countSongs() <= 5)
	{
		if (title == "")
		{
			alert("You Must Enter a track name");
		}
		else
		{
			var songslist = this.document.getElementById("songs")
			if (sc1 == "Please select")
				sc1 = "";
			if (sc2 == "Please select")
				sc2 = "";
			if (sc3 == "Please select")
				sc3 = "";
		
		
			title = removeCode(title);
			notes = removeCode(notes);
			var record= title + ">" + mood + ">" + energy + ">" + sc1 + ">" + sc2 + ">" + sc3 + ">" + language + ">" + notes +"<";
			songslist.value += record;
			printList();
		}
	}
	else
		alert("You can only add upto 5 Songs");
}


function deleteSong(songNum)
{
		var songList = this.document.getElementById("songs");
		var songsArray = songList.value.split("<");
		var len = songsArray.length - 1;
				

		var newList = "";
		for (var i = 0; i < len; i++)
		{
			
			if (i != songNum)
			{
				newList += songsArray[i];
				newList += "<";
			}
		}
		
		songList.value = newList;
		printList();	
}

function printSong(songString,num)
{
	var song = songString.split(">");
	returnString = "<tr>"+
		"<td width=\"100%\">"+
			"<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"5\" bgcolor=\"#CCCCCC\">"+
				"<tr height=\"8\">"+
					"<td  align=\"left\" width=\"67%\" bgcolor=\"#EEEEEE\">"+
						"<b>Song: </b>" + song[0] + 
					"</td>"+
					"<td align=\"right\" width=\"33%\" bgcolor=\"#EEEEEE\">" + 
						"<input type=\"button\" name=\"Delete\" value=\"Delete\" onClick=\"deleteSong("+ num+ ")\" />" + 
					"</td>"+
				"</tr>"+
				"<tr>"+
					"<td width=\"64%\"  align=\"left\" valign=\"top\">" +
						"<b>Mood:</b> " + song[1] + "<br />" +
						"<b>Energy:</b> " +song[2] + "<br />" +
						"<b>Course Language:</b> " + song[6] + "<br />" +
					"</td>"+
					"<td align=\"left\" width=\"33%\">"+
						"<b>Genre Descriptors</b><br />" +
						song[3] + "<br />" +
						song[4] + "<br />" + 
						song[5] + "<br />" +
					"</td>"+
				"</tr>"+
			"</table>"+
		"</td>"+
	"</tr>"
	return (returnString);
}


function printList()
{

	var songList = this.document.getElementById("songs").value;
	var songDisplay = this.document.getElementById("songDisplay");
	var songsArray = songList.split("<");
	var len = songsArray.length - 1;
	var content = "<table width=\"495\" cellspacing=\"5\" cellpadding=\"5\" border=\"0\">";
	
	for (var i=0;i<len;i++)
	{
		content += printSong(songsArray[i],i);
	}
	
	content +="</table>";
	songDisplay.innerHTML = content;
	
}
