<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인</title>

    <?php include "../include/style.php"; ?>
</head>
<body>
    <?php include "../include/skip.php"; ?>
    <?php include "../include/header.php"; ?>

    <main id="contents">
        <h2 class="ir_so">컨텐츠 영역</h2>
<?php
    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
?>      

        <section id="blog-type" class="section center type">
            <div class="container">
                <h3 class="section__title">코딩 블로그</h3>
                <p class="section__desc">코딩에 관련된 블로그입니다. 다양한 정보를 확인하세요!</p>
                <div class="blog__inner">
                    <div class="blog__cont">

<?php
    if(isset($_GET['page'])){
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    $numView = 3;
    $viewLimit = ($numView * $page) - $numView;

    //1~20 : DESC (맨 마지막이 위로 올라오는 정렬) LIMIT 0, 20 ---> page = 1 ($numView * page) - $numView
    //21~40 : DESC LIMIT 20, 20 ---> page = 2 ($numView * page) - $numView
    //41~60 : DESC LIMIT 40, 20 ---> page = 3 ($numView * page) - $numView
    //61~80 : DESC LIMIT 60, 20 ---> page = 4 ($numView * page) - $numView


    $sql = "SELECT b.blogID, b.blogCategory, b.blogTitle, b.blogContents, b.blogAuthor, m.youName, b.blogRegTime, b.blogView, b.blogLike, b.blogImgFile FROM myBlog b JOIN myMember m ON(b.memberID = m.memberID) ORDER BY blogID DESC LIMIT {$viewLimit}, {$numView}";
    $result = $connect -> query($sql);

    //  echo "<pre>";
    //  var_dump($result);
    //  echo "</pre>";

    if($result){
        $count = $result -> num_rows;

        if($count > 0){
            for($i=1; $i<=$count; $i++){
                $blogInfo = $result -> fetch_array(MYSQLI_ASSOC);
                echo "<article class='blog'>";
                echo "<figure class='blog__header' aria-hidden='true'>";
                echo "<a href='../blog/blogView.php?blogID={$blogInfo['blogID']}' style='background-image: url(../assets/img/blog/{$blogInfo['blogImgFile']}); background-size: cover;'></a>";
                echo "</figure>";

                echo "<div class='blog__body'>";
                echo "<span class='blog__cate'>".$blogInfo['blogCategory']."</span>";
                echo "<a href='../blog/blogView.php?blogID={$blogInfo['blogID']}'>";
                echo "<div class='blog__title'>".$blogInfo['blogTitle']."</div>";
                echo "</a>";

                echo "<div class='blog__desc'>".$blogInfo['blogContents']."</div>";

                echo "<div class='blog__info'>";
                echo "<span class='author'>".$blogInfo['youName']."&nbsp;</span>";
                echo "<span class='date'>".date('Y-m-d', $blogInfo['blogRegTime'])."</span>";
                echo "<div class='blog__att'>";
                echo "<span class='view'>VIEW : ".$blogInfo['blogView']."&nbsp;</span>";
                echo "<span class='like'>LIKE : ".$blogInfo['blogLike']."</span>";
                echo "</div>";
                echo "</div>";

                echo "</div>";
                echo "</article>";
            }
        }
    }
?>

                                <!-- <article class="blog">
                                    <figure class="blog__header" aria-hidden="true">
                                        <a href="../blog/blogView.php?blogID=37" style="background-image: url(../assets/img/blog/Img_165022195037847.jpeg);"></a>
                                    </figure>
                                    <div class="blog__body">
                                        <span class="blog__cate">info</span>
                                        <a href="../blog/blogView.php?blogID=37">
                                            <div class="blog__title">
                                                식생활                                            
                                            </div>
                                        </a>
                                        <div class="blog__desc">
                                            *문화와 종교<br />
                                            식사 습관은 어떤 음식을 먹어야할지에 대해 사람이나 문화에서 형성한 습관적인 결정을 말한다. 인간은 동물성과 식물성 음식을 모두 먹을 수 있는 잡식성 동물이지만, 많은 문화권에서는 특정 음식을 선호하거나 금지한다. 선택적인 식사를 통해서 그 문화와 종교가 수행하는 역할을 규정할 수 있다. 그 예로는 유대교의 식사 계율에 따른 카슈루트 음식과 이슬람교의 할랄을 들 수 있으며, 각 종교의 신자들은 정해진 음식에 따라 식사를 한다. 더불어, 식품의 선택은 국가와 종교마다 각자 다른 특징을 가지고 있으며, 이는 각 문화권의 요리와 밀접한 관련이 있다.<br />
                                            <br />
                                            <br />
                                            *식사 불균형<br />
                                            식사 습관은 모든 인간의 건강과 수명에 중요한 역할을 한다. 음식 섭취와 에너지 소비 사이의 불균형이 계속해서 이어지면 기아 상태, 또는 지방질의 과도한 축적으로 비만 상태에 도달하게 된다. 다양한 비타민과 무기질을 충분히 섭취하지 못하면 건강에 큰 영향을 끼칠 수 있는 질병에 걸리게 된다. 가령, 세계 인구의 약 30%는 요오드 결핍증에 걸렸거나 걸릴 수 있을 정도로 요오드가 부족한 상태이다. 또한, 최소한 3백만 명의 어린이가 비타민 A 결핍으로 시력을 잃었다.[62] 비타민 C가 부족하면 괴혈병을 일으킨다. 칼슘, 비타민 D, 인은 서로 관련이 있으며, 비타민 D를 섭취하면 나머지 영양소의 흡수를 돕는 효과가 나타난다. 콰시오커와 소모증은 유년기에 일어나는 질병으로, 단백질 섭취의 부족으로 인해서 걸린다.<br />
                                            <br />
                                            *도덕과 윤리, 건강 의식<br />
                                            음식의 선택은 개인의 도덕적 신념이나 습관으로 제한되기도 한다. 대표적으로 채식주의자는 특정한 동물성 음식이나 모든 동물성 음식을 피한다. 건강을 고려하는 사람은 설탕이나 동물성 지방을 피하고 섬유질과 산화 방지제가 함유된 음식을 섭취한다. 서구권 국가에서 심각한 문제인 비만은 심장병과 당뇨병을 비롯한 여러 성인병의 발병률을 높인다. 최근에 와서는 유전자 변형 식품이 잠재적으로 인간의 건강과 환경에 영향을 끼칠 수 있다는 염려가 식습관 선택에 영향을 주기도 하며, 더 나아가서 기업형 농업 (곡물)이 동물 복지, 인간의 건강과 환경에 위험할 수 있다는 주장 또한 식습관을 선택하는 데 고려가 되고 있다. 이러한 문제로 인해 유기농 음식과 지역 음식을 선호하는 대항 문화도 출현하게 되었다.<br />
                                            <br />
                                            출처 : https://ko.wikipedia.org/wiki/%EC%9D%8C%EC%8B%9D
                                        </div>

                                        <div class="blog__info">
                                            <span class="author">이라라</span>
                                            <span class="date">2022-04-14</span>
                                            <div class="blog__att">
                                                <span class="view">VIEW : 44</span>
                                                <span class="like">LIKE : 1</span>
                                            </div>
                                        </div>
                                    </div>
                                </article> -->             
                    </div>
                </div>
            </div>
        </section>
        <!-- //blog-type -->





        <section id="notice-type" class="section center">
            <div class="container">
                <h3 class="section__title">강의 게시판</h3>
                <p class="section__desc">강의와 관련된 게시판입니다. 다양한 정보를 확인하세요!</p>
                <div class="notice__inner">
                    <article class="notice">
                        <h4>공지사항</h4>
                        <ul>

<?php
    if(isset($_GET['page'])){
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    $numView = 4;
    $viewLimit = ($numView * $page) - $numView;

    //1~20 : DESC (맨 마지막이 위로 올라오는 정렬) LIMIT 0, 20 ---> page = 1 ($numView * page) - $numView
    //21~40 : DESC LIMIT 20, 20 ---> page = 2 ($numView * page) - $numView
    //41~60 : DESC LIMIT 40, 20 ---> page = 3 ($numView * page) - $numView
    //61~80 : DESC LIMIT 60, 20 ---> page = 4 ($numView * page) - $numView


    $sql = "SELECT b.boardID, b.boardTitle, m.youName, b.regTime, b.boardView FROM myBoard b JOIN myMember m ON(b.memberID = m.memberID) ORDER BY boardID DESC LIMIT {$viewLimit}, {$numView}";
    $result = $connect -> query($sql);

    //  echo "<pre>";
    //  var_dump($result);
    //  echo "</pre>";

    if($result){
        $count = $result -> num_rows;

        if($count > 0){
            for($i=1; $i<=$count; $i++){
                $boardInfo = $result -> fetch_array(MYSQLI_ASSOC);
                echo "<li>";
                echo "<a style='display:none;'>".$boardInfo['boardID']."</a>";
                echo "<a href='../board/boardView.php?boardID={$boardInfo['boardID']}'>".$boardInfo['boardTitle']."</a></td>";
                echo "<span class='time'>".date('Y-m-d', $boardInfo['regTime'])."</span>";
                // echo "<td>".$boardInfo['boardView']."</td>";
                echo "</li> ";
            }
        }
    }
?>
                                <!--<li>
                                    <a href="../board/boardView.php?boardID=302">
                                        검색제목                                    
                                    </a>
                                    <span class="time">
                                        2022-03-24                                   
                                     </span>
                                </li>
                                <li>
                                    <a href="../board/boardView.php?boardID=301">
                                        검색 결과가 없을 때 다음/마지막 페이지 안뜨게 어떻게 하지
                                    </a>
                                    <span class="time">
                                        2022-03-24 
                                    </span>
                                </li>
                                <li>
                                    <a href="../board/boardView.php?boardID=300">
                                        게시판 타이틀300입니다.
                                    </a>
                                    <span class="time">
                                        2022-03-24
                                    </span>
                                </li>
                                                        <li>
                                    <a href="../board/boardView.php?boardID=299">
                                        게시판 타이틀299입니다.
                                    </a>
                                    <span class="time">
                                        2022-03-24
                                    </span>
                                </li>-->
                                                </ul>
                        <a href="../board/board.php" class="more">더보기</a>
                    </article>
                    <article class="notice">
                        <h4>댓글</h4>
                            <ul>

<?php
    if(isset($_GET['page'])){
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    $numView = 4;
    $viewLimit = ($numView * $page) - $numView;

    //1~20 : DESC (맨 마지막이 위로 올라오는 정렬) LIMIT 0, 20 ---> page = 1 ($numView * page) - $numView
    //21~40 : DESC LIMIT 20, 20 ---> page = 2 ($numView * page) - $numView
    //41~60 : DESC LIMIT 40, 20 ---> page = 3 ($numView * page) - $numView
    //61~80 : DESC LIMIT 60, 20 ---> page = 4 ($numView * page) - $numView


    // $sql = "SELECT * FROM myComment ORDER BY commentID DESC LIMIT {$viewLimit}, {$numView}";
    $sql = "SELECT * FROM myComment ORDER BY commentID DESC LIMIT {$viewLimit}, {$numView}";
    $result = $connect -> query($sql);

    //  echo "<pre>";
    //  var_dump($result);
    //  echo "</pre>";

    if($result){
        $count = $result -> num_rows;

        if($count > 0){
            for($i=1; $i<=$count; $i++){
                $commentInfo = $result -> fetch_array(MYSQLI_ASSOC);
                echo "<li>";
                echo "<a style='display:none;'>".$commentInfo['commentID']."</a>";
                echo "<a href='../comment/comment.php'>".$commentInfo['youText']."</a></td>";
                echo "<span class='time'>".date('Y-m-d', $commentInfo['regTime'])."</span>";
                echo "</li> ";
            }
        }
    }
?>




                                                        <!--<li>
                                                            <a href="../comment/comment.php">맛집 괜찮은데좀 알려주세요 왜냐면</a>
                                                            <span class="time">2022-03-31</span>
                                                         </li>
                                                        <li>
                                                            <a href="../comment/comment.php">시리얼 맛있나요 궁금해요</a>
                                                            <span class="time">2022-03-30</span>
                                                        </li>
                                                        <li>
                                                            <a href="../comment/comment.php">해외시리얼 두 개 산걸 왜 여기다 말하죠?</a>
                                                            <span class="time">2022-03-30</span>
                                                        </li>
                                                         <li>
                                                            <a href="../comment/comment.php">샌드위치가 나을까 밥이 나을까 고민중</a>
                                                            <span class="time">2022-03-30</span>
                                                        </li>-->
                                                        </ul>
                        <a href="../comment/comment.php" class="more">더보기</a>
                    </article>
                </div>
            </div>
        </section>
        <!— //notice-type —>
    </main>

    <?php include "../include/footer.php"; ?>
</body>
</html>



