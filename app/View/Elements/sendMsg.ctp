<div class="detailright">
    <div class="detailname">
        <div class="detailname1"></div>
            <div class="detailname2">
                <img src="<?php echo $this->base."/img/img_candiate.jpg";?>">
            </div>
        <div class="clear"></div>
    </div>

    <div class="ownername">Khan</div>
    <div class="loginnewrightarea">

        <div class="tranferbg">
            <div>
                Signup / Login with Facebook to explore all the features of Fxchng!
            </div>

            <span>
                <a href="#"><img src="<?php echo $this->base."/img/btn_facebooklogin1.jpg";?>" alt=""></a>
            </span> 
        </div>

        <div class="clear"></div>

        <p class="hdtitle">Send Message</p>
        <form action="#" name="contactfrm" id="contactfrm" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
            <div id="loginimage" style="text-align: center; display:none;"><img src="<?php echo $this->base;?>/img/ajax-loader.gif"></div>
            <div class="formanew">             
                <input type="text" name="mname" value="" class="required" placeholder="Name">
                <input type="text" name="memail" value="" class="required email" placeholder="Email ID">
                <input type="text" name="mphone" value="" class="required number" placeholder="Phone">
                <textarea placeholder="Message" name="mmessage" class="required"></textarea>
                <label style="color:black" class="checkboxareanew"><input type="checkbox" name="sendtome" >Send copy to me</label>
                <input type="button" value="SEND" class="submit">
            </div>
            <div class="formanew" style="display:none;">
                <div class="success2" id="allreadsend">Message Sent Successfully</div>
            </div>
        </form>
    </div>
</div>