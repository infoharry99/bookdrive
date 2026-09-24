<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Welcome </title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css" />

  <!-- Styles -->
  <style type="text/css">
    body {
      -webkit-font-smoothing: antialiased;
      -webkit-text-size-adjust: none;
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 20px;
      background: #ffffff;
      color: #666;
      font-size: 16px;
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }

    table {
      border-collapse: collapse !important;
    }

    img {
      max-width: 600px;
      border: none;
      text-decoration: none;
      outline: none;
      -ms-interpolation-mode: bicubic;
    }

    a {
      text-decoration: none;
      color: #bbbbbb;
      border: 0;
      outline: none;
    }

    td, h1, h2, h3 {
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      font-weight: 400;
    }

    .headline {
      color: #444;
      font-size: 36px;
      font-family: 'Nunito', sans-serif;
    }

    .force-full-width {
      width: 100% !important;
    }

    @media screen {
      td, h1, h2, h3 {
        font-family: 'Nunito', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
      }
    }

    @media only screen and (max-width: 480px) {
      table[class="w320"] {
        width: 320px !important;
      }
    }
  </style>
</head>
<body>
  <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr>
      <td align="center" bgcolor="#fff" valign="top">
        <center>
          <table width="600" class="w320" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
            <tr>
              <td align="center" valign="top">

                <!-- Header Logo -->
                <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 100px;">
                  <tr>
                    <td align="center">
                      <img src="https://bookdriver.sofinish.co.uk/frontendnew/img/logo2.png" width="155" height="60" alt="Logo" />
                    </td>
                  </tr>
                  <!--<tr>-->
                    <!--<td class="headline" align="center">Welcome Sir!</td>-->
                  <!--</tr>-->
                </table>

                <!-- Main Content -->
                <table width="75%" align="center" cellpadding="0" cellspacing="0" style="margin-top: 30px;">
                  <tr>
                    <td style="color:#444;">
                      <p><b>Dear Admin,</b></p>
                      <p>A new user has registered.</p>
                      <p>User login credentials are provided below:</p>

                      <p>
                        <strong>Username:</strong> {{$user_name}}<br />
                        <strong>Mobile:</strong> {{$user_mobile}}<br />
                        <strong>Password:</strong> {{$user_password}}
                      </p>
                    </td>
                  </tr>
                </table>

                <!-- Button -->
                <table width="100%" align="center" cellpadding="0" cellspacing="0" style="margin-top: 20px;">
                  <tr>
                    <td align="center">
                      <a href="https://bookdriver.sofinish.co.uk/" style="background-color:#674299; border-radius:4px; color:#fff; display:inline-block; font-size:18px; line-height:50px; width:350px; text-align:center; text-decoration:none;">
                        Visit Account and Start Managing
                      </a>
                    </td>
                  </tr>
                </table>

                <!-- Footer -->
                <table width="100%" align="center" cellpadding="0" cellspacing="0" style="margin-top: 30px;">
                  <tr>
                    <td align="center" style="color:#444;">
                      <!--<p>For any queries, feel free to contact us at <strong>07761 975326</strong>.</p>-->
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
