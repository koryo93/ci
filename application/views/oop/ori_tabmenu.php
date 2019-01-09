<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title></title>

	<style>
		.tab-menu {
    list-style: none;
			height:80px;
		}
		.tab-menu li {
    width:99px;
			height:40px;
			background-position-y:0;
			text-indent: -1000px;
			overflow: hidden;
			display: inline-block;
			float:left;
		}
		.tab-menu li:hover {
    background-position-y: -40px;
		}
		.tab-menu li.select {
    background-position-y: -80px;
			height:80px;
		}
		.tab-menu li.menuitem1 {
    background-image: url(../../../assets/images/newbtn.bar.1.png);
		}
		.tab-menu li.menuitem2 {
    background-image: url(../../../assets/images/newbtn.bar.2.png);
		}
		.tab-menu li.menuitem3 {
    background-image: url(../../../assets/images/newbtn.bar.3.png);
		}
		.tab-menu li.menuitem4 {
    background-image: url(../../../assets/images/newbtn.bar.4.png);
		}
		.tab-menu li.menuitem5 {
    background-image: url(../../../assets/images/newbtn.bar.5.png);
		}
		.tab-menu li.menuitem6 {
    background-image: url(../../../assets/images/newbtn.bar.6.png);
		}

	</style>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
	<script>

$(document).ready(function(){

});

		var tabMenu1 = {
    $tabMenu:null,
			$menuItems:null,
			$selectMenuItem:null,

			init:function(){
        this.$tabMenu = $("#tabMenu1");
        this.$menuItems = this.$tabMenu.find("li");
    },

			initEvent:function(){
        var objThis = this;
        this.$menuItems.on("click",function(){
            objThis.setSelectItem($(this));
        });
    },

			setSelectItem:function($menuItem){
        if(this.$selectMenuItem){
            this.$selectMenuItem.removeClass("select");
        }

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

</body>
</html>