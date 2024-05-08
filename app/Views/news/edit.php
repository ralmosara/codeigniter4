
<form action="/news/update" method="post">
<?= csrf_field() ?>
    <label for="title">Title</label>
    <input type="text" name="title" value="<?= $news->title; ?>">
    <label for="body">Text</label>
    <input type="text" name="body" value="<?= $news->body; ?>">
    <input type="hidden" name="id" value="<?= $news->id;?>">
    <button type="submit">Update</button>
</form>
