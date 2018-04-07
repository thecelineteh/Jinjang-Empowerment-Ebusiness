<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>JinJang E-Business</title>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/message.css">
  <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function()
  {
  	$("#receiverName").keyup(function()
  	{
  		var receiverName = $(this).val();

  		if(receiverName.length > 0)
  		{
  			$("#result").html('checking...');

  			/*$.post("username-check.php", $("#reg-form").serialize())
  				.done(function(data){
  				$("#result").html(data);
  			});*/

  			$.ajax({

  				type : 'POST',
  				url  : 'username-check.php',
  				data : $(this).serialize(),
  				success : function(data)
  						  {
  					         $("#result").html(data);
  					      }
  				});
  				return false;

  		}
  		else
  		{
  			$("#result").html('');
  		}
  	});

  });
  </script>
  <style>
    body {
      margin-left: 0;
    }
  </style>
</head>

<body>
  <div id="container"></div>
  <script id="template">
    <div class="contact-wrapper">
        <div class="envelope {{ flipCard ? 'active' : '' }}">
          <div class="back paper"></div>
          <div class="content">
            <div class="form-wrapper">
              <form action="sendMessage2.php" method="post" id="my_form"
              autocomplete='off'>
                <div class="top-wrapper">
                  <div class="input">
                    <label>Receiver</label>
                    <?php
                      if (isset($_POST['senderName'])) {
                        echo "
                          <input type='text' name='receiverName' id='receiverName' value='" .
                          $_POST['senderName']
                          . "' required id='receiverName' readonly/>
                        ";
                        echo "<div style='text-align: center;'><span id='result'></span></div>";
                      }
                      else {
                        echo "<input type='text' name='receiverName' id='receiverName' required
                          id='receiverName'/>";
                        echo "<div style='text-align: center;'><span id='result'></span></div>";
                      }
                    ?>
                  </div><br />
                  <div class="input">
                    <label>Subject</label>
                    <?php
                      if (isset($_POST['subject'])) {
                        echo "
                          <input type='text' name='subject' value='RE: " .
                          $_POST['subject']
                          . "' required id='subject'/>
                        ";
                      }
                      else {
                        echo "<input type='text' name='subject' id='subject'/>";
                      }
                    ?>
                  </div><br />
                </div>
                <div class="bottom-wrapper">
                  <div class="input">
                    <label>Message</label>
                    <textarea rows="10" name="content" id='Message' required></textarea>
                  </div>
                  <div class="submit">
                    <button class="submit-card" type="submit">Send Mail</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="front paper"></div>
        </div>
      </div>

  </script>

  <script src='https://cdn.jsdelivr.net/npm/ractive'></script>
  <script  src="js/index.js"></script>

</body>

</html>
