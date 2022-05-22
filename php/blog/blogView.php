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
        <section id="blog-type" class="center">

<?php
    $blogID = $_GET['blogID'];

    //echo $blogID;

    $sql = "SELECT b.blogID, b.blogTitle, b.blogContents, m.youName, b.blogRegTime, b.blogView, b.blogLike, b.blogImgFile, b.blogModTime FROM myBlog b JOIN myMember m ON(b.memberID = m.memberID) WHERE b.blogID = {$blogID}";
    $result = $connect -> query($sql);

    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";

    $view = "UPDATE myBlog SET blogView = blogView + 1 WHERE blogID = {$blogID}";
    $connect -> query($view);

    if($result) {
        $blogInfo = $result -> fetch_array(MYSQLI_ASSOC);

        echo "<div class='blog__label' style='background-image: url(../assets/img/blog/{$blogInfo['blogImgFile']})'>";
        echo "<h3 class='section__title'>".$blogInfo['blogTitle']."</h3>";
        echo "<div>";
        echo "<span class='author'><a href='#'>".$blogInfo['youName']." </a></span>";
        echo "<span class='date'>".date('Y-m-d', $blogInfo['blogRegTime'])."</span><br><br>";
        echo "<span class='modify'><a href='blogModify.php?blogID={$blogInfo['blogID']}'>수정 </a></span>";
        echo "<span class='delete'><a href='blogRemove.php?blogID={$blogInfo['blogID']}' onclick=\"if(!confirm('정말 삭제하시겠습니까?')) {return false;}\">삭제</a></span>";
        echo "</div>";
        echo "<div class='modDateWrap'>";
        echo "<span class='modiDate'>(수정 : ".date('Y-m-d', $blogInfo['blogModTime']).")</span><br>";
        echo "</div>";
        echo "</div>";
    }
?>

            <!--<div class="blog__label" style="background-image: url(../assets/img/blog/Img_16499250398634.jpeg)">
                <h3 class="section__title">음식과 영양</h3>
                <div>
                    <span class="author"><a href="#">이라라</a></span>
                    <span class="date">2022-04-14</span><br><br>
                    <span class="modify"><a href="blogModify.php?blogID=38">수정</a></span>
                    <span class="delete"><a href="blogRemove.php?blogID=38">삭제</a></span>
                </div>
                                        <div class="modDateWrap">
                            <span class="modiDate">(수정 : 2022-04-14)</span><br>
                        </div>
                
            </div>-->

            <!--  -->
            <div class="container">
                <div class="blog__layout">

<?php
    //$sql = "SELECT b.blogTitle, b.blogContents, m.youName, b.blogRegTime, b.blogView, b.blogLike, b.blogImgFile FROM myBlog b JOIN myMember m ON(b.memberID = m.memberID) WHERE b.blogID = {$blogID}";
    $result = $connect -> query($sql);
    
    if($result) {
        $blogInfo = $result -> fetch_array(MYSQLI_ASSOC);

        echo "<div class='blog__left'>";
        echo "<h4>".$blogInfo['blogTitle']."</h4>";
        echo "<p>".$blogInfo['blogContents']."</p>";
        echo "<div class='like_area'>";
        echo "<button class='button'  onclick='blogLike()'>";
        echo "<div class='hand'><div class='thumb'></div></div>";
        echo "<span>Like<span>d</span></span>";
        echo "</button>";
        echo "<span id='like'>좋아요 : ".$blogInfo['blogLike']."</span>";
        echo "</div>";
        echo "</div>";
        echo "<div class='blog__right'>";
        echo "<div class='ad'><iframe src='https://ads-partners.coupang.com/widgets.html?id=581336&template=carousel&trackingCode=AF9078078&subId=&width=300&height=300' width='300' height='300' frameborder='0' scrolling='no' referrerpolicy='unsafe-url'></iframe></div>";
        echo "</div>";

        // echo "<div class='blog__label' style='background-image: url(../assets/img/blog/{$blogInfo['blogImgFile']})'>";
        // echo "<h3 class='section__title'>".$blogInfo['blogTitle']."</h3>";
        // echo "<div>";
        // echo "<span class='author'><a href='#'>".$blogInfo['youName']." </a></span>";
        // echo "<span class='date'>".date('Y-m-d', $blogInfo['blogRegTime'])."</span><br><br>";
        // echo "<span class='modify'><a href='blogModify.php?blogID={$blogInfo['blogID']}'>수정 </a></span>";
        // echo "<span class='delete'><a href='blogRemove.php?blogID={$blogInfo['blogID']}'>삭제</a></span>";
        // echo "</div>";
        // echo "<div class='modDateWrap'>";
        // echo "<span class='modiDate'>(수정 : ".date('Y-m-d', $blogInfo['blogModTime']).")</span><br>";
        // echo "</div>";
        // echo "</div>";
    }
