<?php include 'inc/header.php'; ?>
<?php
Session::checkSession();
$question = $exm->getQuestion();
$total = $exm->getTotalRows();


$_SESSION['rand'] = range(1, $total);
shuffle($_SESSION['rand'] );
$_SESSION['ques'] = $_SESSION['rand'][0];
$_SESSION['qno'] = 1;
		

?>
<div class="main">
<h1>Welcome to Student Assessment</h1>
	<div class="starttest">
		<h2>Test your knowledge</h2>
		<p>This is multiple choice quiz to test your knowledge</p>

		<ul>
			<li><strong>Number of Questions:</strong> <?php echo $total; ?></li>
			<li><strong>Question Type:</strong> Multiple Choice</li>
		</ul>
        
		<a href="test.php">Start Test</a>

	</div>

  </div>
