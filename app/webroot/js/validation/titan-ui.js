function TitanUI() {
    this.count = 0;
}


TitanUI.prototype.showDialog = function(el)
{
    $(el).prependTo('body');
    $(el).addClass("open-dialog");
    var elem = el;
    if($(".titan-dialog-back").length==0)
    {
        $('body').append('<div class="titan-dialog-back"></div>');
        $(".titan-dialog-back").click(function()
        {
            var titanUI = new TitanUI();
            if($(".open-dialog").length>1)
            {
                titanUI.hideDialog(elem,false);
            }
            else
            {
                titanUI.hideDialog(elem,true);
            }
        });
    }
    if($(".open-dialog-back").length == 0)
    {
        $(".titan-dialog-back").fadeIn(500, function(){
            $(el).fadeIn(500, function()
            {
                var dialog = $(this);

                if(!$(this).is(".dialog-container"))
                {
                    dialog.prepend('<p class="titan-close"></p>');
                }
                else{
                    dialog.find(".titan-dialog-box").prepend('<p class="titan-close"></p>');
                }

                $(".titan-close").click(function(e)
                {
                    $(this).remove();
                    titanUI.hideDialog(dialog,true);
                })
            });
        });
        $(".titan-dialog-back").addClass("open-dialog-back");
    }
    else{
        $(".titan-dialog-back").unbind('click');
        $(".titan-dialog-back").click(function()
        {
            var titanUI = new TitanUI();
            if($(".open-dialog").length>1)
            {
                titanUI.hideDialog(elem,false);
            }
            else
            {
                titanUI.hideDialog(elem,true);
            }
        });
    }

};

TitanUI.prototype.hideDialog = function(el, back, callback)
{

    $(el).fadeOut(500, function()
    {
        if(callback != null || callback != undefined)
        {
            callback();
        }
    });
    $(el).removeClass("open-dialog");
    if(back==true)
    {
        $(".titan-dialog").fadeOut(500);
        $(".titan-dialog").removeClass("open-dialog");
        $(".titan-dialog-back").fadeOut(500);
        $(".titan-dialog-back").removeClass("open-dialog-back");
    }
    /* FOr wish list */
    $('.product-main-addtowishlist').removeClass('disabled-wish');
    $('.product-main-addtowishlist').val('Add to Wishlist');
    $('.product-main-submitreview').removeClass('disabled');
    $('.product-main-submitreview').val('Submit Review');

}

TitanUI.prototype.emailValidation = function(el,required)
{
    var self = this;
    $(el).focusout(function(e)
    {
        var email = $(el).val();

        var title = "";
        if($(el).attr("title")!=undefined)
        {
            title = $(el).attr("title");
        }

        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email))
        {
            $(el).removeClass("error").addClass("error");
            $(el).removeClass("success");

            if(email == "" && required==true)
            {
                $(el).attr("data-error",title+ " is required.")
            }
            else{
                $(el).attr("data-error","The " + title + " appears to be invalid.")
            }

        }
        else{
            $(el).removeClass("success").addClass("success");
            $(el).removeClass("error");

            $(el).removeAttr("data-error");
        }

        self.addError(el);
    })
}

TitanUI.prototype.minSizeValidation = function(el, size)
{
    var self = this;
    $(el).focusout(function(e)
    {

        var text = $(el).val();

        var title = "";
        if($(el).attr("title")!=undefined)
        {
            title = $(el).attr("title");
        }

        if(text.length<size)
        {
            $(el).removeClass("error").addClass("error");
            $(el).removeClass("success");

            if(text == "")
            {
                $(el).attr("data-error",title+" is required.")
            }
            else{
                $(el).attr("data-error","Minimum size for " + title+ " is " + size + " characters.");
            }
        }
        else{
            $(el).removeClass("success").addClass("success");
            $(el).removeClass("error");

            $(el).removeAttr("data-error");
        }
        self.addError(el);
    })
}

TitanUI.prototype.maxSizeValidation = function(el, size)
{
    var self = this;
    $(el).focusout(function(e)
    {

        var text = $(el).val();

        var title = "";
        if($(el).attr("title")!=undefined)
        {
            title = $(el).attr("title");
        }

        if(text.length>size)
        {
            $(el).removeClass("error").addClass("error");
            $(el).removeClass("success");

            if(text == "")
            {
                $(el).attr("data-error",title+" is required.")
            }
            else{
                $(el).attr("data-error","Maximum size for " + title+ " is " + size + " characters.");
            }
        }
        else{
            $(el).removeClass("success").addClass("success");
            $(el).removeClass("error");

            $(el).removeAttr("data-error");
        }

        self.addError(el);
    })
}

