<?php
session_start();
include "config.php";
include "authMiddleware.php";
include "view/header.php";
$stmt = $conn->prepare("SELECT * FROM profiles order by id desc");
$stmt->execute();
$profiles = $stmt->fetchAll();
?>
    <div class="box">
        <div class="box-header">
            <h4>لیست پروفایل های ثبت شده</h4>
        </div>
        <div class="box-body">
            <table class="table table-responsive table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام پروفایل</th>
                    <th>عکس پست زمینه</th>
                    <th>عکس کوچک</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($profiles as $profile) {
                    ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $profile['name'] ?></td>
                        <td><img src="<?= $profile['stamp'] ?>" class="img-responsive" style="width: 150px" alt=""></td>
                        <td><img src="<?= $profile['small_stamp'] ?>" class="img-responsive" style="width: 150px"
                                 alt="">
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="editProfile.php?id=<?= $profile['id'] ?>" class="btn btn-warning btn-sm">ویرایش</a>
                                <a href="deleteProfile.php?id=<?= $profile['id'] ?>" class="btn btn-danger btn-sm deleteBTN">حذف</a>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
	
<?php
include "view/footer.php";
?>
