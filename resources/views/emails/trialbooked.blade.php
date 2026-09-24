<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trial Class Booked</title>
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Nunito');

    body, html {
      margin: 0;
      padding: 0;
      font-family: 'Nunito', Helvetica, Arial, sans-serif;
      background: #ffffff;
      color: #444;
      font-size: 16px;
    }

    img {
      max-width: 100%;
      height: auto;
      border: none;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    table {
      border-collapse: collapse !important;
    }

    td {
      text-align: center;
      padding: 10px;
    }

    .headline {
      font-size: 30px;
      font-weight: bold;
      color: #674299;
      margin-top: 20px;
    }

    .info-table {
      width: 75%;
      margin: 20px auto;
      text-align: left;
    }

    .info-table td {
      padding: 6px 0;
    }

    .button {
      background-color: #674299;
      border-radius: 4px;
      color: #fff;
      display: inline-block;
      font-size: 18px;
      line-height: 50px;
      width: 300px;
      text-align: center;
      text-decoration: none;
      margin-top: 20px;
    }

    @media only screen and (max-width: 480px) {
      .info-table {
        width: 90% !important;
      }
      .button {
        width: 90% !important;
      }
    }
  </style>
</head>
<body>
  <table width="100%" align="center">
    <tr>
      <td>
        <table width="600" align="center" class="w320">
          <tr>
            <td>
              <img src="https://bookdriver.sofinish.co.uk/frontendnew/img/logo2.png" width="155" height="60" alt="Logo" />
              <div class="headline">Trial Class Booked!</div>
              <p><strong>Dear {{$user_name}},</strong></p>
              <p>
                Thank you for booking a trial class with us. Please wait for a confirmation — you will receive an email shortly.<br>
                As you embark on this exciting academic journey, our team is here to support and guide you.<br>
                Here's to a successful and enriching experience ahead!
              </p>

              <table class="info-table">
                <tr><td><strong>Slot 1:</strong></td><td>{{$slot_1}}</td></tr>
                <tr><td><strong>Slot 2:</strong></td><td>{{$slot_2}}</td></tr>
                <tr><td><strong>Slot 3:</strong></td><td>{{$slot_3}}</td></tr>
                <tr><td><strong>Tutor Name:</strong></td><td>{{$tutor_name}}</td></tr>
              </table>

              <a class="button" href="https://bookdriver.sofinish.co.uk/">Visit Account and Start Managing</a>

              <!--<p style="margin-top: 30px;">-->
              <!--  For any query, feel free to contact us at <strong>07761 975326</strong>-->
              <!--</p>-->
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
