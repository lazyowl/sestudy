<?php
class Forum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Forum_model");
        $this->load->model('backstage_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->output->enable_profiler(TRUE);
    }
    public function index($forum_no = -1, $current_page = 1)
    {
        #待完成
        $limit = 5;
        $forumid_array = $this->Forum_model->getForumid();

        //die(print_r($forumid_array));
        //选择默认登录
        if($forum_no == -1)
        {    
            //若该用户有多个论坛
            if(count($forumid_array) > 1)
            {
                $data = array(
                    "forum_num" => count($forumid_array),
                    "forumid_array" => $forumid_array
                    );
                //die(print_r($data));
                $this->load->view('htmlhead');
                $this->load->view('student/course_header');
                $this->load->view('forum_select', $data);
                $this->load->view('footer');
                return;
            }
            //若只有一个论坛，则默认序号为0
            else
                $forum_no = 0;
        }

        //$forum_no表示用户的第几个讨论区，因为教师用户和助教用户可能有多个讨论区，当$forum_no的指大于用户讨论区个数时候报错
        if($forum_no + 1 > count($forumid_array))
            die('非法操作');

        $forumid = $forumid_array[$forum_no]['forumid'];

        $offset = ($current_page - 1)*$limit;
        $topic_array = array();
        $topic_array = $this->Forum_model->getTopicAndComment($forumid, $offset, $limit);
        $topic_total_num = $this->Forum_model->getTopicNum($forumid);
        
        $data = array(
            "topic_array" => $topic_array,
            "topic_total_num" => $topic_total_num,
            "forumid" => $forumid,
            "current_page" => $current_page,
            "total_page" => $topic_total_num/$limit + 1,
            "forum_no" => $forum_no);

        $role = $this->session->userdata('role');
        if ($role=="S")
        {
            $this->load->view('htmlhead');
            $this->load->view('student/course_header');
            $this->load->view('forum', $data);
            $this->load->view('footer');
        }
        else if ($role=="T")
        {
            $this->load->view('htmlhead');
            $this->load->view('teacher/course_header');
            $this->load->view('forum', $data);
            $this->load->view('footer');
        }
        else if ($role=="A")
        {
            $this->load->view('htmlhead');
            $this->load->view('assistant/course_header');
            $this->load->view('forum', $data);
            $this->load->view('footer');
        }
        else if ($role=="V") //保证用户是经过了登陆的
        {
            $this->load->view('htmlhead');
            $this->load->view('visitor/course_header');
            $this->load->view('forum', $data);
            $this->load->view('footer');
        }
    }

    public function submit($forum_no = 0, $current_page = 1)
    {
        //验证
        #code here
        $author_id = $this->session->userdata('userid');
        $author_name = $this->session->userdata('name');
        
        if($this->input->post('new_content') == false)
        {
            $this->load->view('submit');
        }
        else
        {
            $content = $this->input->post('new_content');
            $forumid = $this->input->post('forumid');

            //验证该用户在该论坛操作的合法性
            if($this->Forum_model->certificateForum($forumid) == false)
                die('非法操作');
            
            $time = time();
            $data = array(
                'author_id' => $author_id,
                'author_name' => $author_name,
                'forumid' => $forumid,
                'time' => $time,
                'number_of_comment' => 0,
                'content' => $content,
                'noname' => $this->input->post('noname'));
            $this->Forum_model->insert_topic($data);

            header('Location: '.site_url('forum/index/'.$forum_no.'/'.$current_page).'');
        }
    }

    public function reply($topic_id, $forum_no = 0, $current_page = 1)
    {
        //验证
        #code here
        $author_id = $this->session->userdata('userid');
        $author_name = $this->session->userdata('name');
        
        if($this->input->post('new_content') == false)
        {
            $data = array('topic_id' => $topic_id);
            $this->load->view('reply', $data);
        }
        else
        {
            //验证该用户在该论坛操作的合法性
            if($this->Forum_model->certificateTopic($topic_id) == false)
                die('非法操作');
            
            if($this->Forum_model->exist_topic_id($topic_id) == true)
            {
                $content = $this->input->post('new_content');
                $time = time();
                $data = array(
                    'topic_id' => $topic_id,
                    'author_id' => $author_id,
                    'author_name' => $author_name,
                    'time' => $time,
                    'content' => $content,
                    'noname' => $this->input->post('noname')
                    );
                $this->Forum_model->insert_comment($data);
                $this->Forum_model->increment_num_of_comment($topic_id);
                
                header('Location: '.site_url('forum/index/'.$forum_no.'/'.$current_page).'');
            }
            else
            {
                die("错误");
            }
        }
    }

}
?>
