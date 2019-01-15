<!doctype html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/tabmenu.css">
</head>
<body>
<button id='myButton'>버튼</button>
<ul class="menu">
    <li>menu1</li>
    <li>menu2</li>
    <li>menu3</li>
    <li>menu4</li>
    <li>menu5</li>
</ul>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script>
    /**
     * 일반 함수에서의 this
     * @type {number}
     */
    var data = 10;

    function outer()
    {
        // this.data 는 window.data 와 같으므로 전역변수 data를 의미한다.
        // 따라서 전역 변수 data 에 20을 대입한다.
        this.data = 20;
        // 먼저 지역에서 data 변수를 찾고 없으면 상위에서 찾는다.
        // 결국 전역 변수 data에 30을 대입한다.
        data = 30;

        // 결과가 모두 같다.
        console.log("일반 함수에서의 this");
        console.log("1. data = " + data);
        console.log("2. this.data = " + this.data);
        console.log("3. window.data = " + window.data);
    }

    outer();

    var data = 10;
    function outer()
    {
        // 중첩함수 - 일반 함수에서의 this와 동일하다
        function inner()
        {
            this.data = 20;
            data = 30;

            console.log("중첩 함수에서의 this");
            console.log("1. data = " + data);
            console.log("2. this.data = " + this.data);
            console.log("3. window.data = " + window.data);
        }

        inner();
    }
    outer();

    var data = 10;
    $(document).ready(function(){
        // 이벤트 리스너 등록 - 이름없는 중첩함수
        $('#myButton').click(function(){
            // 이벤트 리스너에서 this는 이벤트를 발생시킨 객체가 되므로 myButton이 된다.
            this.data = 20;
            data = 30;

            console.log("이벤트 리스너에서의 this");
            console.log("1. data = " + data);
            console.log("2. this.data = " + this.data);
            console.log("3. window.data = " + window.data);
        });
    });

    var data = 10;
    function MyClass()
    {
        this.data = 0;
    }
    MyClass.prototype.method1 = function()
    {
        // 메서드에서 this 는 객체 자신이 저장된다.
        this.data = 20;
        data = 30;

        console.log("메소드에서의 this");
        console.log("1. data = " + data);
        console.log("2. this.data = " + this.data);
        console.log("3. window.data = " + window.data);
    }

    // 인스턴스 생성
    var my1 = new MyClass();
    my1.method1();

    var data = 10;
    function MyClass()
    {
        this.data = 0;
    }
    MyClass.prototype.method1 = function()
    {
        // 객체의 메소드 내부에서 만들어진 중첩함수에서의 this는 window가 된다.
        function inner()
        {
            this.data = 20;
            data = 30;

            console.log("메소드 내부의 중첩 함수에서의 this");
            console.log("1. data = " + data);
            console.log("2. this.data = " + this.data);
            console.log("3. window.data = " + window.data);
        }

        inner();
    }

    // 인스턴스 생성
    var my1 = new MyClass();
    my1.method1();

    // jQuery 유틸리티 만들기 - 클래스 메소드 이용
    (function($){
        $.addComma = function(value) {
            // 숫자를 문자로 형변화
            var data = value + "";
            // 문자를 배열로 만들기
            var arrayResult = data.split("");
            // 배열 요소를 뒤에서 3자리수마다 콤마 추가하기
            var startIndex = arrayResult.length - 3;
            for (var i = startIndex; i > 0; i -= 3) {
                arrayResult.splice(i, 0, ',');
            }
            // 결과값 리턴
            return arrayResult.join("");
        }
    })(jQuery);


    // 사용자 정의 jQuery 플러그인 만들기
    (function($)
    {
        $.fn.removeAni=function(){
            this.each(function(index){
                var $target = $(this);
                $target.delay(index*1000).animate({ height: 0 }, 500, function(){
                    $target.remove();
                })
            })

            return this;
        }
    })(jQuery)

    $(document).ready(function(){
        /**
         * jQuery 유틸리티 호출
        document.write("123=>", $.addComma("123"), "<br>");
        document.write("1234=>", $.addComma("1234"), "<br>");
        document.write("12345=>", $.addComma("12345"), "<br>");
        document.write("123456=>", $.addComma("123456"), "<br>");
        document.write("1234567=>", $.addComma("1234567"), "<br>");
         */


        // 플러그인 호출
        $(".menu li").removeAni();
    });
</script>

</body>
</html>

