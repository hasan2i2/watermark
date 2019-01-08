<?php
session_start();
include "authMiddleware.php";
include "config.php";
if (isset($_POST['submit'])) {
	$sql="select * from profiles where id='$_GET[id]'";
	$resp=$conn->prepare($sql);
	$resp->execute();
	$row = $resp->fetch();
	if($_FILES["stamp"]["name"]){
		$target_dir = "uploads/";
		$stamp_file = $target_dir . basename($_FILES["stamp"]["name"]);
		$imageFileType = strtolower(pathinfo($stamp_file, PATHINFO_EXTENSION));
		move_uploaded_file($_FILES["stamp"]["tmp_name"], $stamp_file);
	}else{
		$stamp_file=$row['stamp'];
	}
	if($_FILES["small_stamp"]["name"]){
		$target_dir = "uploads/";
		$small_stamp_file = $target_dir . basename($_FILES["small_stamp"]["name"]);
		$imageFileType = strtolower(pathinfo($small_stamp_file, PATHINFO_EXTENSION));
		move_uploaded_file($_FILES["small_stamp"]["tmp_name"], $small_stamp_file);
	}else{
		$small_stamp_file=$row['small_stamp'];
	}
    try {
        $sql = "update profiles set name='$_POST[name]' ,stamp='$stamp_file' ,small_stamp='$small_stamp_file' ,degree='$_POST[stamp_degree]' ,stamp_opacity='$_POST[opacity]' ,small_stamp_opacity='$_POST[small_opacity]' ,stamp_percentage='$_POST[stamp_percentage]' ,small_stamp_percentage='$_POST[small_stamp_percentage]' ,horizontal_distance='$_POST[horizontal_distance]' ,vertical_distance= '$_POST[vertical_distance]',position='$_POST[position]' where id='$_GET[id]'";
        $conn->exec($sql);
    } catch (PDOException $exception) {
        die($exception->getMessage());
    }
    return redirect('profiles.php', true);
}
$sql="select * from profiles where id='$_GET[id]'";
$resp=$conn->prepare($sql);
$resp->execute();
$row = $resp->fetch();

include "view/header.php";
?>
    <div class="box">
        <div class="box-header">
            <h4>ویرایش پروفایل</h4>
        </div>
        <div class="box-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <label for="">نام پروفایل</label>
                    <input type="text" name="name" class="form-control" value="<?= $row['name'] ?>"/>
                </div>
                <div class="col-md-6">
                    <label for="">آپلود واترمارک پس زمینه</label>
					<img src="<?= $row['stamp'] ?>" style="width:30%" />
                    <input type="file" name="stamp" accept=".png" class="form-control"/>
                </div>

                <div class="col-md-6">
                    <label for="">آپلود واترمارک کوچک</label>
                    <img src="<?= $row['small_stamp'] ?>" style="width:30%" />
                    <input type="file" name="small_stamp" accept=".png" class="form-control"/>
                </div>

                <div class="col-md-6">
                    <label for="">درجه شفافیت واترمارک پس زمینه</label>
                    <input type="number" min="0" max="100" name="opacity" value="<?= $row['stamp_opacity'] ?>" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">درجه شفافیت واترمارک کوچک</label>
                    <input type="number" min="0" max="100" name="small_opacity" value="<?= $row['small_stamp_opacity'] ?>" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">درصد فاصله واترمارک پس زمینه از اطراف</label>
                    <input type="number" min="0" max="100" name="stamp_percentage" value="<?= $row['stamp_percentage'] ?>" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">درجه چرخش واترمارک پس زمینه </label>
                    <input type="number" min="0" max="360" name="stamp_degree" value="<?= $row['degree'] ?>" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">درصد فاصله افقی واترمارک کوچک</label>
                    <input type="number" min="0" max="100" name="horizontal_distance" value="<?= $row['horizontal_distance'] ?>" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">درصد فاصله عمودی واترمارک کوچک</label>
                    <input type="number" min="0" max="100" name="vertical_distance" value="<?= $row['vertical_distance'] ?>" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">درصد اندازه واترمارک کوچک</label>
                    <input type="number" min="0" max="100" name="small_stamp_percentage" value="<?= $row['small_stamp_percentage'] ?>" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">مکان واترمارک کوچک</label>
                    <select name="position" class="form-control" style="padding: 0 10px">
                        <option value="none">انتخاب کنید ...</option>
                        <option value="top-left" <?= $row['position']=="top-left"?"selected":"" ?>>بالا - چپ</option>
                        <option value="top-right" <?= $row['position']=="top-right"?"selected":"" ?>>بالا - راست</option>
                        <option value="bottom-left" <?= $row['position']=="bottom-left"?"selected":"" ?>>پایین - چپ</option>
                        <option value="bottom-right" <?= $row['position']=="bottom-right"?"selected":"" ?>>پایین - راست</option>
                    </select>
                </div>

                <div class="col-md-12" style="margin-top: 10px">
                    <input type="submit" value="بروزرسانی" name="submit" class="btn btn-success"/>
                </div>
            </form>
        </div>
    </div>
<?php
include "view/footer.php";
?>