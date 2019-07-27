<?php
$subjectPrefix = '[Contato via Site]';
$emailTo = 'magdalena.widawska@gmail.com';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name  = stripslashes(trim($_POST['name']));
	$plusOne  = stripslashes(trim($_POST['plusOne']));
	$femail  = stripslashes(trim($_POST['femail']));
	$fradio  = stripslashes(trim($_POST['fradio']));
	if($fradio=='tak') 
		{
			$fradioM = "Oczywiście, że będe";
		} 
	else 
		{
			$fradioM = "Niestety nie mogę przyjść";
		}
	$secondDay  = stripslashes(trim($_POST['secondDay']));
	if(empty($secondDay)) 
		{
			$secondDayValue = "Poprawiny Nie";
		} 
	else 
		{
			$secondDayValue = "Poprawiny TAK";
		}
	$pattern  = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';


	if($name){
		$subject = "Goście na wesele";
		$body = "Kto: $name";
		$body .= "<br> Z:  $plusOne";
		$body .= "<br> email: $femail";
		$body .= "<br> $fradioM";
		$body .= "<br> $secondDayValue";
		
		$headers  = 'MIME-Version: 1.1' . PHP_EOL;
		$headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;
		$headers .= "From: magdailukasz.pl@" . PHP_EOL;
		$headers .= "X-Mailer: PHP/". phpversion() . PHP_EOL;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;

	} else {
		$hasError = true;
	}
}
?>
<!doctype html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="renatagiera@gmail.com">
	<link href="https://fonts.googleapis.com/css?family=Allura|EB+Garamond&display=swap" rel="stylesheet">
	<title>Ślub Magdy i Łukasza</title>
	<!-- Bootstrap core CSS -->
	<script src="/js/app.js"></script>
	<link href="css/style1.css" rel="stylesheet">
  </head>
  <body>
	<div class="all">
		<div class="container">
			<div class="row lg">
				<a class="button" href="en.php">in English, please <span> ▶</span></a>
			</div>
		</div>
		<div class="container bg ">
			<div class="row header">
				<h1>Magda & Łukasz <span class="smaller">pobieramy się!</span></h1>
			</div>
			<div class="countdown-header" style="margin: 30px auto 0 auto; width:70%;">24.08.2019 sobota, godz&nbsp;16.00 </div>

			<div class="row">
				<nav class="nav main-nav">
					<a class="nav-link active" href="#">Potwierdzenie przybycia <span> ▶</span></a>
					<a class="nav-link" href="#">Inforacje organizacyjne <span> ▶</span></a>
					<a class="nav-link" href="#">Regulamin wesela <span> ▶</span></a>
				</nav> 
			</div>

			<div class="row countdown">
				<div class="countdown-header">Do ślubu zostało jeszcze:</div>
				<ul class="countdown-boxes">
					<li>Dni: <span class="js-countdown-day">90</span></li>              
					<li>Godz:<span class="js-countdown-h">45</span></li>                   
					<li>Min: <span class="js-countdownm">06</span></li>                 
					<li>Sek: <span class="js-countdown-s">06</span></li>
				</ul>
			</div>

			<div class="row justify-content-end box">
				<div class="col-lg-2 col-12"><span class="box-no">1.</span></div>
				<div class="col-lg-9 col-12" id="confirm">
					<h3>Potwierdź przybycie na ślub i poprawiny</h3>

					<h4>1. Możesz to zrobić online.</h4>
						<?php if(!empty($emailSent)): ?>
							<?php if($fradio=='tak'): ?>
					   		 <div class="comfirm-thankyou" style="color:red">Dziękujemy. Bardzo się cieszymy, że będziesz/będziecie z nami w tym ważnym dla nas dniu.</div>                        
							<?php else: ?> 
							<div class="comfirm-thankyou" style="color:red">Przykro nam, że nie możesz być z nami w tym ważnym dniu. Dziekujemy, za poinformowanie nas o swojej nieobecnosci.</div>  
							<?php endif; ?>  
						<?php else: ?>                 
						<?php if(!empty($hasError)): ?>             
							<div class="alert-danger">Upss. Nie wpisałeś swojego imienia i nazwiska.</div>              
						<?php endif; ?>  
				
						<form action="<?php echo $_SERVER['REQUEST_URI']; ?>#confirm" role="form" method="post">               
							<div class="form-group">
										<label for="name">ja:</label>
										<input type="text" class="form-control" name="name" value="<?php echo $name;?>" placeholder="Imię i nazwisko">
									</div>
									<div class="form-group">
										<label for="plusOne"> wraz z:</label>
										<input type="text" class="form-control" name="plusOne" value="<?php echo $plusOne;?>" placeholder="Imię i nazwisko osoby towarzyszącej i dzieci">
									</div>
									<div class="form-group">
											<label for="femail"> email:</label>
											<input type="text" class="form-control" name="femail" value="<?php echo $femail;?>" placeholder="Zostaw swój email">
									</div>
									<div class="form-check form-check-inline radio">
											<input class="form-check-input radio-btn" type="radio" name="fradio" <?php if (isset($fradio) && $fradio=="tak") echo "checked";?> value="tak" id="tak">
								
											<label class="form-check-label" for="tak">Oczywiście, że będe</label>
									</div>
									<div class="form-check form-check-inline radio">
											<input class="form-check-input radio-btn" type="radio" name="fradio" <?php if (isset($fradio) && $fradio=="nie") echo "checked";?> value="nie" id="nie">
											<label class="form-check-label" for="nie">Niestety nie mogę przyjść</label>
									</div>
									<div class="form-check checkbox">
											<input type="checkbox" name="secondDay" class="form-check-input" value="1" <?php if (isset($secondDay) == "1") { echo "checked='checked'"; } ?> id="secondDay">
											<label class="form-check-label" for="secondDay">Potwierdzam również udział w poprawinach </label>
									</div>
									<div class="form-btn">
										<button type="submit" class="button">Wyślij<span> ▶</span></button> 
									</div>
						</form>
					<?php endif; ?>
							

						<h4>2. Dzwoniąc lub smsująć do nas.</h4>
						<p>Magda: +44 745 3324416 <br />
						   Łukasz: +44 7851 272870</p>
						
					
					
				</div>
			</div>

			<div class="row justify-content-end box-revert">
					<div class="col-lg-2 col-12"><span class="box-no">2.</span></div>
					<div class="col-lg-9 col-12">
							<h2>23.08.19 piątek</h2>
							<h3>To ostatnia szansa, aby sie wyspać i nabrać sił na dwa najbliższe dni.</h3>
							<p>Nie zmarnuj jej. Para Młoda nie bierze zmęczenia jako usprawiedliwienia od dobrej zabawy.</p>
						   
					</div>
			</div>

			<div class="row justify-content-end box">
					<div class="col-lg-2 col-12"><span class="box-no">3.</span></div>
					<div class="col-lg-9 col-12">
							<h2>24.08.19 sobota</h2>
							<h3>Zaczynamy! Ślub odbędzie się w Kopalni Soli w Wieliczce.</h3>
							<p>Pierwszy zjazd do kopalni jest o 15.30. Dokładne miejsce spotkania gości będzie podane wkrótce. Zaczynamy o 16.00, ale prosimy o wcześniejsze przybycie. Na uroczystość weselną zapraszamy do Domu weselnego “ Babie Lato” w Gdowie. <!-- <a href="#">Sprawdz jak dojechać</a>--> </p>
						   
					</div>
			</div>

			<div class="row justify-content-end box-revert">
					<div class="col-lg-2 col-12"><span class="box-no">4.</span></div>
					<div class="col-lg-9 col-12">
							<h2>25.08.19 niedziela</h2>
							<h3>Poprawiamy! W stylu PRL</h3>
							<p>Wyrobienie 200% normy nie jest łatwe. Dlatego potrzebujemy waszej pomocy! Pomożecie? Pomożemy! <!-- <a href="#">Sprawdz jak dojechać</a>--></p>
						   
					</div>
			</div>
			<div class="box-end">
				 ... i żyli długo i szczęśliwie!
			</div>

	</div> <!-- /container -->
</div> <!-- /all -->
</body>
</html>
