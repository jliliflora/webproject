<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>

<!DOCTYPE html>
<html lang="ko">
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
<?php
    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
?>
        <h2 class="ir_so">컨텐츠 영역</h2>
        <section class="join-type gray">
            <div class="member-form">
                <h3>회원 정보</h3>
                
                <form action="mypageModifySave.php" name="join" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="ir_so">회원정보 입력폼</legend>

                        <div class="join-intro">
<?php 

$memberID = $_SESSION['memberID'];

// echo $memberID;

$sql = "SELECT * FROM myMember WHERE memberID = {$memberID}";
$result = $connect -> query($sql);

// echo "<pre>";
// var_dump($result);
// echo "</pre>";

if($result) {
    $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

    echo "<div class='face' style='background-image: url(../assets/img/mypage/{$memberInfo['youImgFile']}); background-size: cover;'></div>";
    echo "<div class='modify'>";
    echo "<label for='youFile' style='display:block; margin-top: 15px; margin-bottom: 15px;'>사진수정</label>";
    echo "<input type='file' name='youFile' id='youFile' value='' style='width: 190px;'>";

    echo "<label for='youIntro' style='display:block; margin-top: 30px;'>자기소개</label>";
    echo "<input type='text' id='youIntro' name='youIntro' value='".$memberInfo['youIntro']."' autocomplete='off'>";
    echo "</div>";
}
?>
                            <!-- <div class="face">
                                <img src="http://ohwehoh.dothome.co.kr/php/assets/img/mypage/default.svg" alt="기본이미지">
                            </div> -->

                            <!-- <div class="modify">
                                <label for="youPhoto" style="display:block; margin-top: 20px; margin-bottom: 10px;">사진수정</label>
                                <input type="file" name="youPhoto" id="youPhoto">
                                
                                <label for="youIntro" style="display:block; margin-top: 30px;">자기소개</label>
                                <input type="text" id="youIntro" name="youIntro" value='' autocomplete="off">
                            </div> -->
                        </div>


                        <div class="join-box">
<?php
    $memberID = $_SESSION['memberID'];

    // echo $memberID;

    $sql = "SELECT * FROM myMember WHERE memberID = {$memberID}";
    $result = $connect -> query($sql);

    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";

    if($result) {
        $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);


        echo "<div style='display:none;' class='modify'>
        <label for='memberID'>번호</label>
        <input type='text' name='memberID' id='memberID' value='".$memberInfo['memberID']."'>
        </div>";
        echo "<div class='modify'>
        <label for='youEmail'>이메일</label>
        <input type='email' name='youEmail' id='youmail' value='".$memberInfo['youEmail']."' autocomplete='off'>
        </div>";
        echo "<div class='modify'>
        <label for='youName'>이름</label>
        <input type='text' name='youName' id='youName' value='".$memberInfo['youName']."' maxlength='5' autocomplete='off' required>
        </div>";
        echo "<div class='modify'>
        <label for='youBirth'>생년월일</label>
        <input type='text' name='youBirth' id='youBirth' value='".$memberInfo['youBirth']."' maxlength='12' autocomplete='off' >
        </div>";
        echo "<div class='modify'>
        <label for='youBirth'>휴대폰 번호</label>
        <input type='text' name='youPhone' id='youPhone' value='".$memberInfo['youPhone']."' maxlength='15' autocomplete='off'>
        </div>";
    
        echo "<div class='modify'>
        <label for='youPass'>회원정보 수정 확인</label>
        <input type='password' name='youPass' id='youPass value='".$memberInfo['youPass']."' placeholder='기존 로그인 비밀번호를 입력해주세요!!' maxlength='15'>
        </div>";
    }

?>
                            <!--<div class="modify">
                                <label for="youEmail">이메일</label>
                                <input type="email" id="youEmail" name="youEmail" value='aaa@naver.com' autocomplete="off">
                            </div>
                            <div class="modify">
                                <label for="youName">이름</label>
                                <input type="text" id="youName" name="youName" value='방문자' maxlength="5" autocomplete="off">
                            </div>
                            <div class="modify">
                                <label for="youBirth">생년월일</label>
                                <input type="text" id="youBirth" name="youBirth" value='1999-01-01' maxlength="12" autocomplete="off">
                            </div>
                            <div class="modify">
                                <label for="youPhone">휴대폰 번호</label>
                                <input type="text" id="youPhone" name="youPhone" value='010-0000-0000' maxlength="15" autocomplete="off">
                            </div>
                            <div>
                                <label for="youPass">비밀번호 입력</label>
                                <input type="password" id="youPass" name="youPass" placeholder="로그인 비밀번호를 입력해주세요!" maxlength="15" autocomplete="off">
                            </div>-->
                        </div>
                        <button id="joinBtn" class="join-submit" type="submit">회원정보 수정</button>
                    </fieldset>
                </form>
            </div>
        </section>
    </main>
    <!-- //main -->


    <?php include "../include/footer.php"; ?>
</body>
</html>