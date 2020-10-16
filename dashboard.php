<?php 
session_start();

$page_title = "Dashboard";
include_once __DIR__."\libs\assets\layout_header.php";

if (isset($_SESSION["email"])) {
include_once __DIR__."\controllers\loginController.php";
    $user = New LoginController();
    $loginResult = $user->getUser($_SESSION["email"]);
    
    $data["name"]=$loginResult[0]["name"];
    $data["email"]=$loginResult[0]["email"];
    $data["gender"]=$loginResult[0]["gender"];


    session_write_close();
} else {
    session_write_close();
    $url = "./index.php";
    header("Location: $url");
}

if($_POST){
    session_start();
    session_unset();
    session_write_close();
    $url = "./index.php";
    header("Location: $url");

}
?>
     <div class="error-msg" id="error-msg"></div>
            <div class="row">
                <div class="inline-block">
                    <div class="form-label">
                        Username
                    </div>
                    <input class="input-box-330" type="text" name="name" id="name" value="<?php echo $data["name"]?>" disabled>
                </div>
            </div>
            <div class="row">
                <div class="inline-block">
                    <div class="form-label">
                        Email
                    </div>
                    <input class="input-box-330" type="text" name="email" id="email" value="<?php echo $data["email"]?>" disabled>
                </div>
            </div>
            <div class="row">
                <div class="inline-block">
                    <div class="form-label">
                        Gender
                    </div>
                    <input class="input-box-330" type="text" name="gender" id="gender" value="<?php echo $data["gender"]?>" disabled>
                </div>
            </div>
            <div class="row">
            <form name="sign-up" action="" method="post">
                <input class="btn" type="submit" name="signup-btn"
                    id="signup-btn" value="Logout">
            </form>
            </div>
    </div>
</div>
</div>

<?php
// footer
include_once __DIR__."\libs\assets\layout_footer.php";
?>