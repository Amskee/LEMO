
var viewData = [];
var ct1 = false;
var playing = false;

var sleep = function(mSec) {
	return new Promise(resolve => setTimeout(resolve, mSec));
};

var cookNode = function(nid, val, blk) {
	nodeDataTem = nodeData.replace("%value%", val).replace(new RegExp("%id%", "g"), nid);
	if(ct1==true) {
		$("#main-block").children().css("left", "0");
		$("#"+blk).prepend(nodeDataTem);
		ct1 = false;
		return	
	}
	$("#"+blk).append(nodeDataTem);
};

var cookNull = function() {
	$("#main-block").append(nodeNullData);
};

var cookPointer = function(pid, val, num, blk) {
	pointerDataTem = pointerData.replace("%val%", val).replace("%id%", pid);
	$("#"+blk+"Block"+num).append(pointerDataTem);
};

var cookAlgo = function(algoName, algoData) {
	$("#algo-block").empty();
	algoNameDataTem = algoNameData.replace("%data%", algoName);
	$("#algo-block").append(algoNameDataTem);
	$("#algo-block").append(algoSnippetData);
	var i = 1;
	algoData.forEach( function(line) {
		var lineDataTem = lineData.replace("%data%", line).replace("%n%", i);
		lineDataTem = lineDataTem.replace("%id%", i++);
		$("#algo-snippet").append(lineDataTem);
	});
};

var lightLine = function(Num) {
	var line = $("#l"+Num);
	if (line.css("background-color") == "rgba(0, 0, 0, 0)")
		line.css("background-color", "yellow");
	else
		line.css("background-color", "white");
};

var limeLight = function(sel) {
	sel = $(sel);
	sel.css({
		transition: "background-color 1s ease-in-out",
		"background-color": "rgb(239, 247, 98)"
	});
	setTimeout(function() {
		sel.css("background-color", "white");
	}, 500);
};

var fadeKill = function(sel) {
	sel = $(sel);
	sel.animate({opacity: "-=90"}, 10000);
	sel.remove();
};

var fadeIn = function(sel) {
	sel = $(sel);
	sel.css("opacity", "0");
	sel.animate({"opacity": "+=100"}, 10000);
};

var initScreen = function() {
	for(var i=1;i<4;i++) $("#eHolder").append(extraBlockData.replace("%id%", i));
	cookPointer(1, "first ↓", "2", "p");
	cookNull();
	cookAlgo("Insert First", algoIF);
};

var quickPaint = function() {
	var delBlocks = ["#pBlock1", "#pBlock2", "#main-block", "#eBlock1", "#eBlock2", "#eBlock3"];
	delBlocks.forEach(function(delBlock) {
		$(delBlock).empty();
	});
	cookPointer(1, "first ↓", "2", "p");
	if (viewData.length==0) {
		cookNull();
		return;
	}
	console.log(viewData);
	viewData.forEach( function(data) {
		cookNode(data.id, data.val, "main-block");
	});
	cookNull();
};

var pushLeft = function() {
	var s1 = $("#pv1");
	var s2 = $("#main-block").children();
	s2.animate({"opacity": "-=100"}, 1000);
	s1.animate({"opacity": "-=100"}, 1000);
	s2.animate({"left": "+=20%"});
	s1.animate({"left": "+=20%"});
	s2.animate({"opacity": "+=100"}, 1000);
	s1.animate({"opacity": "+=100"}, 1000);
};

var playIF = async function(v1) {
	$("#b1").attr("disabled", "disabled");
	ml.updateData();
	if(ml.len()>=5) {
		var w1 = $("#animation-warn");
		w1.show();
		quickPaint();
		cookAlgo("Insert First", algoIF);
		setTimeout(function() {
			w1.css("display", "none");
		}, 10000);
		$("#b1").removeAttr("disabled");
		return;
	}
	cookAlgo("Insert First", algoIF);
	$("#l1").text($("#l1").text().replace("%Element Value%", v1));
	pushLeft();
	await sleep(2000);
	lightLine(1);
	await sleep(1000);
	cookPointer(2, "newnode ↑", 1, "e");
	limeLight("#pv2");
	ct1 = true; //prepend
	cookNode(0, v1, "main-block");
	$("#n0").css("background-image", "none");
	fadeIn("#b0");
	limeLight("#v0");
	await sleep(3000);
	lightLine(1);
	lightLine(2);
	await sleep(1000);
	cookPointer(3, "tem ↓", 1, "p");
	$("#pv3").css("left", "+=20%");
	limeLight("#pv3");
	await sleep(1000);
	lightLine(2);
	lightLine(3);
	await sleep(1000);
	$("#pv1").animate({"left": "-=20%"}, 1000);
	await sleep(1000);
	limeLight("#pv1");
	await sleep(2000);
	lightLine(3);
	lightLine(4);
	$("#n0").css("background-image", "url(./img/arrow2.png)");
	fadeIn("#n0");
	await sleep(1000);
	limeLight(4);
	await sleep(1000);
	fadeKill("#pv2");
	fadeKill("#pv3");
	//await sleep(3000);
	//await sleep(1000);
	quickPaint();
	cookAlgo("Insert First", algoIF);
	$("#b1").removeAttr("disabled");
};

initScreen();

/*$("#pv1").animate({
	"left": "20%"
}, 1000); 
$("#pv1").animate({
	"left": ""
}, 1000);*/

//update
var ml = new list();
var mxl = 4;
var update = function(opt) {
	var v1 = document.querySelector("#v1").value;
	var v2 = document.querySelector("#v2").value;
	var v3 = document.querySelector("#v3").value;
	if(v1=="") {
		if(opt==1 || opt==3 || opt==6) {
			alert("Empty Value");
			return;
		}
	}
	if (opt==5) {
		if(v2=="" || v3=="") {
			alert("Empty value(s)");
			return;
		}
	}
	if (ml.len()==mxl) lsFull();
	switch(opt) {
		case 0: ml.updateData(); break;
		case 1: ml.insertFirst(v1); playIF(v1); break;
		case 2: ml.deleteFirst(); cookAlgo("Delete First", algoDF); break;
		case 3: ml.insertLast(v1); cookAlgo("Insert Last", algoIL); break;
		case 4: ml.deleteLast(); cookAlgo("Delete Last", algoDL); break;
		case 5: ml.insertAfter(v2, v3); cookAlgo("Insert After", algoIA); break;
		case 6: ml.delete(v1); break;
		case 7: ml.deleteAll(); break;
		default: alert('Update failed');
	}
	ml.updateData();
	if(opt!=1) quickPaint();
};
var lsFull = function() {
	console.log("Max allowed list length reached.");
};