<div class="col-md-12">
   <h4><b>심플 게시판</b>목록</h4>
    <!-- 게시글 검색 폼 -->
    <div class="search-setting">
    <form name="sch_frm" method="get" action="<?=base_url();?>board/index" style="margin-bottom: 1px;">
        <div class='form-row'>
            <div class="col-sm-2">
                <input class="form-control input-sm" type="text" name="idx" placeholder="idx" value='<?=$s_idx;?>'>
            </div>
            <div class="col-sm-2">
                <input class="form-control input-sm" type="text" name="subject" placeholder="제목" value='<?=$s_subject;?>'>
            </div>
            <div class="col-sm-2">
                <input class="form-control input-sm" type="text" name="content" placeholder="내용" value='<?=$s_content;?>'>
            </div>
            <div class="col-sm-2">
                <select class="form-control" name="field" id="field">
                    <option value="idx" <?php if($s_field=='idx' or $s_field=='') { echo 'selected'; } ?>>번호</option>
                    <option value="subject" <?php if($s_field=='subject') { echo 'selected'; } ?>>제목</option>
                    <option value="content" <?php if($s_field=='content') { echo 'selected'; } ?>>내용</option>
                    <option value="commentSum" <?php if($s_field=='commentSum') { echo 'selected'; } ?>>댓글</option>
                </select>
            </div>
            <div class="col-sm-2">
                <input type="radio" name="sort" value="desc" <?php if($s_sort=='desc' or $s_sort=='') { echo 'checked'; }?>>내림 &nbsp;&nbsp;
                <input type="radio" name="sort" value="asc" <?php if($s_sort=='asc') { echo 'checked'; } ?>>오름&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-sm btn-info">검색</button>
            </div>
        </div>
    </form>
    </div>
    전체 : <b><?=$num_rows;?></b>
    <!-- 게시물 목록으로 출력 -->
    <table class="table">
        <thead>
        <tr>
            <!-- 테이블 헤드에 출력되는 필드 클릭 시 검색폼의 정렬값 자동 변경 -->
            <th><input type="checkbox" id="master"></th>
            <th><a href="javascript:void(0);" onclick="document.getElementById('field').value='idx';">번호</a></th>
            <th><a href="javascript:void(0);" onclick="document.getElementById('field').value='subject';">제목</a></th>
            <th><a href="javascript:void(0);" onclick="document.getElementById('field').value='content';">내용</a></th>
            <th><a href="javascript:void(0);" onclick="document.getElementById('field').value='commentSum';">댓글</a></th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach($list as $lt) {
        ?>
        <tr>
            <td><input type="checkbox" class="sub_chk" data-id="<?=$lt->idx;?>"</td>
            <td><a href='<?=site_url();?>board/desc/<?=$lt->idx;?>'><?=$lt->idx;?></a></td>
            <td><?=$lt->subject;?></td>
            <td><?=mb_substr($lt->content, 0, 12, 'UTF-8');?></td>
            <td><?=$lt->commentSum;?></td>
        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    <!-- 페이징 및 입력, 삭제, 초기화 버튼 -->
    <center><ul class="pagination"><?=$pagination;?></ul></center>
    <a class="btn btn-sm btn-info" href="<?=site_url();?>board/insert">입력</a>
    <a class="btn btn-sm btn-danger delete_all" data-url="<?=site_url();?>board/deleteAll">삭제</a>
</div>

<!-- 부트스트랩 및 jquery 불러오기 -->
<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.css">
<link rel="stylesheet" href="<?=base_url();?>assets/css/custom.css">
<script src="<?=base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?=base_url();?>assets/js/jquery.validate.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.js"></script>
<script type="text/javascript">
    <!-- 여러 개의 게시글 선택하여 삭제 -->
    $(document).ready(function(){
        $('#master').on('click', function(e){
            if($(this).is(':checked', true)) {
                $('.sub_chk').prop('checked', true);
            }
            else {
                $('.sub_chk').prop('checked', false);
            }
        });
        $('.delete_all').on('click', function(e){
            var allVals = [];
            $(".sub_chk:checked").each(function(){
                allVals.push($(this).attr('data-id'));
            });
            if(allVals.length <= 0)
                alert("게시글을 선택해 주세요!");
            else
            {
                var check = confirm("정말 선택하신 게시글을 삭제하시겠습니까?");
                if(check)
                {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'POST',
                        data: 'idxs='+join_selected_values,
                        success: function(data)
                        {
                            console.log(data);
                            $(".sub_chk:checked").each(function(){
                                $(this).parents("tr").remove();
                            });
                            alert("성공적으로 삭제되었습니다.");
                        },
                        error: function(data)
                        {
                            alert(data.responseText);
                        }
                    });
                    $.each(allVals, function(index, value){
                        $('table tr').filter("[data-row-id='"+ value + "']").remove();
                    });
                }
            }
        });
    });
</script>



