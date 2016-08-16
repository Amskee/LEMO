<?php
session_start();
?>
<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./css/normalize.css">
	<link rel="stylesheet" href="./css/style.css">


	<style>
	#linkedlistmain
	{
		float: left;
		width: 200px;
		height: 40px;
		background-color: #000066;
		position: absolute;
		margin-top: -40px;
	}
	#maininside
	{
		float:left;
		margin:10px;
		color: white;
		font: 20px  Helvetica; 
	}
	#orangeheads
	{
		float: left;
		width: 200px;
		height: 40px;
		background-color: #ff471a;
		color: white;
		line-height: 40px;
		font: Helvetica;
	}
	#header
	{
		width: 100%;
		height:100px;
	}
	#headerbelow
	{
		width: 100%;
		height: 100px;
	}
	#sidehead
	{
		float: left;
		width: 40%;
		height: 50px;
	}
	#mainhead
	{
		float: left;
		width: 60%;
		height: 50px;
	}
	#sidebar
	{
		float:left;
		width:40%;
	}
	#mainholder
	{
		float:left;
		width:57%;
		height:600px;
		text-align: center;
		margin-top: 40px;
		margin-right: 3%;
	}
	#listholder
	{
		width: 100%;
		height: 70px;
	}
	.nm
	{
		float: left;
		width: 10%;
		height: 30px;
		line-height: 30px;
		margin-top: 15px;
		background-color: white;
		-webkit-box-shadow:inset 0px 0px 0px 1px #000000;
		-moz-box-shadow:inset 0px 0px 0px 1px #000000;
		box-shadow:inset 0px 0px 0px 1px #000000;
	}
	.nn
	{
		float:left;
		width: 4%;
		height: 30px;
		margin-top: 15px;
		background-color: white;
		line-height: 30px;
		-webkit-box-shadow:inset 0px 0px 0px 1px #000000;
		-moz-box-shadow:inset 0px 0px 0px 1px #000000;
		box-shadow:inset 0px 0px 0px 1px #000000;
	}
	.na
	{
		float: left;
		min-width: 6%;
		height: 30px;
		margin-top: 15px;
		background-image: url("./arrow.png");
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}

</style>
</head>
<body>
	<div id="linkedlistmain"><div id="maininside">Amskee #5</div></div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="./js/index.js"></script>
    <div id='header'>
    	<h1><b>Linked List Emulator</b></h1>
    </div>
    <div id="headerbelow">
    	<div id="sidehead"><div id="orangeheads">&nbsp;&nbsp;<b>OPERATIONS :</b></div></div>
    	<div id="mainhead"><div id="orangeheads">&nbsp;&nbsp;<b>LIST VISUAL :</b></div></div>
    </div>
	<div id="sidebar">
		
		<h1>INSERT BASICS</h1>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label>
				<input id="fname" type="text" placeholder="Enter Value" name="iv">
				<span>Enter Value</span>
			</label>
			<input type="hidden" name="opt" value="1">
			<input type="submit" name="submit" value="Insert First">
		</form>


		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label>
				<input id="fname" type="text" placeholder="Enter Value" name="iv">
				<span>Enter Value</span>
			</label>
			<input type="hidden" name="opt" value="3">
			<input type="submit" name="submit" value="Insert Last">
		</form>

		<h1>DELETE BASICS</h1>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label>
				<input type="hidden" name="opt" value="4">
				<span></span>
			</label>
			<input type="submit" name="submit" value="Delete First">
		</form>


		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label>
				<input type="hidden" name="opt" value="6">
				<span></span>
			</label>
			<input type="submit" name="submit" value="Delete Last">
		</form>
		
		<h1>OTHERS</h1>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label>
				<input id="fname" type="text" placeholder="Insert After" name="iav">
				<span>Insert After</span>
			</label>
			<label>
				<input id="fname" type="text" placeholder="Enter Value" name="iv">
				<span>Enter Value</span>
			</label>
			<input type="hidden" name="opt" value="2">
			<input type="submit" name="submit" value="Insert After">
		</form>

		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label>
				<input id="fname" type="text" placeholder="Enter Value" name="dav">
				<span>Enter Value</span>
			</label>
			<input type="hidden" name="opt" value="5">
			<input type="submit" name="submit" value="Delete After">
		</form>

		
	</div>
</body>

</html>

<?php
if(isset($_POST['submit']))
{
	$f=$_SESSION['plink'];
	
	$opt=$_POST['opt'];
	switch($opt)
	{
		case 1:
		insertf($_POST['iv']);
		break;
		case 2:
		insertany($_POST['iav'],$_POST['iv']);
		break;
		case 3:
		insertl($_POST['iv']);
		break;
		case 4:
		deletef();
		break;
		case 5:
		deleteany($_POST['dav']);
		break;
		case 6:
		deletel();
		break;
		default :echo "rrrr";
	}

	$_SESSION['plink']=$f;	
}
else
{
	$f=new node(NULL);
	$_SESSION['plink']=$f;
}

console();

class node
{
	public $x;
	public $next;
	function __construct($x)
	{
		$this->x=$x;
		$this->next=NULL;
	}
}


function insertf($x)
{
	global $f;
	$nn=new node($x);
	if($f->x != NULL)
	{
		$nn->next=$f;
		$f=$nn;
	}
	else
		$f=$nn;
}

function insertany($v,$x)
{
	global $f;
	$nn=new node($x);
	$t=$f;
	while($t->x!=$v && $t->next)
		$t=$t->next;
	if($t->x==$v)
	{
		$nn->next=$t->next;
		$t->next=$nn;
	}
	else
	{
		echo "<br><br><h2><font color='red'><b>[Not Found]</b></font></h2><br><br>";
	}
}

function insertl($x)
{
	global $f;
	$nn=new node($x);
	$t=$f;
	if(isset($t->x))
	{
		while($t->next)
			$t=$t->next;
		$t->next=$nn;
	}
	else
		$f=$nn;
}

function console()
{
	global $f;
	$t=$f;
	echo "<div id='mainholder'><div id='listholder'>";
	if(!isset($f))
	{
		echo "List Null";
		return 0;
	}
	while($t)
	{
		if($t->x == NULL)
			echo "<div class='nm'>-</div>";
		else
			echo "<div class='nm'><b>".$t->x."<b></div>";
		if($t->next)
		{
			echo "<div class='nn'></div><div class='na'></div>";
		}
		else
		{
			echo "<div class='nn'><font color='red'><b>X</b></font></div>";
		}
		$t=$t->next;
	}
	echo "</div></div>";
}

function find()
{

}

function deletef()
{
	global $f;
	$t=$f;
	if($t->x)
	{
		$f=$f->next;
	}
}

function deleteany($v)
{
	global $f;
	$t=$f;
	while($t->x!=$v && $t->next)
		$t=$t->next;
	if(isset($t->next->next))
		$t->next=$t->next->next;
	else if($t)
		$t->next=NULL;
}

function deletel()
{
	global $f;
	$t=$f;
	if(!$t->next)
	{
		$f->x=NULL;
		$f->next=NULL;
		return 0;
	}
	while(isset($t->next->next))
		$t=$t->next;
	$t->next=NULL;
}

?>

