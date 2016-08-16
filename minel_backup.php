<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./css/normalize.css">
	<link rel="stylesheet" href="./css/style.css">


	<style>
	#header
	{
		width: 100%;
		height:50px;
	}
	#sidebar
	{
		float:left;
		width:40%;
	}
	#mainholder
	{
		float:left;
		width:60%;
		height:600px;
		text-align: center;
		margin-top: 40px;
	}
	#listholder
	{
		width: 100%;
		max-height: 70px;
		margin: 20px;
	}
	.nm
	{
		float: left;
		width: 10%;
		height: 30px;
		border: 1px solid black;
		line-height: 30px;
	}
	.nn
	{
		float:left;
		width: 4%;
		height: 30px;
		border: 1px solid black;
	}
	.nuller
	{
		float:left;
		width: 6%;
		height: 30px;
		line-height: 30px;
	}
	.na
	{
		float: left;
		width: 30px;
		height: 30px;
		background-image: url("./arrow.png");
	}

</style>

</head>

<body>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="./js/index.js"></script>
    <div id='header'>
    	<h1>Linked List Simulator</h1>
    </div>
	<div id="sidebar">
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label>
				<input id="fname" type="text" placeholder="Enter Value" name="iv">
				<span>Enter Value</span>
			</label>
			<input type="hidden" name="opt" value="1">
			<input type="submit" name="submit" value="Insert First">
		</form>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="text" name="iav"><br>
			<input type="text" name="iv"><br>
			<input type="hidden" name="opt" value="2">
			<input type="submit" name="submit" value="Insert Anywhere"><br>
		</form>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="text" name="iv"><br>
			<input type="hidden" name="opt" value="3">
			<input type="submit" name="submit" value="Insert Last"><br>
		</form>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="hidden" name="opt" value="4">
			<input type="submit" name="submit" value="Delete First"><br>
		</form>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="text" name="dav"><br>
			<input type="hidden" name="opt" value="5">
			<input type="submit" name="submit" value="Delete After"><br>
		</form>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="hidden" name="opt" value="6">
			<input type="submit" name="submit" value="Delete Last"><br>
		</form>
	</div>
</body>

</html>

<?php
session_start();
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
		echo "Value Not found [Last command Errored] <br>";
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
	$i=0;
	echo "<div id='mainholder'><div id='listholder'>";
	if(!isset($f))
	{
		echo "List Null";
		return 0;
	}
	while($t)
	{
		if($t->x == NULL)
			echo "<div class='nm'>NULL</div>";
		else
			echo "<div class='nm'>".$t->x."</div>";
		echo "<div class='nn'></div><div class='na'></div>";
		$t=$t->next;
	}
	echo "<div class='nuller'>NULL</div></div></div>";
}

function find()
{
	global $f;
	$t=$f;
	
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

