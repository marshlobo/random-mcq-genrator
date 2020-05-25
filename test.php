<?php include 'inc/header.php'; ?>
<?php
Session::checkSession();
//if (isset($_GET['q'])) {
//	$number = (int) $_GET['q'];
//}else{
$number =$_SESSION['ques'];
$qno = $_SESSION['qno'];
    
    
//	header("Location:exam.php");
//}

$total = $exm->getTotalRows();
$question = $exm->getQuesByNumber($number);
?>

<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$process = $pro->processData($_POST);
	}

 ?>
<div class="main">
<h1>Question <?php echo $qno; ?> of <?php echo $total; ?></h1>
	<div class="test">
		<form method="post" action="">
		<table> 
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $qno; ?>: <?php echo $question['ques']; ?></h3>
				</td>
			</tr>

			<?php 

				$answer = $exm->getAnswer($number);
				if ($answer) {
					while ($result = $answer->fetch_assoc()) {
				
			 ?>

			<tr>
				<td>
				 <input type="radio" name="ans" value="<?php echo $result['id']; ?>" /><?php echo $result['ans']; ?>
				</td>
			</tr>
		<?php }} ?>

			<tr>
			  <td>
                  <input type="hidden" name="number" value="<?php echo $number; ?>" />
                  <input type="hidden" name="qno" value="<?php echo $qno; ?>" />
				<input type="submit" name="submit" value="Next Question"/>
				
			</td>
			</tr>
			
		</table>
	</form>
</div>
 </div>
