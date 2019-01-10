<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Board extends CI_Controller
{
    function __construct()
    {
        paranet::__construct();
        $this->load->database();
        $this->load->model("board_m");
        $this->load->helper(array('url', 'date'));
        $this->load->library('user_agent');
        $this->load->helper('cookie');
    }

    /**
     * 게시판 검색 폼 및 전체 목록 페이지
     */
    public function index()
    {
        delete_cookie('field');     // URL 이동 시 자동으로 쿠키 삭제하느 ㄴ코드
        delete_cookie('schVal');
        $idx = $this->input->get('idx', TRUE);
        $subject = $this->input->get('subject', TRUE);
        $content = $this->input->get('content', TRUE);
        $field = $this->input->get('field', TRUE);
        $sort = $this->input->get('sort', TRUE);

        $data = array(
            "s_idx" => $idx,
            "s_subject" => $subject,
            "s_content" => $content,
            "s_field" => $field,
            "s_sort" => $sort,
        );

        $_GET['idx'] = $idx;
        $_GET['subject'] = $subject;
        $_GET['content'] = $content;
        $_GET['field'] = $field;
        $_GET['sort'] = $sort;

        $this->load->library('pagination');

        $config = array(
            'first_url' => site_url() . '/board/index/page/1' . http_build_query($_GET),
            'base_url' => site_url() . '/board/index/page',
            'total_rows' => $this->board_m->getBoards('num_rows', '', '', $idx, $subject, $content),
            'per_page' => 10,
//          'use_page_numbers'=>TRUE,
            'suffix' => '?' . http_build_query($_GET, '', '&'),
            'full_tag_open' => "<ul class='pagination pagination-sm'>",
            'full_tag_close' => "</ul>",
            'num_tag_open' => "<li>",
            "num_tag_close" => "</li>",
            "cur_tag_open" => "<li class='disabled'><li class='active'<a href='#'>",
            "cur_tag_close" => "<span class='sr-only'></span></a></li>",
            "next_tag_open" => "<li>",
            "next_tag_close" => "</li>",
            "prev_tag_open" => "<li>",
            "prev_tag_close" => "</li>",
            "first_tag_open" => "<li>",
            "first_tag_close" => "</li>",
            "last_tag_open" => "<li>",
            "last_tag_close" => "</li>",
        );

        $this->pagination->initialize($config);

        $data['pagenation'] = $this->pagination->create_links();
        $data['num_rows'] = $config['total_rows'];

        $page = $this->uri->segment(4, 1);
        if ($page > 1)
            $offset = (($page / $config['per_page'])) * $config['per_page'];
        else
            $offset = ($page - 1) * config['per_page'];

        $data['list'] = $this->board_m->getBoards('', $offset, $config['per_page'], $idx, $subject, $content, $field, $sort);
        $this->load->view('header');
        $this->load->view('index', $data);
        $this->load->view('bottom');
    }

    /**
     * 게시글 업데이트 또는 상세 폼 출력 및 댓글 출력
     */
    public function desc()
    {
        if ($_POST) {
            $idx = $this->uri->segment(3);
            $subject = $this->input->post('subject', TRUE);
            $content = $this->input->post('content', TRUE);
            $this->board_m->updateBoard($idx, $subject, $content);

            redirect('/board/desc/' . $idx);
            exit;
        } else {
            $idx = $this->uri->segment(3);
            $data['desc'] = $this->board_m->getBoard($idx);
            // 상세화면인 경우 나타내는 header 타이틀과 버튼용 html tag
            $data["htmlTag"] = (object)array(
                'header' => '심플 게시판<폼 상세>',
                'btn' => "<input class='btn btn-sm btn-info', type='submit' value='수정'>
                        <a class='btn btn-sm btn-success' href=" . site_url() . "/board>목록</a>
                        <a class='btn btn-sm btn-danger' href=" . site_url() . "/board/deleteBoard/" . $this->uri->segment(3) . ">삭제</a>",
        );
            // 댓글의 페이징 기능
            $this->load->library('paginagion');
            $config = array(
                'first_url' => site_url() . '/board/desc/' . $idx . "/",
                'total_rows' => $this->board_m->getComments('num_rows', '', '', $idx),
                'per_page' => 5,
                'uri_segment' => 4,   // 페이지 번호를 URI 세그먼트의 어느 부분에 포함시킬지 설정(선택 옵션)
//          'use_page_numbers'=>TRUE,
                'num_links' => 1,     // 선택된 페이지 번호 좌우로 몇 개의 "숫자" 링크를 보여줄 지 설정
                'full_tag_open' => "<ul class='pagination pagination-sm'>",
                'full_tag_close' => "</ul>",
                'num_tag_open' => "<li>",
                "num_tag_close" => "</li>",
                "cur_tag_open" => "<li class='disabled'><li class='active'<a href='#'>",
                "cur_tag_close" => "<span class='sr-only'></span></a></li>",
                "next_tag_open" => "<li>",
                "next_tag_close" => "</li>",
                "prev_tag_open" => "<li>",
                "prev_tag_close" => "</li>",
                "first_tag_open" => "<li>",
                "first_tag_close" => "</li>",
                "last_tag_open" => "<li>",
                "last_tag_close" => "</li>",
            );

            $this->pagination->initialize($config);
            $data2['pagination'] = $this->pagination->create_links();
            $data2['num_rows'] = $config["total_rows"];

            $page = $this->uri->segment(4, 1);
            // mysql에서 limit 는 가져오는 row의 개수, offset은 몇번째 row 부터 가져올지 결정.

            if ($page > 1)
                $offset = ((page / $config['per_page'])) * $config['per_page'];
            else
                $offet = ($page - 1) * $config['per_page'];

            $data2['list'] = $this->board_m->getComments('', $offset, $config['per_page'], $idx);
            $this->load->view('header');
            $this->load->view('form', $data);
            $this->load->view('comment', $data2);
            $this->load->view('bottom');
        }
    }

    /**
     * 게시글 입력
     */
    public function insert()
    {
        if ($_POST) {
            $subject = $this->input->post("subject", TRUE);
            $content = $this->input->post("content", TRUE);
            $this->board_m->insertBoard($subject, $content);

            redirect('/board/index/');
            exit;
        } else {
            // 게시글 입력창에 idx, subject, content 빈 값으로 넘김
            $data['desc'] = (object)array(
                'idx' => '',
                'subject' => '',
                'content' => ''
            );
            //  입력창인 경우 나타내는 header 타이틀과 버튼용 html tag
            $data['htmlTag'] = (object)array(
                'header' => '심플게시판 <폼 입력>',
                'btn' => '<a class="btn btn-sm btn-warning" onclick="autoInput()">자동입력</a>
					<input class="btn btn-sm btn-info" type="submit" value="저장">
					<a class="btn btn-sm btn-success" href=' . site_url() . '/board>목록</a>',
            );
            $this->load->view('header');
            $this->load->view('form', $data);
            $this->load->view('bottom');
        }
    }

    /**
     * 게시글 삭제
     */
    public function deleteBoard()
    {
        $idx = $this->uri->segment(3);
        $this->board_m->deleteBoard($idx);
        redirect("/board/index/");
    }

    /**
     * 게시글 목록에서 multiple 삭제
     */
    public function deleteAll()
    {
        $idxs = $this->input->post('idxs');
        $this->borad_m->delAll($idxs);

        redirect('/board/index/');
    }

    /**
     * 댓글(코멘트) 입력
     */
    public function insertComment()
    {
        $bdIDX = $this->input->post('bdIDX', TRUE);
        $nickname = $this->input->post('nickname', TRUE);
        $content = $this->input->post('content', TRUE);
        $this->board_m->insertComment($bdIDX, $nickname, $content);

        redirect('/board/desc/' . $bdIDX);
        exit;
    }
    /**
     * 댓글(코멘트) 삭제
     */
    public function deleteComment()
    {
        $idx = $this->uri->segment(3);
        $this->board_m->deleteComment($idx);

        redirect($this->agent->referrer());
    }
    /**
     * 테이블 모두 truncate
     */
    public function truncate()
    {
        $this->board_m->truncate();

        redirect('/board/index/');
    }
    /**
     * 게시 상세페이지 조건 검색에 따라 페이징 위한 idx 값 구하여 반환
     */
    public function idxSch()
    {
        $direction = $this->uri->segment(3);
        $prIDX = $this->input->post('prIDX', TRUE);
        $field = $this->input->post('field', TRUE);
        $schVal = $this->input->post('schVal', TRUE);

        // 검색필드와 검색어를 쿠키로 저장
        set_cookie('field', $field, 1200);
        set_cookie('schVal', $schVal, 1200);

        // 요청한 direction 값이 up인 경우 현재 idx(prIDX)보다 높은 값 중 최소값을 반환, down인 경우 낮은 값 중 최대값을 반환
        $data['contsBoard'] = $this->board_m->getIDX($direction, $prIDX, $field, $schVal);
        $neIDX = $data['contsBoard']->neIDX;

        // 이동할 다음 페이지(neIDX)가 없는 경우 빈 값을 리턴하고 그렇지 않은 경우 이동할 url을 리턴
        if(empty($neIDX))
        {
            echo ','.$field.','.$schVal;
        }
        else
        {
            $url = site_url(). "/board/desc/".$neIDX;
            echo $url.','.$field.','.$schVal;
        }
    }
}