TitanUI.prototype.superValidation = function(el,regexMode,required,minsize,maxSize){
    var self = this;
    $(el).focusout(function(e)
    {

        var text = $(el).val();

        var title = "";
        if($(el).attr("title")!=undefined)
        {
            title = $(el).attr("title");
        }

        var regex="";
        if(regexMode=="alpha-only"){
            regex = /^[a-zA-Z ]*$/;
        }
        if(regexMode=="number-only"){
            regex = /^\d+$/;
        }
        if(regexMode == "emailid")
        {
            regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        }
        if(regexMode == "email")
        {
            regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        }
        if(regexMode == "mobile"){
            regex = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        }

        if(text=="" && required == true){
            $(el).removeClass("error").addClass("error");
            $(el).removeClass("success");
            $(el).attr("data-error",title+ " is required.")

        }
        else if(regex != "" &&!regex.test(text)){
            $(el).removeClass("error").addClass("error");
            $(el).removeClass("success");
            $(el).attr("data-error","The data in " + title + " appears to be invalid.")

        }
        else if(minsize != undefined && text.length<minsize){
            $(el).removeClass("error").addClass("error");
            $(el).removeClass("success");
            $(el).attr("data-error","Minimum " + minsize + " characters required for " + title + ".")

        }
        else if(maxSize != undefined && text.length>maxSize){
            $(el).removeClass("error").addClass("error");
            $(el).removeClass("success");
            $(el).attr("data-error","Maximum " + maxSize + " characters allowed for " + title + ".")

        }
        else{
            $(el).removeClass("success").addClass("success");
            $(el).removeClass("error");

            $(el).removeAttr("data-error");
        }

        self.addError(el);
    });
}


TitanUI.prototype.addError = function(el)
{
    if($(el).closest("form").attr("data-titan-validate")=="true")
    {
        if($(el).is(".error"))
        {
            if($(el).next().is(".titan-validation-msg")){
                $(el).next().remove();
            }
            // $(el).after('<p class="titan-validation-msg error">' + $(el).attr("data-error") + '</p>');
        }
        else{
            if($(el).next().is(".titan-validation-msg")){
                $(el).next().remove();
            }
        }
    }
}

TitanUI.prototype.addLabel = function(el, msg, type)
{
    if($(el).next().is(".form-sublabel"))
    {
        $(el).next().remove();
    }
    if(type == "success")
    {
        $(el).after('<p class="form-sublabel"><span class="success">' + msg + '</span></p>');
    }
    else{

        $(el).after('<p class="form-sublabel"><span class="negative">' + msg + '</span></p>');
    }
}

TitanUI.prototype.removeLabel = function(el)
{
    if($(el).next().is(".form-sublabel"))
    {
        $(el).next().remove();
    }
}


TitanUI.prototype.addSuccess = function(el, msg)
{
    $(el).removeClass("success").addClass("success");
}

TitanUI.prototype.removeError = function(el)
{
    $(el).removeClass("error");
    $(el).removeAttr("data-error");
}

