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
                <h3 class="section__title">검색 결과 블로그</h3>
                <p class="section__desc">코딩에 관련된 검색 결과입니다.</p>
                <div class="blog__inner">
                    <div class="blog__search">
<?php

    function msg($alert){
        echo "<p>총 " .$alert. " 건이 검색되었습니다. </p>";
    }

    $blogSearch = $_GET['blogSearch'];

    $blogSearch = $connect -> real_escape_string(trim($blogSearch));

    // echo $blogSearch;

    $sql = "SELECT b.blogID, b.blogCategory, b.blogTitle, b.blogContents, m.youName, b.blogRegTime, b.blogView, b.blogLike, b.blogImgFile FROM myBlog b JOIN myMember m ON(b.memberID = m.memberID) WHERE b.blogTitle LIKE '%{$blogSearch}%' ORDER BY blogID";

    $total = $connect -> query($sql);

    //  echo "<pre>";
    //  var_dump($total);
    //  echo "</pre>";

    if($total){
        $count = $total -> num_rows;

        msg($count);
    }


?>
                        <!-- <form action="blogSearch.php" method="get">
                            <fieldset>
                                <legend class="ir_so">검색 영역</legend>
                                <input type="search" name="blogSearch" id="blogSearch" class="search" placeholder="검색어를 입력해주세요!">
                                <label for="blogSearch" class="ir_so">검색</label>
                                <button type="submit" class="button">검색버튼</button>
                            </fieldset>
                        </form> -->
                    </div>
                    <div class="blog__btn">
                        <a href="blogWrite.php">글쓰기</a>
                    </div>
                        <div class="blog__cont">


