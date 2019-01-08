<?php
session_start();
include "authMiddleware.php";
include "config.php";
if (isset($_POST['submit'])) {
    $target_dir = "uploads/";
    $stamp_file = $target_dir . basename($_FILES["stamp"]["name"]);
    $imageFileType = strtolower(pathinfo($stamp_file, PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["stamp"]["tmp_name"], $stamp_file);

    $target_dir = "uploads/";
    $small_stamp_file = $target_dir . basename($_FILES["small_stamp"]["name"]);
    $imageFileType = strtolower(pathinfo($small_stamp_file, PATHINFO_EXTENSION));
    move_uploaded_file($_FILES["small_stamp"]["tmp_name"], $small_stamp_file);

    try {
        $sql = "INSERT INTO profiles (name, stamp, small_stamp,degree,stamp_opacity,small_stamp_opacity,stamp_percentage,small_stamp_percentage,horizontal_distance,vertical_distance,position) VALUES ('$_POST[name]','$stamp_file', '$small_stamp_file', '$_POST[stamp_degree]','$_POST[opacity]','$_POST[small_opacity]','$_POST[stamp_percentage]','$_POST[small_stamp_percentage]','$_POST[horizontal_distance]','$_POST[vertical_distance]','$_POST[position]')";
        $conn->exec($sql);
    } catch (PDOException $exception) {
        die($exception->getMessage());
    }
    return redirect('profiles.php', true);
}
include "view/header.php";
?>
    <div class="box">
        <div class="box-header">
            <h4>ایجاد پروفایل جدید</h4>
        </div>
        <div class="box-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <label for="">نام پروفایل</label>
                    <input type="text" name="name" class="form-control"/>
                </div>
                <div class="col-md-6">
                    <label for="">آپلود واترمارک پس زمینه</label>
                    <input type="file" name="stamp" accept=".png" class="form-control"/>
                </div>

                <div class="col-md-6">
                    <label for="">آپلود واترمارک کوچک</label>
                    <input type="file" name="small_stamp" accept=".png" class="form-control"/>
                </div>

                <div class="col-md-6">
                    <label for="">درجه شفافیت واترمارک پس زمینه</label>
                    <input type="number" min="0" max="100" name="opacity" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">درجه شفافیت واترمارک کوچک</label>
                    <input type="number" min="0" max="100" name="small_opacity" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">درصد فاصله واترمارک پس زمینه از اطراف</label>
                    <input type="number" min="0" max="100" name="stamp_percentage" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">درجه چرخش واترمارک پس زمینه </label>
                    <input type="number" min="0" max="360" name="stamp_degree" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">درصد فاصله افقی واترمارک کوچک</label>
                    <input type="number" min="0" max="100" name="horizontal_distance" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">درصد فاصله عمودی واترمارک کوچک</label>
                    <input type="number" min="0" max="100" name="vertical_distance" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">درصد اندازه واترمارک کوچک</label>
                    <input type="number" min="0" max="100" name="small_stamp_percentage" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="">مکان واترمارک کوچک</label>
                    <select name="position" class="form-control" style="padding: 0 10px">
                        <option value="none">انتخاب کنید ...</option>
                        <option value="top-left">بالا - چپ</option>
                        <option value="top-right">بالا - راست</option>
                        <option value="bottom-left">پایین - چپ</option>
                        <option value="bottom-right">پایین - راست</option>
                    </select>
                </div>

                <div class="col-md-12" style="margin-top: 10px">
                    <input type="submit" value="ثبت نهایی" name="submit" class="btn btn-success"/>
                </div>
            </form>
        </div>
    </div>
<?php
include "view/footer.php";
?>