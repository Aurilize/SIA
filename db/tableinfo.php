<?php

$databases = array();
$tables = array();
$posted = new stdClass;
$posted->server = filled_or($_POST['server']);
$posted->username = filled_or($_POST['username']);
$posted->password = filled_or($_POST['password']);
$posted->database = filled_or($_POST['database']);
$posted->action = filled_or($_POST['action']);

function filled_or(&$var, $default = '')
{
	return (isset($var) && !empty($var)) ? $var : $default;
}

function key_field($key='')
{
	$val = '';
	switch (strtolower($key)) {
		case 'pri':
			$val = 'Primary';
			break;
		case 'uni':
			$val = 'Unique';
			break;
		default:
			$val = '';
			break;
	}
	return $val;
}

if (!empty($posted->action))
{
	$db = (object) array(
		'host' => filled_or($posted->server, 'localhost'),
		'user' => filled_or($posted->username, 'root'),
		'pass' => filled_or($posted->password),
		'name' => filled_or($posted->database),
	);
	$db = new mysqli($db->host, $db->user, $db->pass, $db->name);

	if ($db->connect_errno)
    exit("Connect failed: \n" . $mysqli->connect_error);

	if ($result = $db->query('SHOW DATABASES'))
	{
    // Cycle through results
    while ($row = $result->fetch_array())
      $databases[] = $row[0];

    // Free result set
    $result->close();
    $db->next_result();
	}
	else exit("Query failed: \n" . $db->error);

	if (!empty($posted->database))
	{
		$dbname = $posted->database;

		if ($qtables = $db->query("SHOW TABLES FROM $dbname"))
		{
	    // Cycle through results
	    while ($table = $qtables->fetch_array())
	    {
	    	$tablename = $table[0];

	    	if ($qfields = $db->query("SHOW FIELDS FROM `$dbname`.`$tablename`"))
	    	{
	    		// Cycle through results
			    while ($field = $qfields->fetch_array())
			    {
			    	$info = new stdClass;
			    	foreach ($field as $key => $val) {
			    		if (!is_numeric($key)) {
			    			$info->{strtolower($key)} = $val;
			    		}
			    	}
			    	$tables[$tablename][] = $info;
			    }

			    // Free result set
			    $qfields->close();
			    $db->next_result();
	    	}
	    	else
	      	$tables[$tablename] = array();
	    }

	    // Free result set
	    $qtables->close();
	    $db->next_result();
		}
	}

	if ($posted->action == 'export')
	{
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=db_{$posted->database}.doc");
		$posted->meta = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
	}

	mysqli_close($db);
}

?>

<html>
<?php echo filled_or($posted->meta) ?>
<head>
	<title>Table Info Generator</title>
	<style type="text/css">
		/* css reset */
		html,body,div,span,applet,object,iframe,a,abbr,acronym,address,big,cite,code,del,dfn,em,font,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,dl,dt,dd,ol,ul,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,label,legend,p,blockquote,table,caption,tbody,tfoot,thead,tr,th,td{margin:0;padding:0;border:0;outline:0;font-weight:inherit;font-style:inherit;font-size:100%;font-family:inherit;vertical-align:baseline;}body{line-height:1;color:black;background:white;}:focus{outline:0;}table{border-collapse:collapse;border-spacing:0;}caption,th,td{text-align:left;font-weight:normal;}fieldset,img{border:0;}address,caption,cite,code,dfn,em,strong,th,var{font-style:normal;font-weight:normal;}ol,ul{list-style:none;}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal;}blockquote:before,blockquote:after,q:before,q:after{content:"";}blockquote,q{quotes:"" "";}abbr,acronym{border:0;}

		body {
			font-family: Verdana, Geneva, sans-serif;
		}

		.wrapper {
			width: 100%;
		  display: flex;
		  flex-direction: row;
		  justify-content: center;
		  align-items: stretch;
		  padding-top: 15px;
		}

		.section {
			padding: 0 50px;
		}

		.ghost {
			width: 30%;
			display: none;
		}

		.wrapper.preview .ghost {
			display: block;
		}

		.form {
			width: 30%;
		}

		.wrapper.preview .form {
			position: fixed;
			left: 0;
		}

		.wrapper.export .form {
			display: none;
		}

		.form .title,
		.form .subtitle {
			color: #333;
		}

		.form .title {
			text-transform: uppercase;
			font-weight: bold;
			font-size: 170%;
			opacity: 0.7;
			margin: 30px 0 10px;
		}

		.form .subtitle {
			font-size: 90%;
			opacity: 0.7;
		}

		.info {
			padding: 14px 15px;
			border-radius: 2px;
			margin-bottom: 20px;
			background: #f8f8f8;
			color: #666;
			line-height: 1.5em;
			font-size: 12px;
			text-align: center;
		}

		.actions {
			text-align: center;
		}

		.result {
			width: 70%;
			padding-top: 30px;
			padding-bottom: 30px;
		}

		.wrapper.export .result {
			width: 100%;
		}

		h1, h2, h3 {
			font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
			text-align: center;
		}

		table {
			border: 1px solid #eee;
	    margin-bottom: 20px;
	    width: 100%;
	    border-spacing: 0;
	    font-size: 80%;
	    color: #555;
		}

		form {
			margin: 0;
		}

		th, td {
			margin: 0;
			padding: 5px 7px;
			border: 1px solid #ddd;
		}

		th {
			text-align: center;
			font-weight: bold;
		}

		.table {
			margin: 20px auto;
			border-spacing: 3px;
			border-collapse: separate;
			border: 1px solid #ddd;
			padding: 10px;
    	font-size: 90%;
		}

		.table th,
		.table td {
			background: #fff;
			padding: 7px 7px;
			color: #777;
			border: 0;
		}

		input[type=text],
		input[type=password],
		select {
			width: 100%;
			padding: 7px;
			margin: 0;
			font-size: 90%;
			border: 1px solid #eee;
		}

		.btn {
		  position: relative;
		  vertical-align: top;
		  border-radius: 5px;
		  padding: 6px 10px;
		  color: #454545;
		  text-align: center;
		  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
		  background: #ecf0f1;
		  border: 0;
		  border-bottom: 2px solid #dadedf;
		  cursor: pointer;
		  -webkit-box-shadow: inset 0 -2px #dadedf;
		  box-shadow: inset 0 -2px #dadedf;
		  text-decoration: none;
		  font-size: 13px;
		  display: inline-block;
		  line-height: 1em;
		}
		.btn:active {
		  top: 1px;
		  outline: none;
		  -webkit-box-shadow: none;
		  box-shadow: none;
		}
	</style>
