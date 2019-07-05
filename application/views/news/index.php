<h2><?php echo $title; ?></h2>

<button type="button"  onclick="location.href='news/create'">上傳新聞</button>
<button type="button"  onclick="location.href='news/clear'">清空新聞</button>

<?php foreach ($news as $news_item): ?>

	<div class="main">

    <h3><?php echo $news_item['title']; ?></h3>
    <div><?php echo $news_item['text']; ?></div>
    
    <p><a href="<?php echo site_url('news/view/'.$news_item['id']); ?>">完整內容...</a></p>

    </div>

<?php endforeach; ?>