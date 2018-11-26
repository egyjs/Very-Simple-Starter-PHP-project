<?php
$pageOption =
    array(
        'title' => @$username,
        'bgcolor' => "bg-dark",
        'sidebar' => false,
        'auth' => true

    );
$err=array();
if (isset($_POST['go'])) {
    $selectByEmail = selectby(['email'=> $_POST['email']],'users');
    if ($selectByEmail == false){
        if ($_POST['repass'] == $_POST['password']){
            if (!empty_table('users')){
                if ($_POST['utype'] !=""){
                    insert_into_table('users',[
                        'full_name'=>$_POST['name'],
                        'email'=>$_POST['email'],
                        'date_of_birth'=>$_POST['birth'],
                        'password'=>md5($_POST['password']),
                        'type'=>$_POST['utype'],
                    ]);
                    echo "<script> alert('تم التسجيل بنجاح'); window.location.href='login'; </script>";
                }else{
                    $err[]= "يجب اختيار عضوية";
                }


            }else{
                insert_into_table('users',[
                        'full_name'=>$_POST['name'],
                        'email'=>$_POST['email'],
                        'date_of_birth'=>$_POST['birth'],
                        'password'=>md5($_POST['password']),
                        'type'=>0,
                ]);
                echo "<script> alert('تم التسجيل بنجاح'); window.location.href='login'; </script>";

            }

        }else{
            $err[]='كلمة المرور غير متطابقة';
        }
    }else{
        $err[]='هذا المستخدم موجود مسبقا';
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
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">تسجيل حساب</div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <input type="text" id="fullName" class="form-control" name="name"
                                           placeholder="Full name" required="required" autofocus="autofocus">
                                    <label for="fullName">الاسم الرباعي</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="email" id="inputEmail" name="email" style="text-align: left" class="form-control"
                                           placeholder="عنوان البريد الإلكتروني" required="required">
                                    <label for="inputEmail">البريد الإلكتروني</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" id="inputTel" name="tel" style="text-align: left" class="form-control"
                                           placeholder="الهاتف" required="required">
                                    <label for="inputTel">رقم الجوال</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <input type="date" id="inputBirth" class="form-control" name="birth"
                                           placeholder="تاريخ الميلاد" required="required" autofocus="autofocus">
                                    <label for="inputBirth">تاريخ الميلاد</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="password" style="text-align: left" id="inputPassword" name="password"
                                           class="form-control" placeholder="كلمة المرور" required="required">
                                    <label for="inputPassword">كلمة المرور</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="password" style="text-align: left" id="confirmPassword" name="repass"
                                           class="form-control" placeholder="اعد كلمة المرور" required="required">
                                    <label for="confirmPassword">اعد كلمة المرور</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <select id="utype" name="utype"  class="form-control">
                                <option value="">عضويتك؟</option>
                                <option disabled>***********</option>
                                <option value="1">فندق</option>
                                <option value="2">مستأجر</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="go" class="btn btn-primary btn-block" href="login.php">تسجيل</button>
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="login">دخول</a>
                </div>
            </div>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>