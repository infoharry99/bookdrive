<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Welcome</title>
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Nunito);

        /* Resetting styles */
        img {
            max-width: 600px;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
        html {
            margin: 0;
            padding: 0;
        }
        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100%;
            height: 100%;
            color: #666;
            background: #fff;
            font-size: 16px;
            margin: 0;
            padding: 20px;
            font-family: 'Nunito', Helvetica, Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
        }
        .headline {
            color: #444;
            font-size: 36px;
        }
        .force-full-width {
            width: 100% !important;
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
            width: 350px;
        }

        /* Mobile Styles */
        @media only screen and (max-width: 480px) {
            table[class="w320"] {
                width: 320px !important;
            }
            .headline {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

    <table align="center" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" bgcolor="#fff" valign="top">
                <table cellpadding="0" cellspacing="0" class="w320" style="margin: 0 auto;" width="600">
                    <tr>
                        <td align="center" valign="top">
                            <img alt="Logo" src="https://bookdriver.sofinish.co.uk/frontendnew/img/logo2.png" height="60" width="155">
                        </td>
                    </tr>
                    <tr>
                        <td class="headline">Welcome Aboard!</td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                <table cellpadding="0" cellspacing="0" style="margin: 0 auto;" width="75%">
                                    <tr>
                                        <td style="color:#444; font-weight: 400;">
                                            <br><br>
                                            <b>Dear {{$user_name}},</b><br><br>
                                            Welcome aboard! We're thrilled to have you join our community.
                                            As you embark on this exciting academic journey, our team is here to support and guide you.
                                            Here's to a successful and enriching experience ahead!
                                            <br><br>
                                            Your login credentials are provided below:
                                            <br><br>
                                            <strong>Email:</strong> {{$email}}<br>
                                            <strong>Mobile:</strong> {{$user_mobile}}<br>
                                            <strong>Password:</strong> {{$user_password}}<br><br>
                                        </td>
                                    </tr>
                                </table>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="">
                                <a href="https://bookdriver.sofinish.co.uk/" class="button">Visit Account and Start Managing</a>
                            </div>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td class="force-full-width" style="text-align:center; color:#444;">
                            <!--<p>For any queries, feel free to contact us at 07761 975326</p>-->
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
