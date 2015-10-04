<div>
<table border="1">
    <tr>
        <th>
            Categories
        </th>
    </tr>
    <?php
    foreach ($this->categories as $k => $v):
    ?>
    <tr>
        <td><a href="category/get?id=<?= $v["id"] ?>"><?= $v["name"] ?></a></td>
    </tr>
    <?php endforeach ?>

</table>
</div>

<?php if(\SCart\App::getInstance()->getSession()->role > 0): ?>
    <a href="/index.php/category/add" class="left">Add Product</a>
<?php endif ?>
