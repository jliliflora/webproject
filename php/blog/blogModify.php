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
        <h2 class="ir_so">컨텐츠 영역</h2>
        <section id="blog-type" class="section center">
            <div class="container">
                <h3 class="section__title">게시글 작성하기</h3>
                <p class="section__desc">음식에 관련된 블로그입니다. 게시글을 작성해주세요!!</p>
                <div class="blog__inner">
                    <div class="blog__write">
                        <form action="blogModifySave.php" name="blogWrite" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <legend class="ir_so">블로그 게시글 수정 영역</legend>


<?php
    $blogID = $_GET['blogID'];

    // echo $blogID;

    $sql = "SELECT * FROM myBlog WHERE blogID = {$blogID}";
    $result = $connect -> query($sql);

    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";

    if($result){
        $blogInfo = $result -> fetch_array(MYSQLI_ASSOC);

        echo "<div style='display:none;'>";
        echo "<label for='blogID'>번호</label>";
        echo "<input type='text' name='blogID' id='blogID' value='".$blogInfo['blogID']."'>";
        echo "</div>";

        echo "<div>";
        echo "<label for='blogCate'>카테고리</label>";
        echo "<select name='blogCate' id='blogCate' value='".$blogInfo['blogCategory']."'>";
        echo "<option value='javascript'>JAVASCRIPT</option>";
        echo "<option value='php'>PHP</option>";
        echo "<option value='react'>REACT</option>";
        echo "<option value='vue'>VUE</option>";
        echo "<option value='codingtest'>CODING TEST</option>";
        echo "</select>";
        echo "</div>";

        echo "<div>";
        echo "<label for='blogTitle'>제목</label>";
        echo "<input type='text' name='blogTitle' id='blogTitle' value='".$blogInfo['blogTitle']."'>";
        echo "</div>";

        echo "<div>";
        echo "<label for='blogContents'>내용</label>";
        echo "<textarea name='blogContents' id='blogContents'>".$blogInfo['blogContents']."</textarea>";
        echo "</div>";

        echo "<div style='margin-bottom:40px;'>";
        echo "<label for='blogImg'>현재파일  : <span style='margin:5px;'>".$blogInfo['blogImgFile']."</span> </label>";
        echo "<img src='../assets/img/blog/{$blogInfo['blogImgFile']}' alt='현재이미지' style='margin-bottom:0px;' class='modifyImg'>";
        echo "</div>";

        echo "<div>";
        echo "<label for='blogFile'>파일바꾸기</label>";
        echo "<input type='file' name='blogFile' id='blogFile' placeholder='사진을 넣어주세요! 사진은 jpg, gif, png 파일만 지원이 됩니다.'>";
        echo "</div>";

        echo "<div>";
        echo "<label for='youPass'>비밀번호</label>";
        echo "<input type='password' name='youPass' id='youPass' placeholder='로그인 비밀번호를 입력해주세요!!' autocomplete='off' required>";
        echo "</div>";
    }
?>


                                <!-- <div>
                                    <label for="blogCate">카테고리</label>
                                    <select name="blogCate" id="blogCate">
                                        <option value="daily">일상</option>
                                        <option value="info">정보</option>
                                        <option value="news">소식</option>
                                        <option value="dish">요리</option>
                                    </select>
                                <div>
                                    <label for="blogTitle">제목</label>
                                    <input type="text" name="blogTitle" id="blogTitle" placeholder="제목을 넣어주세요" required>
                                </div> -->
                                <!-- <div>
                                    <label for="blogContents">내용</label>
                                    <textarea name="blogContents" id="blogContents" placeholder="내용을 넣어주세요!" required></textarea>
                                </div>
                                <div>
                                    <label for="blogFile">파일</label>-->
                                    <!-- <input type="file" name="blogFile" id="blogFile" accept=".jpg, jpeg, .png, .gif" placeholder="사진을 넣어주세요! 사진은 jpg, gif, png 파일만 지원이 됩니다."> -->
                                    <!-- <input type="file" name="blogFile" id="blogFile" placeholder="사진을 넣어주세요! 사진은 jpg, gif, png 파일만 지원이 됩니다.">
                                </div>
                                <button type="submit" value="저장하기">저장하기</button> -->

                                <div class="blog__btn">
                                        <button type="submit" value="수정하기">수정하기</button>
                                        <a href="blog.php">목록보기</a>
                                </div>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include "../include/footer.php"; ?>
</body>
</html>