<?php
    if(isset($_GET['page'])){
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    $numView = 5;
    $viewLimit = ($numView * $page) - $numView;


    $sql2 = "SELECT b.blogID, b.blogCategory, b.blogTitle, b.blogContents, m.youName, b.blogRegTime, b.blogView, b.blogLike, b.blogImgFile FROM myBlog b JOIN myMember m ON(b.memberID = m.memberID) WHERE b.blogTitle LIKE '%{$blogSearch}%' ORDER BY blogID DESC LIMIT {$viewLimit}, {$numView}";
    $result = $connect -> query($sql2);

    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";

    if($result){
        $count = $result -> num_rows;
        if($count > 0){
            for($i=1; $i<=$count; $i++){
                $blogInfo = $result -> fetch_array(MYSQLI_ASSOC);
                echo "<article class='blog'>";
                echo "<figure class='blog__header' aria-hidden='true'><a href='blogView.php?blogID={$blogInfo['blogID']}' style='background-image: url(../assets/img/blog/{$blogInfo['blogImgFile']}); background-size: cover;'></a></figure>";
                echo "<div class='blog__body'>";
                echo "<span class='blog__cate' style='display:none;'>".$blogInfo['blogID']."</span>";
                echo "<span class='blog__cate'>".$blogInfo['blogCategory']."</span>";
                echo "<a href='blogView.php?blogID={$blogInfo['blogID']}'>";
                echo "<div class='blog__title'>".$blogInfo['blogTitle']."</div>";
                echo "<div class='blog__att'>";
                echo "<span class='view'>VIEW : ".$blogInfo['blogView']." </span>";
                echo "<span class='view'>LIKE : ".$blogInfo['blogLike']."</span>";
                echo "</div>";
                echo "</a>";
                echo "<div class='blog__desc'>".$blogInfo['blogContents']."</div>";
                echo "<div class='blog__info'>";
                echo "<span class='author'>".$blogInfo['youName']." </span>";
                echo "<span class='date'>".date('Y-m-d', $blogInfo['blogRegTime'])."</span>";
                echo "<span class='modify'><a href='blogModify.php?blogID={$blogInfo['blogID']}'>수정</a></span>";
                echo "<span class='delete'><a href='blogRemove.php?blogID={$blogInfo['blogID']}'>삭제</a></span>";
                echo "</div>";
                echo "</div>";
                echo "</article>";
            }
        } else {
            echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
        }
    }
?>





                                <!--<article class="blog">
                                    <figure class="blog__header" aria-hidden="true">
                                        <a href="blogView.php?blogID=38" style="background-image: url(../assets/img/blog/Img_16499250398634.jpeg);"></a>
                                    </figure>
                                    <div class="blog__body">
                                        <span class="blog__cate">info</span>
                                        <a href="blogView.php?blogID=38">
                                            <div class="blog__title">
                                                음식과 영양
                                            </div>
                                            <div class="blog__att">
                                                <span class="view">VIEW : 63</span>
                                                <span class="like">LIKE : 0</span>
                                            </div>
                                        </a>
                                        <div class="blog__desc">
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
                                        </div>
                                        <div class="blog__info">
                                            <span class="author">이라라</span>
                                            <span class="date">2022-04-14</span>
                                            <span class="modify"><a href="blogModify.php?blogID=38">수정</a></span>
                                            <span class="delete"><a href="blogRemove.php?blogID=38">삭제</a></span>
                                        </div>
                                    </div>
                                </article>-->
                                                   
                    
                    </div>
                    
                    <div class="blog__pages">
                        <ul>

<?php

    // $sql3 = "SELECT b.blogID, b.blogTitle, b.blogView, m.youName, b.blogRegTime FROM myBlog b JOIN myMember m ON (m.memberID = b.memberID) WHERE b.blogTitle LIKE '%{$blogSearch}%' ORDER BY blogID";
    $result = $connect -> query($sql);

    //  echo "<pre>";
    //  var_dump($result);
    //  echo "</pre>";

    $blogTotalCount = $result -> num_rows;
    // echo $blogTotalCount;

    //총 페이지 수
    $blogTotalPage = ceil($blogTotalCount/$numView);

    // echo $blogTotalPage; //디버깅해서 이렇게 확인해주는거!!! 중간에 오류나면 꼭 해봐잉

    // 1 2 3 4 5 6 7 8 9
    //페이지 보여주는 갯수
    $pageView = 5;
    $startPage = $page - $pageView; 
    $endPage = $page + $pageView;

    //처음페이지 초기화 작업
    if($startPage < 1) $startPage = 1;
    //마지막페이지 초기화 작업
    if($endPage >= $blogTotalPage) $endPage = $blogTotalPage;

    //처음으로 버튼
    if($page != 1) {
        echo "<li><a href='blogSearch.php?page=1'>&lt;&lt;</a></li>";
    }

    //이전으로
    if($page != 1) {
        $prevPage = $page - 1;
        echo "<li><a href='blogSearch.php?blogSearch={$blogSearch}?page={$prevPage}'>&lt;</a></li>";
    }

    //페이징
    for($i=$startPage; $i<=$endPage; $i++) {
        $active = "";
        if($i == $page) $active = "active";

        echo "<li class='{$active}'><a href='blogSearch.php?page={$i}&blogSearch={$blogSearch}'>{$i}</a></li>";
    }


    //다음으로
    if($page != $endPage) {
        $nextPage = $page + 1;
        echo "<li><a href='blogSearch.php?page={$i}&blogSearch={$blogSearch}'>&gt;</a></li>";
    }


    //마지막으로
    if($page != $endPage) {
        echo "<li><a href='blogSearch.php?page={$blogTotalPage}'>&gt;&gt;</a></li>";
    }

?>





                        <!--<li class='active'><a href='blog.php?page=1'>1</a></li><li class=''><a href='blog.php?page=2'>2</a></li><li class=''><a href='blog.php?page=3'>3</a></li><li class=''><a href='blog.php?page=4'>4</a></li><li><a href='blog.php?page=2'>&gt;</a></li><li><a href='blog.php?page=4'>&gt;&gt;</a></li>                            <!-- <li><a href="">&lt;&lt;</a></li>
                            <li><a href="">&lt;</a></li>
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href="">5</a></li>
                            <li><a href="">6</a></li>
                            <li><a href="">&gt;</a></li>
                            <li><a href="">&gt;&gt;</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <?php include "../include/footer.php"; ?>
</body>
</html>