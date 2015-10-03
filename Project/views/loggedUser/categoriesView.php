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
