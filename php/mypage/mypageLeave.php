<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>

    <?php include "../include/style.php"; ?>
</head>
<body>

    <?php include "../include/skip.php"; ?>
    <?php include "../include/header.php"; ?>

    <main id="contents">
        <h2 class="ir_so">컨텐츠 영역</h2>
        <section class="join-type gray">
            
<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    function msg($alert){
        echo "<p class='alert'>{$alert}</p>";
    }

    $memberID = $_SESSION['memberID'];
    $memberID = $connect -> real_escape_string($memberID);

    $sql = "DELETE FROM myMember WHERE memberID = {$memberID}";
    $connect -> query($sql);

    $result = $connect -> query($sql);

    // echo "<pre>";
    // var_dump($result);
    // echo "<pre>";

    if($result){
        msg("회원 탈퇴가 처리되었습니다. 그 동안 이용해주셔서 감사합니다!");
    } else {
        msg("에러발생03 : 관리자에게 문의하세요!!");
    }

    unset($_SESSION['memberID']);
    unset($_SESSION['youEmail']);
    unset($_SESSION['youName']);

?>
                
        </section>
    </main>
    <!— //main —>

    <?php include "../include/footer.php"; ?>
</body>
</html>