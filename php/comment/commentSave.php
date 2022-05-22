<?php
    include "../connect/connect.php";

    $youName = $_POST['youName'];
    $youText = $_POST['youText'];
    $regTime = time();

    echo $youName, $youText, $regTime;

    $sql = "INSERT INTO myComment(youName, youText, regTime) VALUES('$youName', '$youText', '$regTime')";
    $result = $connect -> query($sql);

    if($result) {
        echo "INSERT INTO True";
    } else {
        echo "INSERT INTO False";
    }
?>
<script>
    location.href = "../comment/comment.php#comment-type"; // 작성하기 누르면 페이지가 리로딩되지 않고 바로 댓글이 추가되는 기능!!
</script>