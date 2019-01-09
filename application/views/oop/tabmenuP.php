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
        function TabMenu(selector) {
            this.$tabMenu = null;
            this.$menuItems = null;
            this.$selectMenuItem = null;

            this.init(selector);
            this.initEvent();
        }


        TabMenu.prototype.init = function (selector)
        {
            this.$tabMenu = $(selector);
            this.$menuItems = this.$tabMenu.find("li");
        }

        TabMenu.prototype.initEvent = function()
        {
            var ObjThis = this;
            this.$menuItems.on("click", function(){
                objThis.setSelectItem($(this));
            });
        }

        TabMenu.prototype.setSelectItem = function($menuItem)
        {
            if(this.$selectMenuItem)
                this.$selectMenuItem.removeClass("select");

            this.$selectMenuItem = $menuItem;
            this.$selectMenuItem.addClass("select");
        }

        $(document).ready(function(){
            var tabMenu1 = new TabMenu("#tabMenu1");
            var tabMenu2 = new TabMenu("#tabMenu2");
        });
    </script>
</head>
<body>
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

