<!doctype html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<title></title>
    <style>
        body
        {
            font-size: 9pt;
        }
        div.simple-gallery
        {
            position: relative;
            border: 1px solid #000;
            height: 600px;
        }
        div.simple-gallery img
        {
            position: absolute;
            left: 0;
            top: 0;
            width: 120px;
        }
    </style>
</head>
<body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<p>gallery1</p>
<div class="simple-gallery" id="gallery1">
    <img src="<?=base_url();?>/assets/images/banners/1.png">
    <img src="<?=base_url();?>/assets/images/banners/2.png">
    <img src="<?=base_url();?>/assets/images/banners/3.png">
    <img src="<?=base_url();?>/assets/images/banners/4.png">
    <img src="<?=base_url();?>/assets/images/banners/5.png">
    <img src="<?=base_url();?>/assets/images/banners/6.png">
    <img src="<?=base_url();?>/assets/images/banners/7.png">
    <img src="<?=base_url();?>/assets/images/banners/8.png">
</div>

<p>gallery2</p>
<div class="simple-gallery" id="gallery2">
    <img src="<?=base_url();?>/assets/images/banners/1.png">
    <img src="<?=base_url();?>/assets/images/banners/2.png">
    <img src="<?=base_url();?>/assets/images/banners/3.png">
    <img src="<?=base_url();?>/assets/images/banners/4.png">
    <img src="<?=base_url();?>/assets/images/banners/5.png">
    <img src="<?=base_url();?>/assets/images/banners/6.png">
    <img src="<?=base_url();?>/assets/images/banners/7.png">
    <img src="<?=base_url();?>/assets/images/banners/8.png">
</div>

<script>
    // 플러그인 생성
    (function($){
        /**
         *
         * @param selector  이미지 목록을 나타내는 css 선택자
         * @param count     가로로 출력할 이미지 개수
         * @param width     출력할 이미지 영역 너비
         * @param height    출력할 이미지 영역 높이
         * @constructor
         */
        function SimpleGallery(selector, count, width, height)
        {
            // 프로퍼티 생성
            this.$images = null;
            this.count = count;
            this.imageWidth = width;
            this.imageHeight = height;

            this.init(selector);
        }
        // 요소 초기화
        SimpleGallery.prototype.init=function(selector)
        {
            this.$images = $(selector);
        }
        // 이미지 출력 메소드 추가
        SimpleGallery.prototype.showGallery=function()
        {
            // 이미지 개수 구하기
            var length = this.$images.length;

            // 이미지 배열하기
            for(var i=0; i < length; i++)
            {
                // n번째 이미지 구하기
                var $img = this.$images.eq(i);

                // 위치 값 구하기
                var x = 100 + ((i % this.count) * this.imageWidth);
                var y = 100 + (parseInt(i/this.count) * this.imageHeight);

                console.log(x, y);


                // 위치 설정
                $img.css({
                    left: x,
                    top: y
                });
            }
        }
        // 기본 이미지 출력 옵션값
        $.simpleGalleryDefOptions = {
            count: 5,
            imageWidth: 200,
            imageHeight: 200
        }
        // 플러그인 생성
        $.fn.simpleGallery=function(optionList)
        {
            this.each(function(index){
                // 기본 옵션값과 사용자 옵션값을 합치기
                var options = $.extend(null, $.simpleGalleryDefOptions, optionList[index]);
                // 객체 생성
                var gallery = new SimpleGallery($(this).children("img"),
                    options.count, options.imageWidth, options.imageHeight);
                // 이미지 출력
                gallery.showGallery();
            })
        }
    })(jQuery);

    $(document).ready(function(){
        $(".simple-gallery").simpleGallery([
            {
                count: 6,
                imageWidth: 150,
                imageHeight: 150
            },
            {
                count: 4,
                imageWidth: 200,
                imageHeight: 200
            }
        ])
    });
</script>
</body>
</html>

