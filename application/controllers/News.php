<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//News對應檔案名稱，繼承至CI_Controller(為CI架構本身提供的類別，詳見手冊)
class News extends CI_Controller {
	//設置建構子，model為存放API方法的檔案(檔案名稱取名為news_model)
	//url_helper此為CI架構本身提供的helper類別庫(方便使用者用簡單語法達成部分功能，詳見手冊https://goo.gl/UhrgW4)
    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->helper('url_helper');
    }
    //此為News.php控制器中的一函式index()，藉由config中的路由檔案routes.php呼叫
    //其呼應第55行的$route['news'] = 'news'
    //意味著網址為http://localhost/CI_practice/index.php/news時(最後面不帶入參數)，返回給使用者呈現的頁面
    public function index() {
    	//陣列$data中加入兩物件news及title，key為news，value為呼叫檔案news_model.php中的get_news()函式回傳結果
    	//由於get_news()內沒帶子物件、故進入11行的判斷式
        $data['news'] = $this->news_model->get_news();
        $data['title'] = 'News archive';

        //畫面呈現，分別載入header檔、index檔、footer檔
	    $this->load->view('templates/header', $data);
	    $this->load->view('news/index', $data);
	    $this->load->view('templates/footer');
    }

    //此為News.php控制器中的一函式view()
    //其呼應routes.php第54、56、57行的路由
    //網址為http://localhost/CI_practice/index.php/news/view時
    //返回給使用者呈現的頁面，帶入建構子$slug陣列，作為詳細新聞頁面的呈現
    public function view($slug = NULL)
    {
    	//由於get_news()內有帶子物件、故跳過11行的判斷式
        $data['news_item'] = $this->news_model->get_news($slug);
        //檢查get_news()函式回傳回來是否為空值，如是、即導入CI提供的404錯誤頁面
	    if (empty($data['news_item']))
	    {
	        show_404();
	    }
	    //由回傳回來陣列資料中的'title'設定網頁標頭
	    $data['title'] = $data['news_item']['title'];

	    //畫面呈現，分別載入header檔、view檔、footer檔
	    $this->load->view('templates/header', $data);
	    $this->load->view('news/view', $data);
	    $this->load->view('templates/footer');
    }
    //此為News.php控制器中的一函式create()
    //其呼應routes.php第53行的路由
    //網址為http://localhost/CI_practice/index.php/news/create
    public function create() {
    	//form為CI架構本身提供的helper類別庫(方便使用者用簡單語法達成部分功能，詳見https://goo.gl/6WBAkf)
	    $this->load->helper('form');
	    //form_validation為CI提供的library的函式庫，目的為驗證form表單內容，詳見https://goo.gl/MUr4JA
	    $this->load->library('form_validation');

	    $data['title'] = 'Create a news item';

	    $this->form_validation->set_rules('title', 'Title', 'required');
	    $this->form_validation->set_rules('text', 'Text', 'required');

	    if ($this->form_validation->run() === FALSE)
	    {
	        $this->load->view('templates/header', $data);
	        $this->load->view('news/create');
	        $this->load->view('templates/footer');

	    }
	    else
	    {
	        $this->news_model->set_news();
	        $this->load->view('news/success');
	    }
	}
}