TitanUI.prototype.mobileValidation = function(el)
{
    $(el).focusout(function(e)
    {
        var str = $(el).val();

        var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

        if((str.match(phoneno)) || str == "")
        {
            $(el).removeClass("success").addClass("success");
            $(el).removeClass("error");

            $(el).removeAttr("data-error");
            return true;
        }
        else
        {
            $(el).removeClass("error").addClass("error");
            $(el).removeClass("success");

            $(el).attr("data-error",title+" is not a valid mobile number.")
            return false;
        }
    });

    $(el).on('keydown',function(e){
        var key = e.charCode || e.keyCode || 0;

        // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
        //var cn = $(this).val().indexOf(".");
        var val = $(this).val();

        return (
            key == 189 ||
                ( key == 187 && e.shiftKey) ||
                key == 8 ||
                key == 9 ||
                key == 46 ||
                (key >= 37 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                //($(this).is(".y-negative") && val.indexOf("-") == -1 && key == 189) ||
                (key >= 96 && key <= 105) ||
                key == 16 ||
                key == 36
            );

    });

}
TitanUI.prototype.requiredValidation = function(el, size)
{
    var self = this;
    $(el).focusout(function(e)
    {
        var text = $(el).val();

        var title = "";
        if($(el).attr("title")!=undefined)
        {
            title = $(el).attr("title");
        }

        if(text=="")
        {
            $(el).removeClass("error").addClass("error");
            $(el).removeClass("success");

            $(el).attr("data-error",title+" is required.")
        }
        else{
            $(el).removeClass("success").addClass("success");
            $(el).removeClass("error");

            $(el).removeAttr("data-error");
        }
        self.addError(el);
    })
}
TitanUI.prototype.requiredOnChangeValidation = function(el, size)
{
    var self = this;
    $(el).change(function(e)
    {
        var text = $(el).val();

        var title = "";
        if($(el).attr("title")!=undefined)
        {
            title = $(el).attr("title");
        }

        if(text=="")
        {
            $(el).removeClass("error").addClass("error");
            $(el).removeClass("success");

            $(el).attr("data-error",title+" is required.")
        }
        else{
            $(el).removeClass("success").addClass("success");
            $(el).removeClass("error");

            $(el).removeAttr("data-error");
        }
        self.addError(el);
    })

    var self = this;
    $(el).focusout(function(e)
    {
        var text = $(el).val();

        var title = "";
        if($(el).attr("title")!=undefined)
        {
            title = $(el).attr("title");
        }

        if(text=="")
        {
            $(el).removeClass("error").addClass("error");
            $(el).removeClass("success");

            $(el).attr("data-error",title+" is required.")
        }
        else{
            $(el).removeClass("success").addClass("success");
            $(el).removeClass("error");

            $(el).removeAttr("data-error");
        }
        self.addError(el);
    })
}

TitanUI.prototype.checkValidation = function(elForm, elErrorBlock)
{
    $(elForm).find("input[type='password'],input[type='text'],input[type='number'],select").each(function()
    {
        $(this).focusout();
    });

    $(elForm).find("textarea").each(function()
    {
        $(this).focusout();
    });

    if(elErrorBlock != undefined && !$(elForm).attr("data-titan-validate"))
    {
        $(elErrorBlock).html("");
        if($(elForm).find(".error").length>0)
        {
            var errorBox = elErrorBlock;
            $(elForm).find(".error").each(function()
            {
                $(errorBox).append("<li>"+$(this).attr("data-error")+"</li>");
            })
            return false;
        }
    }
    else{
        if($(elForm).find(".error").length>0){
            return false;
        }
    }
    return true;
}

TitanUI.prototype.onlyNumbers = function(el){

  $(el).keypress(function (e) {
        console.log(e.which);
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        //$("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
    // $(el).keydown(function(e){
    //     // var key = e.keyCode ? e.keyCode : e.which;
    //     //Check for backspace
    //     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {return false;}
    //     // if(key==8){return true;}
    //     // if(key >= 96 || key <= 105){console.log(key); return true;}
    //     // if ( isNaN( String.fromCharCode(key) ) ) return false;
    // });
    // return true;
}

TitanUI.prototype.onlyNumbersDots = function(el){

  $(el).keypress(function (e) {
        //console.log(e.which);
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) {
        //display error message
        //$("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
    // $(el).keydown(function(e){
    //     // var key = e.keyCode ? e.keyCode : e.which;
    //     //Check for backspace
    //     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {return false;}
    //     // if(key==8){return true;}
    //     // if(key >= 96 || key <= 105){console.log(key); return true;}
    //     // if ( isNaN( String.fromCharCode(key) ) ) return false;
    // });
    // return true;
}

TitanUI.prototype.onlyNumbersMinus = function(el){

  $(el).keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     console.log(e.which);
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 45) {
        //display error message
        //$("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
    // $(el).keydown(function(e){
    //     // var key = e.keyCode ? e.keyCode : e.which;
    //     //Check for backspace
    //     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {return false;}
    //     // if(key==8){return true;}
    //     // if(key >= 96 || key <= 105){console.log(key); return true;}
    //     // if ( isNaN( String.fromCharCode(key) ) ) return false;
    // });
    // return true;
}

TitanUI.prototype.onlyNumbersFK = function(el){

    $(el).keydown(function(e){
        var key = e.keyCode ? e.keyCode : e.which;
        //Check for backspace
        if(key==8){return true;}
        if(key >= 96 || key <= 105){console.log(key); return true;}
        if ( isNaN( String.fromCharCode(key) ) ) return false;
    });
    return true;
}

TitanUI.prototype.onlyAlphas = function(el){
    $(el).keydown(function (e)
    {

         var arr = [8,9,16,17,20,32,35,36,37,38,39,40,45,46];

          // Allow letters
          for(var i = 65; i <= 90; i++){
            arr.push(i);
          }

          console.log(e.which);
          if(jQuery.inArray(e.which, arr) === -1)
          {
            e.preventDefault();
          }
    });
}


TitanUI.prototype.onlyAlphasSmall = function(el){
    $(el).keydown(function(e)
    {
        // console.log(e);
        if (e.shiftKey || e.ctrlKey || e.altKey)
        {
            e.preventDefault();
        }
        else
        {
            var key = e.keyCode;
            if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90)))
            {
                e.preventDefault();
            }
        }

    });
}

var titanUI = new TitanUI();