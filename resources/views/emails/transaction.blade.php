<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>Welcome - Transaction Successful</title>

  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Nunito');

    img {
      max-width: 600px;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }
    html, body {
      margin: 0;
      padding: 0;
      font-family: 'Helvetica', 'Arial', sans-serif;
      font-size: 16px;
      color: #444;
      background: #ffffff;
    }
    table {
      border-collapse: collapse !important;
    }
    td {
      text-align: center;
    }
    .headline {
      color: #674299;
      font-size: 32px;
      margin-top: 20px;
    }
    .info-table td {
      text-align: left;
      padding: 8px 0;
    }
    .button {
      background-color: #674299;
      border-radius: 4px;
      color: #fff;
      display: inline-block;
      font-size: 18px;
      line-height: 50px;
      text-align: center;
      text-decoration: none;
      width: 300px;
      margin: 30px 0;
    }
    @media only screen and (max-width: 480px) {
      table[class="w320"] {
        width: 100% !important;
      }
    }
  </style>
</head>
<body style="padding: 20px;">
  <table align="center" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td align="center">
        <center>
          <table class="w320" width="600" style="margin: 0 auto;">
            <tr>
              <td>
                <table width="100%" style="margin-top: 80px;">
                  <tr>
                    <td>
                      <img src="https://bookdriver.sofinish.co.uk/frontendnew/img/logo2.png" alt="Book Driver" width="155" height="60" />
                    </td>
                  </tr>
                  <tr>
                    <td class="headline">Welcome, {{$name}}!</td>
                  </tr>
                  <tr>
                    <td style="padding: 20px 0;">
                      <p>🎉 Your transaction was successful!</p>
                      <p>Below are your login details and order summary:</p>
                      <table width="75%" align="center" class="info-table">
                        <tr><td><strong>Username:</strong></td><td>{{$name}}</td></tr>
                        <tr><td><strong>Mobile:</strong></td><td>{{$phone}}</td></tr>
                        <tr><td><strong>Email:</strong></td><td>{{$email}}</td></tr>
                        <tr><td><strong>Class Purchased:</strong></td><td>{{$classpuchased}} Hour(s)</td></tr>
                        <tr><td><strong>Postcode:</strong></td><td>{{$postcode}}</td></tr>
                        <tr><td><strong>Transaction ID:</strong></td><td>{{$transaction_id}}</td></tr>
                        <tr><td><strong>Total Amount:</strong></td><td>£{{$total_amount}}</td></tr>
                      </table>
                      <a href="https://bookdriver.sofinish.co.uk/" class="button">Visit Account and Start Managing</a>
                      <!--<p>If you have any queries, feel free to reach us at <strong>07761 975326</strong></p>-->
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </center>
      </td>
    </tr>
  </table>
</body>
</html>
