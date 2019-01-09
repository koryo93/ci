<!doctype html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/tabmenu.css">
	<title>탭메뉴</title>
    <script>
        $(document).ready(function(){
            tabMenu1.init();
            tabMenu1.initEvent();
            tabMenu2.init();
            tabMenu2.initEvent();
        });

        var tabMenu1 = {
            $tabMenu : null,
            $menuItems : null,
            $selectMenuItem : null,

            // 요소 초기화
            init:function()
            {
                this.$tabMenu = $("#tabMenu1");
                this.$menuItems = this.$tabMenu.find("li");
            },
            // 이벤트 등록
            initEvent:function()
            {
                var objThis = this;
                this.$menuItems.on("click", function(){
                    objThis.setSelectItem($(this));
                });
            },
            // $menuItem에 해당하는 메뉴 아이템 선택하기
            setSelectItem:function($menuItem){
                // 기존 선택 메뉴 아이템을 비활성화 처리하기
                if(this.$selectMenuItem)
                {
                    this.$selectMenuItem.removeClass("select");
                }

                // 신규 아이템 활성화 처리하기
                this.$selectMenuItem = $menuItem;
                this.$selectMenuItem.addClass("select");
            }
        }
        var tabMenu2 = {
            $tabMenu : null,
            $menuItems : null,
            $selectMenuItem : null,

            // 요소 초기화
            init:function()
            {
                this.$tabMenu = $("#tabMenu2");
                this.$menuItems = this.$tabMenu.find("li");
            },
            // 이벤트 등록
            initEvent:function()
            {
                var objThis = this;
                this.$menuItems.on("click", function(){
                    objThis.setSelectItem($(this));
                });
            },
            // $menuItem에 해당하는 메뉴 아이템 선택하기
            setSelectItem:function($menuItem){
                // 기존 선택 메뉴 아이템을 비활성화 처리하기
                if(this.$selectMenuItem)
                {
                    this.$selectMenuItem.removeClass("select");
                }

                // 신규 아이템 활성화 처리하기
                this.$selectMenuItem = $menuItem;
                this.$selectMenuItem.addClass("select");
            }
        }
    </script>
</head>
<body>
<p>탭메뉴 예제</p>
<ul class="tab-menu" id="tabMenu1">
    <li class="menuitem1">google</li>
    <li class="menuitem2">facebook</li>
    <li class="menuitem3">pinterest</li>
    <li class="menuitem4">twitter</li>
    <li class="menuitem5">airbnb</li>
    <li class="menuitem6">path</li>
</ul>
<ul class="tab-menu" id="tabMenu2">
    <li class="menuitem1">google</li>
    <li class="menuitem2">facebook</li>
    <li class="menuitem3">pinterest</li>
    <li class="menuitem4">twitter</li>
    <li class="menuitem5">airbnb</li>
    <li class="menuitem6">path</li>
</ul>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>

