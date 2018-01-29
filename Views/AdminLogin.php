<?php
 use \Controllers\AdminController as AdminController;
?>

<div class="container">
    <div class="row">
        <div class="wrapper col-md-push-4 col-md-4" style="text-align: center">
            <div class=""><!--sign up form-->
                <h1>Login</h1>
                <form action="#" method="post">
                    <?php if(!AdminController::checkAdmin()){?>
                        <div class="form-group">
                            <input class="form-control"  type="text" name="username" placeholder="admin" value=""/>
                        </div>
                        <div class="form-group">
                            <input class="form-control"  type="password" name="password" placeholder="123" value=""/>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-default" value="login" />
                        </div>
                    <?php }else{?>
                        <p>You logged as admin</p>
                        <input type="submit" name="submit" class="btn btn-default" value="logout" />
                    <?php }?>
                </form>
            </div><!--/sign up form-->
        </div>
    </div>
</div>