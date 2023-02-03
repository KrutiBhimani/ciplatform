<!-- <!DOCTYPE html> -->
<html>

<head>
  <title></title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">

  <link href="mvc/Assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <!-- <link href="mvc/Assets/css/font-awesome.min.css" rel="stylesheet"> -->
  <link href="mvc/Assets/css/style1.css" rel="stylesheet">

  <!-- for popup -->
  <script src="mvc/Assets/js/jquery.min.js"></script>
  <script src="mvc/Assets/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>

<body>
  <div id="overlay" style='z-index:2;'>
    <div class="cv-spinner">
      <span class="spinner"></span>
    </div>
  </div>
  <script>
    jQuery(function($) {
      $(document).ajaxSend(function() {
        $("#overlay").fadeIn(0);
      });

      $('#button').click(function() {
        $.ajax({
          type: 'POST',
          success: function(data) {
            console.log(data);
          }
        }).done(function() {
          setTimeout(function() {
            $("#overlay").fadeOut(500);
          }, 500);
        });
      });

      $('#button1').click(function() {
        $.ajax({
          type: 'POST',
          success: function(data) {
            console.log(data);
          }
        }).done(function() {
          setTimeout(function() {
            $("#overlay").fadeOut(15000);
          }, 15000);
        });
      });
    });
  </script>