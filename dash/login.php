<?php
if (is_login()){
    to('/dash');
}
$pageOption =
    array(
        'title' => @$username,
        'bgcolor' => "bg-dark",
        'sidebar' => false,
        'auth' => true

    );
$err=array();
if (isset($_POST['go'])) {
    $selectByEmail = selectby(['email'=> $_POST['email'],'password'=>md5($_POST['pass'])],'users');
    if ($selectByEmail != false){
        $_SESSION['user']=$selectByEmail[0];
        to('../');
    }else{
        $err[]= "كلمة المرو او البريد غير صحيحين";
    }
}
?>
<?php include 'inc/header.php'; ?>

<?php
if (!empty($err)){
    echo "<div class=\"container alert alert-danger\"><ul>";
    foreach ($err as $er){
        echo "<li><strong>خطأ!</strong> $er</li>";
    }
    echo "</ul></div>";
}
?>
<div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">دخول</div>
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" style="text-align: left" id="inputEmail"name="email" class="form-control" placeholder="البريد الإلكتروني" required="required" autofocus="autofocus">
                <label for="inputEmail">البريد الإلكتروني</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password"  style="text-align: left" name="pass" id="inputPassword" class="form-control" placeholder="كلمة المرور" required="required">
                <label for="inputPassword">كلمة المرور</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                    تذكرني
                </label>
              </div>
            </div>
            <button type="submit" name="go" class="btn btn-primary btn-block" href="index.html">دخول</button>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="register">تسجيل حساب </a>
          </div>
        </div>
      </div>
    </div>
<?php include 'inc/footer.php'; ?>