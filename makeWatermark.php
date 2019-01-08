<?php
session_start();
include "authMiddleware.php";
include "config.php";
$stmt = $conn->prepare("SELECT id,name FROM profiles order by id desc");
$stmt->execute();
$profiles = $stmt->fetchAll();
if (isset($_POST['submit'])) {
    include "watermark.php";
    $target_dir = "uploads/";
    $zip_file = $target_dir . basename($_FILES["files"]["name"]);
    $imageFileType = strtolower(pathinfo($zip_file, PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["files"]["tmp_name"], $zip_file);

    $zip = new ZipArchive();
    $res = $zip->open($zip_file);
    if ($res === TRUE) {
        $id = uniqid();
        mkdir('uploads/' . $id);
        $zip->extractTo('uploads/' . $id . '/');
        $zip->close();
        foreach (glob('uploads/' . $id . '/*.*') as $file) {
            $SourceFile = $file;
            $stmt = $conn->prepare("SELECT * FROM profiles where id='" . $_POST['profile'] . "'");
            $stmt->execute();
            $profile = $stmt->fetch();
            $watermark = $profile['stamp'];
            $smallWatermark = $profile['small_stamp'];
            ImageAddWatermark($SourceFile, $watermark, $smallWatermark, $profile['stamp_opacity'], $profile['stamp_percentage'], $profile['degree'], $profile['small_stamp_opacity'], $profile['small_stamp_percentage'], $profile['position'], $profile['horizontal_distance'], $profile['vertical_distance']);
            if (isset($_POST['square'])) {
                $sizes = (getimagesize($SourceFile));
                if ($sizes[0] >= $sizes[1]) {
                    $img = imagecreatetruecolor($sizes[0], $sizes[0]);
                    imagesavealpha($img, true);
                    $color = imagecolorallocatealpha($img, 0, 0, 0, 127);
                    imagefill($img, 0, 0, $color);
                    $a = imagecreatefromjpeg($SourceFile);
                    imagecopyresampled($img, $a, 0, ($sizes[0]-($sizes[1]/$sizes[0])*$sizes[0])/2, 0, 0, $sizes[0], ($sizes[1]/$sizes[0])*$sizes[0], $sizes[0], $sizes[1]);
                    imagepng($img,$SourceFile);
                } else {
                    $img = imagecreatetruecolor($sizes[1], $sizes[1]);
                    imagesavealpha($img, true);
                    $color = imagecolorallocatealpha($img, 0, 0, 0, 127);
                    imagefill($img, 0, 0, $color);
                    $a = imagecreatefromjpeg($SourceFile);
                    imagecopyresampled($img, $a, ($sizes[1]-($sizes[0]/$sizes[1])*$sizes[1])/2,0 , 0, 0, ($sizes[0]/$sizes[1])*$sizes[1], $sizes[1], $sizes[0], $sizes[1]);
                    imagepng($img,$SourceFile);
                }
            }
        }
        unlink('result.zip');

        $newzip = new ZipArchive();
        if ($newzip->open('result.zip', ZipArchive::CREATE) === TRUE) {
            foreach (glob('uploads/' . $id . '/*.*') as $file) {

                $inf = explode('/', $file);
                $newzip->addFile($file, $inf[count($inf) - 1]);
            }
            $newzip->close();
        }

        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=result.zip");
        header("Content-length: " . filesize("result.zip"));
        readfile("result.zip");
    }
}
include "view/header.php";
?>
    <div class="box">
        <div class="box-header">
            <h4>ایجاد واترمارک </h4>
        </div>
        <div class="box-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <label for="">نام پروفایل</label>
                    <select name="profile" class="form-control" style="padding: 0 10px">
                        <option value="none">انتخاب کنید ...</option>
                        <?php foreach ($profiles as $profile): ?>
                            <option value="<?= $profile['id'] ?>"><?= $profile['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="">آپلود فایل zip تصاویر</label>
                    <input type="file" name="files" id="" accept=".zip" class="form-control">
                </div>
                <div class="col-md-12">
                    <input type="checkbox" value="1" name="square" id="square"/>
                    <label for="square">خروجی به صورت تصاویر مربعی</label>
                </div>
                <div class="col-md-12" style="margin-top: 10px">
                    <input type="submit" name="submit" value="ثبت نهایی" class="btn btn-success btn-sm">
                </div>
            </form>
        </div>
    </div>
<?php
include "view/footer.php";
?>