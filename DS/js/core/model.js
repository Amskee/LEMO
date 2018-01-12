
var nodeValue = "<div class='node-value' id='v%id%'>%value%</div>";
var nodeNext = "<div class='node-next' id='n%id%'><div class='next-block' id='nb%id%'></div><div class='next-arrow' id='na%id%'></div></div>";
var nodeData = "<div class='node-block' id='b%id%'>"+nodeValue+nodeNext+"</div>";
var extraBlockData = "<div class='extras' id='eBlock%id%'></div>";

var nodeNullData = "<div class='node-block'><div class='node-null'>Null</div></div>"

var pointerData = "<div class='pointer-var' id='pv%id%'>%val%</div>";

var algoNameData = "<div id='algo-name'>Function %data%():</div>";
var algoSnippetData = "<div id='algo-snippet'></div>";
var lineData = "<div class='algo-line'><pre id='l%id%'>%n%. %data%</pre></div>";

var algoIF = [ //insert first
	"newnode = new node(data) //data=Element Value",
	"tem = first", 
	"first = newnode",
	"first.next = tem"
];

var algoIL = [ //insert last
	"newnode = new node(data) //data=Element Value",
	"if (first==null)",
	"	first = newnode",
	"	return",
	"tem = first",
	"while (tem.next!=null)",
	"	tem = tem.next",
	"tem.next = newnode"
];

var algoIA = [ //insert after
	"newnode = new node(data) //data=Element Value",
	"tem = first",
	"while (tem.value!=(afterData) //afterData=After Element Value",
	"	if (tem.next==null)",
	"		tem.next = newnode",
	"		return",
	"tem2 = tem.next",
	"newnode.next = tem2",
	"tem.next = newnode"
];

var algoDF = [ //delete first
	"if(first==null)",
	"	return",
	"if (first.next==null)",
	"	first = null",
	"else",
	"	first = first.next"
];

var algoDL = [ //delete last
	"tem = first",
	"if (tem==null)",
	"	return",
	"if (tem.next==null)",
	"	first = null",
	"	return",
	"while (tem.next.next!=null)",
	"	tem = tem.next",
	"tem.next = null"
];