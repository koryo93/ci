<div class="col-md-12">
    <h4><b><?=$htmlTag->header;?></b></h4>
    <form id="Frm1" method="post" action="">
        <input class="form-control" type="text" id="subject" name="subject" placeholder="제목" value="<?=$desc->subject;?>">
        <textarea class="form-control" rows="5" id="content" name="content" placeholder="내용"><?=$desc->content;?></textarea><br>
        <!-- 컨트롤러 Board.php 에 정의된 $data['htmlTag'] 의 btn값 출력 -->
        <?=$htmlTag->btn;?>
        <form name="schFrm" id="schFrm">
            <input type="hidden" name="prIDX" value='<?=$desc->idx;?>'>
            <a onClick="idxDownSch()"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <select class="input-sm" name="field" id="field">
                <option value="subject" <?php if(get_cookie('field') == 'subject') { echo 'selected'; }?>>제목</option>
                <option value="content" <?php if(get_cookie('field') == 'content') { echo 'selected'; }?>>내용</option>
            </select>
            <input class="input-sm" type="text" name="schVal" placeholder="검색값" value="<?=get_cookie('schVal');?>">
            <a onClick="idxUpSch()"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </form>
    </form>
</div>

<link rel="stylesheet" href="<?=base_url();?>/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url();?>/assets/css/custom.css">
<script src="<?=base_url();?>/assets/js/jquery-3.3.1.min.js"></script>
<script src="<?=base_url();?>/assets/js/jquery.validate.min.js"></script>
<script src="<?=base_url();?>/assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
    var siteurl="<?=site_url();?>";
    <!-- jquery validate 플러그인으로 폼 입력 여부 검증 -->
    $(function(){
        $('#Frm1').validate({
            rules:{
                subject:"required",
                content:"required"
            },
            messages:{
                subject: "제목은 필수입력 입니다.",
                content: "내용은 필수입력 입니다."
            }
        });
    });
    <!-- 게시글 제목 및 내용 자동 입력 함수 -->
    function autoInput()
    {
        document.getElementById("subject").value = "제목은 무엇으로 정할까?";
        document.getElementById("content").value = "내용도 아무렇게 작성하기";
    }
    <!-- 페이징 검색을 위해 idx 값 구하는 ajax -->
    function idxUpSch()
    {
        $.ajax({
            url: siteurl + "/board/idxSch/up",
            type: "post",
            data: $('form').serialize(),
        }).done(function(data){
            var dataArr = data.split(',');
            if(dataArr[0] == "")
            {
                alert("더 이상 높은 값 검색 결과가 없습니다.");
                exit;
            }
            else
                self.location = dataArr[0];
        });
    }
    function idxDownSch()
    {
        $.ajax({
            url: siteurl + "/board/idxSch/down",
            type: "post",
            data: $('form').serialize(),
        }).done(function(data){
            var dataArr = data.split(',');
            if(dataArr[0] == "")
            {
                alert("더 이상 낮은 값 검색 결과가 없습니다.");
                exit;
            }
            else
                self.location = dataArr[0];
        });
    }
    <!-- 댓글에 닉네임과 글입력 폼 검증 -->
    $(function(){
        $('#Frm2').validate({
            rules: {
                nickname: 'required',
                content: 'required'
            },
            messages: {
                nickname: "닉네임은 필수입력입니다.",
                content: "댓글으 필수입력입니다."
            }
        });
    });
</script>
