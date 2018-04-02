<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>JinJang E-Business</title>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/message.css">

  <style>
    body {
      margin-left: 0;
    }
  </style>

</head>

<body>
  <div id="container"></div>
  <?php
    $senderID = $_POST['senderID'];
    $senderName = $_POST['senderName'];
  ?>
  <script id="template">
    <div class="flip-card" on-click="toggle('flipCard')">{{ flipCard ? 'Reset' : 'Animate' }}</div>
    <div class="contact-wrapper">
        <div class="envelope {{ flipCard ? 'active' : '' }}">
          <div class="back paper"></div>
          <div class="content">
            <div class="form-wrapper">
              <form>
                <div class="top-wrapper">
                  <div class="input">
                  <?php
                    echo "
                      <div style='text-align: center;'>
                        <h2>" . $_POST['subject']. "</h2>
                      </div>

                    "
                  ?>
                  </div><br />
                  <div class="input">
                    <?php
                      echo "
                        <label>Sender: " . $_POST['senderName']. "</label>
                      "
                    ?>
                  </div><br />

                </div>
                <div class="bottom-wrapper">
                  <div class="input">
                    <label>Message</label>
                    <textarea rows="10" name="content" readonly></textarea>
                  </div>
                  <div class="submit">
                    <button class="submit-card">Reply</button>
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
  <script>

  </script>
</body>

</html>
