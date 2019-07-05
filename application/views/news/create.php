<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('news/create'); ?>

    <div>
	    <label for="title">標題</label><br />
	    <input type="input" name="title" /><br />
	</div>

    <div>
	    <label for="text">內容</label><br />
	    <textarea name="text"></textarea><br />
	</div>

    <input type="submit" name="submit" value="建立新聞" />

</form>