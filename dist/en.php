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
    <title>Magda & Łukasz wedding</title>
    <!-- Bootstrap core CSS -->
    <script src="/js/app.js"></script>
    <link href="css/style1.css" rel="stylesheet">
  </head>
  <body>
    <div class="all">
        <div class="container">
            <div class="row lg">
                <a class="button" href="/">Po polsku, proszę <span> ▶</span></a>
            </div>
        </div>
        <div class="container bg ">
            <div class="row header">
                <h1>Magda & Łukasz <span class="smaller">getting married!</span></h1>
            </div>
            <div class="countdown-header" style="margin: 30px auto 0 auto; width:70%;">24.08.2019 Saturday, at 16.00 </div>
<!--
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
-->
            <div class="row justify-content-end box">
                <div class="col-lg-2 col-12"><span class="box-no">1.</span></div>
                <div class="col-lg-9 col-12" id="confirm">
                        <h3>Confirm your arrival at the wedding and after party</h3>
                        <h4>1. You can do it online</h4>
                        <?php if(!empty($emailSent)): ?>
							<?php if($fradio=='tak'): ?>
                       		 <div class="comfirm-thankyou" style="color:red">Thank you, we are very happy that you join us on our Special Day</div>                        
							<?php else: ?> 
							<div class="comfirm-thankyou" style="color:red">Thank you for informing us of your absence.</div>  
							<?php endif; ?>  
					    <?php else: ?>                 
                        <?php if(!empty($hasError)): ?>             
                            <div class="alert-danger">Oops, you have not entered your name.</div>              
                        <?php endif; ?>  
                
                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>#confirm" role="form" method="post">               
                            <div class="form-group">
                                        <label for="name">I:</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo $name;?>" placeholder="Enter your name">
                                    </div>
                                    <div class="form-group">
                                        <label for="plusOne"> with:</label>
                                        <input type="text" class="form-control" name="plusOne" value="<?php echo $plusOne;?>" placeholder="Name and surname of accompanying person and children">
                                    </div>
                                    <div class="form-group">
                                            <label for="femail"> email:</label>
                                            <input type="text" class="form-control" name="femail" value="<?php echo $femail;?>" placeholder="Enter your email">
                                    </div>
                                    <div class="form-check form-check-inline radio">
                                            <input class="form-check-input radio-btn" type="radio" name="fradio" <?php if (isset($fradio) && $fradio=="tak") echo "checked";?> value="tak" id="tak">
								
                                            <label class="form-check-label" for="tak"> I confirm my arrival</label>
                                    </div>
                                    <div class="form-check form-check-inline radio">
                                            <input class="form-check-input radio-btn" type="radio" name="fradio" <?php if (isset($fradio) && $fradio=="nie") echo "checked";?> value="nie" id="nie">
                                            <label class="form-check-label" for="nie"> Sorry I can not come</label>
                                    </div>
                                    <div class="form-check checkbox">
                                            <input type="checkbox" name="secondDay" class="form-check-input" value="1" <?php if (isset($secondDay) == "1") { echo "checked='checked'"; } ?> id="secondDay">
                                            <label class="form-check-label" for="secondDay">I also confirm participation in the after party</label>
                                    </div>
                                    <div class="form-btn">
                                        <button type="submit" class="button">Send<span> ▶</span></button> 
                                    </div>
                        </form>
                    <?php endif; ?>
                    
                       
                        <h4>2. By calling or texting us</h4>
                        <p>Magda: +44 745 3324416 <br />
                           Łukasz: +44 7851 272870</p>
                         
                </div>
            </div>

            <div class="row justify-content-end box-revert">
                    <div class="col-lg-2 col-12"><span class="box-no">2.</span></div>
                    <div class="col-lg-9 col-12">
                            <h2>23.08.19 Friday</h2>
                            <h3>This is the last chance to sleep and recharge your batteries before the big day.</h3>
                            <p>Do not waste it! The newlyweds will not take tiredness as an excuse for not having fun.</p>
                           
                    </div>
            </div>

            <div class="row justify-content-end box">
                    <div class="col-lg-2 col-12"><span class="box-no">3.</span></div>
                    <div class="col-lg-9 col-12">
                            <h2>24.08.19 Saturday</h2>
                            <h3>Let’s get the party started! The wedding will take place at the Wieliczka Salt Mine.</h3>
                            <p>The first descent is at 15.30. The exact meeting place will be given soon. We start at 4:00
								PM, but please arrive earlier. After the ceremony please join us to the wedding party in
								&quot;Babie Lato&quot; in Gdów.<!-- <a href="#">Sprawdz jak dojechać</a>--> </p>
                           
                    </div>
            </div>

            <div class="row justify-content-end box-revert">
                    <div class="col-lg-2 col-12"><span class="box-no">4.</span></div>
                    <div class="col-lg-9 col-12">
                            <h2>25.08.19 Sunday</h2>
                            <h3>After Party! In PRL style</h3>
                            <p>Getting 200% of the standard is not easy. That&#39;s why we need your help! Can you help? Yes,
								I can!<!-- <a href="#">Sprawdz jak dojechać</a>--></p>
                           
                    </div>
            </div>
            <div class="box-end">
                 ... they lived happily ever after!
            </div>

    </div> <!-- /container -->
</div> <!-- /all -->
</body>
</html>
