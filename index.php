<?php
  // set page headers
  $page_title = "Login";
  include_once __DIR__."\libs\assets\layout_header.php";
  include_once __DIR__."\controllers\loginController.php";

  if($_POST){
    $user = New LoginController();
    $loginResult = $user->login();
  }
?>
<div class="login-container">
		<div class="sign-up-container">
			<div class="login-signup">
				<a href="registration.php">Sign up</a>
			</div>
			<div class="signup-align">
				<form name="login" action="" method="post"
					onsubmit="return loginValidation()">
					<div class="signup-heading">Login</div>
				<?php if(!empty($loginResult)){?>
				<div class="error-msg"><?php echo $loginResult;?></div>
				<?php }?>
				<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Username<span class="required error" id="email-info"></span>
							</div>
							  <input class="input-box-330" type="email" name="email" id="email">
						</div>
					</div>
					<div class="row">
						<div class="inline-block">
							<div class="form-label">
								Password
                  <span class="required error" id="password-info"></span>
							</div>
							  <input class="input-box-330" type="password" name="password" id="password">
						</div>
					</div>
					<div class="row">
						<input class="btn" type="submit" name="login-btn"
							id="login-btn" value="Login">
					</div>
				</form>
			</div>
		</div>
	</div>
    <script>
      function loginValidation() {
        var valid = true;
        $("#email").removeClass("error-field");
        $("#password").removeClass("error-field");

        var UserName = $("#email").val();
        var Password = $('#password').val();

        $("#email-info").html("").hide();

        if (UserName.trim() == "") {
          $("#email-info").html("required.").css("color", "#ee0000").show();
          $("#email").addClass("error-field");
          valid = false;
        }
        if (Password.trim() == "") {
          $("#password-info").html("required.").css("color", "#ee0000").show();
          $("#password").addClass("error-field");
          valid = false;
        }
        if (valid == false) {
          $('.error-field').first().focus();
          valid = false;
        }
        return valid;
      }
  </script>
<?php
// footer
include_once __DIR__."\libs\assets\layout_footer.php";
?>