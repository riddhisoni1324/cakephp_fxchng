<?php echo $this->start('mail_content'); ?>

<table cellpadding="0" cellspacing="0" width="50px">
    <tbody>
        <tr>
            <td>
                <img src="https://ci6.googleusercontent.com/proxy/K74uHECNtyLocpvPoUOap5nQ3GeX4cdwRU0E56zcxxj5aPuWMbdbXApB55L8X5YP9MtXcRVxxgGxC3PUvQ4c2w=s0-d-e1-ft#http://www.fxchng.com/images/email_top.jpg" class="CToWUd">
            </td>
        </tr>
        <tr>
            <td style="border-left:1px solid #535353;border-right:1px solid #535353;min-height:500px">
                <table cellpadding="0" cellspacing="0" border="0" width="95%" align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:14px">
                    <tbody>
                    <tr><td height="30" colspan="2"></td></tr>
                    <tr>
                        <td>Hi <?php echo $name; ?>,
                            <p>Your friend <?php echo $sender_name; ?> want help for this ad <?php echo $ad_title; ?> from one of your friend <?php echo $ad_perosn_name; ?>.</p>
                            <h4>Message</h4>
                            <?php echo  $sender_msg; ?>
                            <p>
                                <strong>Team Fxchng</strong> <br>
                                <a href="http://www.fxchng.com" target="_blank">Website</a> | <a href="http://www.facebook.com/fxchng" target="_blank">Facebook</a> | <a href="http://www.twitter.com/fxchng" target="_blank">Twitter</a>
                            </p>
                            <p align="center">
                            ------------------------------<wbr>---------------------------- <br>
                            ------------------------------<wbr>------------------------------<wbr>-</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<table>
    <tbody>
    <tr>
        <td>
            <img src="https://ci5.googleusercontent.com/proxy/jEhXWDyFjX8hJ6im4eo7UUG4wJUtD-WiLS5PkkfUqQXBivcwyjFIgelZCzFNBL4U58tmddp506yXP1DJMPi12A=s0-d-e1-ft#http://www.fxchng.com/images/email_btm.jpg" class="CToWUd">
        </td>
    </tr>
    </tbody>
</table>

<?php echo $this->end('mail_content'); ?>