$(document).ready(function() {

  var access_token = "";

  $('.fb_auth').click(function() {

    // Load the SDK asynchronously
    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    window.fbAsyncInit = function() {
      FB.init({
        appId      : '1395403257455928',
        cookie     : true,  // enable cookies to allow the server to access
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.3' // use version 2.3
      });

      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });
    };

    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
      if (response.status === 'connected') {
        // Logged into your app and Facebook.
        FBLogin();
      }
      else if (response.status === 'not_authorized') {
      }
      else {
        FBLogin(); // call FBLogin method for login into FB
      }
    } // end of function statusChangeCallback
  }); // end of fb_login click function

  // This function is called when someone finishes with the Login button.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

// make window open for login into FB
  function FBLogin() {
      FB.login(function(response) {
        if (response.authResponse) {
          access_token = response.authResponse.accessToken;
          getUserInfo(); //Get User Information.
          // console.log('FBLogin', response.authResponse);
        }
        else {
          console.log("Authorization failed");
        }
      },{scope: 'public_profile,email,user_friends,user_birthday'});
  }

  // for testig :D
  function getDetails() {
    FB.api (
      '/me/',
      {
        "fields": "id,name,first_name,last_name,email,gender,link,verified,birthday,context.fields(mutual_friends)"
      },
      function(response) {
        console.log(JSON.stringify(response));
        console.log(response.context.mutual_friends.summary.total_count);
    });
  }

  function getUserInfo() {
    FB.api(
      '/me',
      {
        "fields": "id,name,first_name,last_name,email,gender,link,verified,birthday,context.fields(mutual_friends)"
      },
      function(response) {
      // console.log(response);
      var address = baseUrl+"/users/callback/"+access_token;

      // console.log(JSON.stringify(response));

      // call other methods
      set_user_details(response.name, response.email);

      $.ajax({
        type: "POST",
        url: address,
        cache : false,
        data : response,
        success: function(msg) {
          // console.log(msg);

          // set user pic
          url_set_user_pic = baseUrl+'/users/set_user_pic';
            $.ajax({
              type: 'GET',
              url: url_set_user_pic,
              success: function(login_view) {
                $(".logintopmainarea").html(login_view);

                // check new user or not
                if(msg == 0) {
                   $('#invite_modal').modal('show');
                }
              }
            });
             // display mutual friend box
              url_set_mutual_friend = baseUrl+'/home/set_mutual_friend_box';
              $.ajax({
                type: 'GET',
                url: url_set_mutual_friend,
                success: function(set_mutual_box) {
                  $('#mutual_friend_box').html(set_mutual_box);
                  // $('#common_friend_box').html(set_mutual_box);
                  // $('.show_msg_rply_n_offer').html();
                }
              });
        },
        error : function(XMLHttpRequest, textStatus, errorThrown) {
          console.log("error :: " + textStatus + " : " + errorThrown);
        }
      }); // end of ajax
    }); // end of FB.api
  } // end of get userinfo

  // set user detials in ad_post
  function set_user_details(name, email) {
    // console.log('details');
    $('#name').val(name);
    $('#email').val(email);
    $('#is_logged_in').val(1);

    // hide fb-login button
    $('.hide_fb').hide();

  }
}); // end of main ready function