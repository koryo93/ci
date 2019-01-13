<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Board_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 게시글 num_rows 또는 검색 조건에 따른 select 결과 반환
     */
    function getBoards($kind = '', $offset = '', $limit = '', $idx = '', $subject = '', $content = '', $field = '', $sort = '')
    {
        if (!isset($field))
            $this->db->order_by('idx', 'desc');
        else
            $this->db->order_by($field, $sort);

        if ($idx == '')
            $this->db->like('board.idx', $idx);
        else
            $this->db->like('board.idx', $idx, 'none');

        $this->db->like('board.subject', $subject);
        $this->db->like('board.content', $content);
        $this->db->select('*');
        $this->db->from('board');
        /**
         * join 문과 같이 복잡한 쿼리는 ActiveRecord 내에서 아래와 같이 쿼리문 작성 가능
         */
        $this->db->join('(SELECT bdIDX, count(bdIDX) AS commentSum FROM comment GROUP BY bdIDX) as comment',
            '(board.idx=comment.bdIDX)', 'left');

        if ($kind == 'num_rows') {
            $query = $this->db->get();
            $result = $query->num_rows();
        } else {
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            $result = $query->result();
        }
        // echo $this->>db->last_query(); // 주석 해제 시 쿼리 스트링 출력

        return $result;
    }

    /**
     * 게시글 1건에 대한 select 반환
     */
    function getBoard($idx)
    {
        $query = $this->db->get_where('board', array('idx' => $idx));
        $result = $query->row();

        return $result;
    }

    /**
     * 게시글 입력
     */
    function insertBoard($subject, $content)
    {
        $data = array(
            'subject' => $subject,
            'content' => $content
        );
        $this->db->insert('board', $data);
    }

    /**
     * 게시글 수정(업데이트)
     */
    function updateBoard($idx, $subject, $content)
    {
        $data = array(
            'subject' => $subject,
            'content' => $content,
        );
        $this->db->where('idx', $idx);
        $this->db->update('board', $data);
    }

    /**
     * 게시글의 댓글(코멘트) 및 게시글 삭제
     */
    function deleteBoard($idx)
    {
        $this->db->delete('comment', array('bdIDX' => $idx));
        $this->db->delete('board', array('idx' => $idx));
    }

    /**
     * 복수의 댓글 및 게시글 한번에 삭제
     */
    function delAll($idxs)
    {
        $this->db->where_in('bdIDX', explode(',', $idxs));
        $this->db->delete('comment');

        $this->db->where_in('idx', explode(',', $idxs));
        $this->db->delete('board');
    }

    /**
     * 댓글(코멘트) num_rows 또는 전체 select
     */
    function getComments($kind = '', $offset = '', $limit = '', $idx = '')
    {
        $this->db->order_by('idx', 'desc');
        $this->db->where('bdIDX', $idx);
        $query = $this->db->get('comment', $limit, $offset);

        if ($kind == 'num_rows')
            $result = $query->num_rows();
        else
            $result = $query->result();

        return $result;
    }

    /**
     * 댓글(코멘트 입력)
     */
    function insertComment($bdIDX, $nickname, $content)
    {
        $data = array(
            'bdIDX' => $bdIDX,
            'nickname' => $nickname,
            'content' => $content,
        );
        $this->db->insert('comment', $data);
    }

    /**
     * 댓글(코멘트) 삭제
     */
    function deleteComment($idx)
    {
        $this->db->delete('comment', array('idx'=>$idx));
    }
    /**
     *  테이블 전체 truncate
     */
    function truncate()
    {
        $this->db->truncate('comment');
        $this->db->truncate('board');
    }
    /**
     * 게시 글 상세페이지에서 조건에 따른 페이징 위한 idx 값 변환
     */
    function getIDX($direction='', $prIDX='', $field='', $schVal='')
    {
        if($direction == 'up')
        {
            $this->db->like($field, $schVal);
            $this->db->where('idx >', $prIDX);
            $this->db->select_min('idx', 'neIDX');
            $query = $this->db->get('board');
        }
        else
        {
            $this->db->like($field, $schVal);
            $this->db->where('idx <', $prIDX);
            $this->db->select_max('idx', 'neIDX');
            $query = $this->db->get('board');
        }
        $result = $query->row();

        return $result;
    }
}