</head>
<body>
<div class="wrapper <?php if (!empty($posted->database)) echo $posted->action ?> ">

<?php if ($posted->action != 'export'): ?>

	<div class="section ghost"></div>
	<div class="section form">
		<h1 class="title">Table Info Generator</h1>
		<h3 class="subtitle">developed by davigmacode</h3>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
			<table class="table">
				<tbody>
				<tr>
					<td>Server</td>
					<td><input name="server" type="text" value="<?php echo $posted->server ?>" placeholder="localhost" /></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><input name="username" type="text" value="<?php echo $posted->username ?>" placeholder="root" /></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input name="password" type="password" value="<?php echo $posted->password ?>" /></td>
				</tr>
				<tr>
					<td>Database</td>
					<td>
						<?php
							if (!empty($databases))
							{
								echo '<select name="database">';
								foreach ($databases as $val)
								{
									$selected = ($val == $posted->database) ? 'selected="selected"' : '';
									echo "<option value=\"$val\" $selected>$val</option>";
								}
								echo '</select>';
							}
							else
								echo '<input name="database" type="text" value="" />';
						?>
					</td>
				</tr>
				</tbody>
			</table>
			<?php if (!empty($posted->database)): ?>
				<div class="info">
					Database <b><?php echo $posted->database  ?></b>,
					<?php echo count($tables) ?> table(s) found.
				</div>
			<?php endif; ?>
			<div class="actions">
				<button class="btn" type="submit" name="action" value="preview">Preview</button>
				<?php if (!empty($databases)): ?>
					<button class="btn" type="submit" name="action" value="export">Export to Ms Word</button>
					<a class="btn" id="btn-copy" onclick="toClipboard(event)" href="#">Copy</a>
				<?php endif; ?>
				<a class="btn" href="<?php echo $_SERVER['PHP_SELF']?>">Reset</a>
			</div>
		</form>
	</div>

<?php endif; ?>

<?php if (!empty($posted->database)): ?>

	<div id="tables" class="section result">

		<?php foreach ($tables as $table => $fields): ?>

		<table id="tabel-<?php echo $table ?>">
			<thead>
				<tr>
					<th colspan="3">Tabel <?php echo $table ?></th>
				</tr>
				<tr>
					<th>Field</th>
					<th>Type</th>
					<th>Key</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($fields as $field): ?>
				<tr>
					<td><?php echo $field->field ?></td>
					<td><?php echo $field->type ?></td>
					<td><?php echo key_field($field->key) ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<br>

		<?php endforeach; ?>

	</div>

<?php endif; ?>

</div>

<?php if ($posted->action != 'export'): ?>

<script type="text/javascript">

	function toClipboard(e) {
		e.preventDefault();
		selectElementContents( document.getElementById('tables') )
	}

	function selectElementContents(el) {
	  var body = document.body, range, sel;
	  if (document.createRange && window.getSelection) {
      range = document.createRange();
      sel = window.getSelection();
      sel.removeAllRanges();
      try {
	      range.selectNodeContents(el);
	      sel.addRange(range);
      } catch (e) {
        range.selectNode(el);
        sel.addRange(range);
      }
	  } else if (body.createTextRange) {
      range = body.createTextRange();
      range.moveToElementText(el);
      range.select();
	  }
	  document.execCommand("Copy");
	}

</script>

<?php endif; ?>

</body>
</html>