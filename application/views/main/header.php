<html>
<head>
    <title>심플 게시판</title>
</head>
<?php
/**
 * uri 첫번째 세그먼트값을 기준으로 상단 메뉴 위치 구별
 */
    $uri = $this->uri->segment(1);
    $boardArr = array('board', 'other');
    $confArr = array('conf');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<meta name="language" content="ko" />
<body>
<div class="header">
    <span class="nav-menu">
        <a href="<?=site_url();?>board" <?php if(in_array($uri, $boardArr)) { echo 'class=menuOn'; } ?>>
            <span>게시판</span>
        </a>
        <a href="#" <?php if(in_array($uri, $confArr)) { echo 'class=menuOn'; } ?>>
            <span>환경설정</span>
        </a>
    </span>

</div>
</body>
</html>
