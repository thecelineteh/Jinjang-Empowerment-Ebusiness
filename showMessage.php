<?php
  session_start();
  include 'dbConnection.php';
?>
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
  <script id="template">
    <div class="contact-wrapper">
        <div class="envelope {{ flipCard ? 'active' : '' }}">
          <div class="back paper"></div>
          <div class="content">
            <div class="form-wrapper">
              <form action="sendMessage.php" method="post">
                <div class="top-wrapper">
                  <div class="input">
                  <?php
                    echo "<input type='hidden' value='" . $_POST['senderID'] . "'
                    name='senderID'/>";
                    echo "<input type='hidden' value='" . $_POST['senderName'] . "'
                    name='senderName'/>";
                    echo "<input type='hidden' value='" . $_POST['subject'] . "'
                    name='subject'/>";
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
                    <textarea rows="10" name="content" readonly><?php
                        $messageID = $_POST['messageID'];
                        $query = "SELECT content FROM message WHERE messageID = '$messageID'";
                        $result = mysqli_query($connection, $query);
                        if (mysqli_num_rows($result) > 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                            echo $row['content'];
                          }
                        }
                      ?>
                    </textarea>
                  </div>
                  <div class="submit">
                    <button class="submit-card" type="submit">Reply</button>
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
