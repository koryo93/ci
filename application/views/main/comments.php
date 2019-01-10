<div class="col-md-12">
    <hr size="10px" color="black">
    <h4><b>댓글</b></h4>
    <br>
    전체 : <b><?=$num_rows;?></b>
    <!-- 댓글 테이블 형태로 출력 -->
    <table class="table">
        <thead>
            <tr><th>닉네임</th><th>댓글</th><th>작업</th></tr>
        </thead>
        <tbody>
        <?php
            foreach($list as $lt)
            {
        ?>
        <tr>
            <td><?=$lt->nickname;?></td>
            <td><?=$lt->content;?></td>
            <td><a class="btn btn-sm btn-danger" href='<?=site_url();?>/board/deleteComment/<?=$lt->idx;?>'>삭제</a></td>
        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    <center><ul class='pagination'><?=$pagination;?></ul></center>
</div>
<b>댓글작성</b>
<br>
<!-- 댓글 작성용 폼 -->
<form id="Frm2" method="post" action="<?=site_url();?>/board/insertComment">
    <input type="hidden" id="bdIDX" name="bdIDX" value='<?=$this->uri->segment(3);?>'>
    <div class="col-sm-2">
        <input class="form-control" type="text" id="nickname" name="nickname" placeholder="닉네임">
    </div>
    <div class="col-sm-9">
        <input class="form-control" id="content" name="content" placeholder="댓글">
    </div>
    <div class="col-sm-1"><input class="btn btn-sm btn-info" type="submit" value="저장"></div>
</form>
