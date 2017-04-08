<?php

class Moneta
{
	private $score;

	function lancia() {
		return rand(0,1) == 1;
	}

	function getPunteggio(){
		return $this->score;
	}

	private function updateScore($tiri) {
		$this->score = $this->score - (($tiri-2) * 10);
	}

	function gioca($faccia) {
		$consecutivi = 0;
		$count = 0;
		do {
			$consecutivi = ($faccia === $this->lancia()) ? ++$consecutivi : $consecutivi=0;
			++$count;
		} while ($consecutivi < 2);
		$this->updateScore($count);
	}

	function __construct() {
		$this->score = 100;
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Palindroma</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>

<body>
	<div class="container" style="margin-top: 20px;">
		<div class="row">
			<div class="offset-md-2 col-md-8">
				<form class="form-inline" method="POST" action="index.php">
					
					<select name="faccia" class="custom-select">
						<option value="-1" selected>Scegli una faccia</option>
						<option value="1">Testa</option>
						<option value="0">Croce</option>
					</select>

					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
	<?php 
	if (isset($_POST['faccia'])) {
		if ($_POST['faccia'] != -1) {
			$moneta = new Moneta();
			$moneta->gioca(false);
			$punteggio = $moneta->getPunteggio();
			if ($punteggio <= 0) {
				echo "hai perso";
			} else {
				echo "Hai totalizzato " . $punteggio . " punti";
			}
		}
	}
	?>
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>

</html>