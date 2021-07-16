<!DOCTYPE html>
<html>
    <head>
        <title>Christianity Invoice</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{ asset('js/video-template.js') }}"></script>
        <style type="text/css">
            html{ height:100%;}
            body{ font-family: 'Roboto Condensed'; font-size:14px; font-weight:400; height:100%; margin: 0; padding: 0;}
            a{transition: all 0.2s ease 0s;}
            a:hover,a:focus,a:visited{ text-decoration:none; outline:none;}
            .main {
                width: 600px;
                margin: 0px auto;
            }
            @media only screen and (max-width : 580px) {
                .main {
                    width: 95%;
                    font-family: 'Roboto Condensed';
                }
            }
        </style>

    </head>
    <body>

        <table class="main" style="margin: 0px auto;" cellspacing="0" cellspacing="0" border="0">
            <tr>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td>
                    <img src="images/Order-pdf-template/header.jpg" alt="Christianity Header">
                </td>
            </tr>
            <tr>
                <td style="height: 50px;">
                    &nbsp;
                </td>
            </tr>

            <tr>
                <td style="padding: 10px 0; height: 60px;">
                    <?php echo $todayDate; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Dear <span style="color: #f68e17;"><?php echo $donation['first_name'] . ' ' . $donation['last_name']; ?>,</span>
                </td>
            </tr>
            <tr>
                <td style="">
                    <p style=" line-height: 22px; padding-bottom: 20px;">
                        Thank you for your donation of 
                        $<span style="color: #f68e17;">
                            <?php echo $donation['donation_amount']; ?>
                        </span> on <span style="color: #f68e17;">
                            <?php echo $todayDate; ?>
                        </span>. Your generosity to Christianity Engaged is making a difference by helping people overcome barriers to faith and grow spiritually through short, high-quality and engaging videos. 
                    </p>
                </td>
            </tr>

            <tr>
                <td style="background: #eee; padding: 10px;">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <th style="color: #295fa4; text-align: left; font-size: 16px; padding-bottom: 10px; border-bottom: 1px solid #666;">
                                GIFT DATE 
                            </th>
                            <th style="color: #295fa4; text-align: left; font-size: 16px; padding-bottom: 10px;border-bottom: 1px solid #666;">
                                GIFT AMOUNT 
                            </th>
                            <th style="color: #295fa4; text-align: left; font-size: 16px; padding-bottom: 10px;border-bottom: 1px solid #666;">
                                DONOR(S)
                            </th>
                        </tr>
                        <tr>
                            <td style="color: #f68e17; padding-top: 10px;">
                                <?php echo $todayDate; ?>
                            </td>
                            <td style="color: #f68e17; padding-top: 10px;">
                                $<?php echo $donation['donation_amount']; ?>
                            </td>
                            <td style="color: #f68e17; padding-top: 10px;">
                                <?php echo $donation['first_name'] . ' ' . $donation['last_name']; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    &nbsp;
                </td>
            </tr>

            <tr>
                <td>
                    <p style="padding-bottom: 10px;">No goods or services were provided in exchange for the contribution(s) above.</p>
                    <p style="padding-bottom: 10px;">Again, thank you for supporting our ministry.</p>
                    <p style="padding-bottom: 20px;">Sincerely,</p>
                </td>
            </tr>


            <tr>
                <td>
                    <img src="images/Order-pdf-template/sign.jpg" alt="David Erhart sign">
                </td>
            </tr>

            <tr>
                <td>
                    <p style="font-weight: bold; padding-bottom: 0;">David Erhart</p>
                    <p>Founder and CEO</p>
                </td>
            </tr>

            <tr>
                <td>
                    <p style="text-align: left; font-size: 12px; padding-bottom: 40px;">Christianity Engaged is a non-profit and exempt organization as described in Section 501(c)(3) of the Internal Revenue Code; EIN 81-5393192.</p>
                </td>
            </tr>

            <tr>
                <td>
                    <img src="images/Order-pdf-template/footer.jpg" alt="Christianity Footer">
                </td>
            </tr>

        </table>
    </body>
</html>