?>

                    <!--<div class="blog__left">
                        <h4>음식과 영양</h4>
                        인간은 음식을 먹음으로써 활동과 성장에 필요한 영양소를 공급받는데, 인체가 필요로 하는 모든 영양소를 한꺼번에 공급해 줄 수 있는 음식은 없다. 좋은 영양 상태를 유지하려면 여러 영양소가 균형을 이룰 수 있도록 음식을 골고루 섭취하여야 한다.<br />
                        <br />
                        최적의 건강 상태와 기아, 영양 실조로 인한 사망 사이에서 드러나는 여러 질병은 식생활을 바꿈으로써 원인이나 완화가 될 수 있다. 식생활의 부족, 과잉, 불균형은 건강에 부정적인 영향을 줄 수 있으며, 심리적이고 행동적인 문제뿐만 아니라 괴혈병, 비만, 골다공증과 같은 질병을 유발하게 된다. 균형 있는 식사를 위해 각 영양소의 기능과 특성, 함유 식품 및 과부족증에 대해 알아두면 좋다. 영양 과학은 특정한 식습관이 건강에 어떻게 영향을 주며, 왜 그러한 영향을 주는지에 대해서 연구한다.<br />
                        <br />
                        음식에 포함된 영양소는 몇가지 범주로 그룹화된다. 다량 영양소는 지방, 단백질, 탄수화물을 뜻하며, 미량 영양소는 무기질과 비타민이다. 이밖에도 음식에는 물과 섬유질이 포함되어 있다.<br />
                        <br />
                        *법문 정의<br />
                        일부 국가에서는 음식에 법적인 정의를 내린다. 이러한 국가들은 음식을 ‘섭취하기 위해 가공한, 또는 부분적으로 가공하거나 가공하지 않은 모든 물건’으로 기록하고 있다. 이렇게 정의된 음식 목록에는 인간이 섭취할 수 있도록 만들어졌거나 가능성이 있는 어떠한 형태의 음식이라도 포함될 수 있다. 이외에도 음료, 껌, 물이나 다른 음식이라 부를 수 있는 물질 또한 음식의 법적인 정의의 일부분으로 되어 있다. 음식의 법적인 정의에 포함되지 않는 음식은 가축 사료, 팔기 위해 가공되지 않은 살아있는 동물, 수확하지 않은 식물, 의료 약품, 화장품, 담배, 마약, 잔류물과 오염물이 있다.<br />
                        <br />
                        출처 : https://ko.wikipedia.org/wiki/%EC%9D%8C%EC%8B%9D                                                
                        <div class="like_area">
                            <button class="button"  onclick="blogLike()">
                                <div class="hand">
                                    <div class="thumb"></div>
                                </div>
                                <span>Like<span>d</span></span>
                            </button>
                            <span id="like">좋아요 : 0</span>
                        </div>
                    </div>
                    <div class="blog__right">
                        <div class="ad">
                        <iframe src="https://ads-partners.coupang.com/widgets.html?id=572091&template=carousel&trackingCode=AF4445975&subId=&width=300&height=300" width="300" height="300" frameborder="0" scrolling="no" referrerpolicy="unsafe-url"></iframe>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
    </main>

    <?php include "../include/footer.php"; ?>
</body>
</html>