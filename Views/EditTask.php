<section>
    <div class="container">
        <div class="row">
            <div class="wrapper col-lg-push-4 col-md-4">

                        <h2>Edit task</h2>
                        <br/>
                        <?php if (isset($_SESSION['errors']) && is_array($_SESSION['errors'])): ?>
                            <ul>
                                <?php foreach ($_SESSION['errors'] as $error): ?>
                                    <li> - <?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif;
                            unset($_SESSION['errors']);
                        ?>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Add</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Preview</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <form action="/admin/edittask" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?=$data['id']?>">
                                    <div class="form-group">
                                        <label for="pwd">Username:</label>
                                        <input type="text" name="username" class="form-control" id="pwd" value="<?=$data['username']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address:</label>
                                        <input type="email" name="email" class="form-control" id="email" value="<?=$data['email']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Text:</label>
                                        <textarea name="description" class="form-control" rows="5" id="comment"><?=$data['description']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_completed">Completed:</label>
                                        <input type="checkbox" name="is_completed" id="is_completed" <?php if($data['is_completed']) {?> checked <?php } ?> >
                                    </div>
                                    <div class="form-group">
                                        <label for="file">Image:</label>
                                        <input type="file" id="imgInput" class="btn btn-default" name="image" placeholder="" value="">
                                    </div>
                                    <input type="submit" name="submit" class="btn btn-default" class="btn btn-default" value="Save">
                                </form>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3>Preview</h3>
                                <div class=''>
                                    <div class='thumbnail'>
                                        <?php if(is_null($data['image'])){ ?>
                                            <img id="imgInput-load" src='/public/img/no_image.jpg' alt='...'>
                                        <?php } else {?>
                                            <img id="imgInput-load" src='/public/upload/images/task/<?=$data['image']?>' alt='...'>
                                        <?php } ?>
                                        <div class='caption'>
                                            <p>Completed: <mark><?php if(!$data['is_completed']) {?> Not  <?php } ?>Done<mark></p>
                                            <blockquote class='blockquote-reverse small'>
                                                <footer>
                                                    Name: <span id="pwd-load"><?=$data['username']?></span>
                                                    Email: <span id="email-load"><?=$data['email']?></span></footer>
                                                    Description: <span id="comment-load"><?=$data['description']?></span>
                                                <blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </ul>
            </div>
        </div>
    </div>
</section>
