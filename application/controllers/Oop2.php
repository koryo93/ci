<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Oop2 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
//        $this->load->model("board_m");
//        $this->load->library('user_agent');
//        $this->load->helper('cookie');
    }

    /**
     * 게시판 검색 폼 및 전체 목록 페이지
     */
    public function index()
    {
        $this->load->view('oop/sGallery');
    }
}

