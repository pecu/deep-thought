<?php
# 檢查檔案是否上傳成功
include "../config.php";
if ($_FILES['course_upload']['error'] === UPLOAD_ERR_OK){
  echo '檔案名稱: ' . $_FILES['course_upload']['name'] . '<br/>';
  echo '檔案類型: ' . $_FILES['course_upload']['type'] . '<br/>';
  echo '檔案大小: ' . ($_FILES['course_upload']['size'] / 1024) . ' KB<br/>';
  echo '暫存名稱: ' . $_FILES['course_upload']['tmp_name'] . '<br/>';

  # 檢查檔案是否已經存在
  if (file_exists('upload/' . $_FILES['course_upload']['name'])){
    echo '檔案已存在。<br/>';
  } else {
    $file = $_FILES['course_upload']['tmp_name'];
    $dest = 'upload/' . $_FILES['course_upload']['name'];

    # 將檔案移至指定位置
    move_uploaded_file($file, $dest);
  }
} else {
  echo '錯誤代碼：' . $_FILES['course_upload']['error'] . '<br/>';
}

$connect = mysqli_connect($servername, $username, $password, $db_select);
$action="";
if($connect)
{
    echo '<br> Connected! <br>';
}
?>
<?php
$row = 1;
$handle = fopen($_FILES['course_upload']['tmp_name'],"r");
while ($data = fgetcsv($handle, 1000, ",")) {
    $num = count($data);
    echo "<p> $num fields in line $row: <br>\n";
    $row++;
    $tmp_array = array();
    for ($c=0; $c < $num; $c++) {
        echo $data[$c] . "<br>\n";
        array_push($tmp_array, $data[$c]);
    }
    if($row >2)
    {
        $action = "INSERT INTO `Pass_List` (`id`, `className`, `studentName`, `studentId`, `teachers`, `assistants`, `ipfsIndex`) VALUES ('$tmp_array[0]', '$tmp_array[1]', '$tmp_array[2]', '$tmp_array[3]', '$tmp_array[4]', '$tmp_array[5]', '$tmp_array[6]')";
        if (mysqli_query($connect, $action)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $action . "" . mysqli_error($connect);
        }
    }
    unset($tmp_array);
}
fclose($handle);
?>