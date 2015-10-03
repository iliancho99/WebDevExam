<div>
    <table border="1">
        <tr>
            <th>
                Name
            </th>

            <th>
                Quantity
            </th>

            <th>
                Add to cart
            </th>

        </tr>
        <?php
        foreach ($this->products as $k => $v):
            ?>
            <tr>
                <td><?= $v["name"] ?></td>
                <td><?= $v["quantity"] ?></td>
                <td><a href="addtocart?id=<?=$v["idproduct"]?>">Add to cart</a></td>
            </tr>
        <?php endforeach ?>

    </table>
</div>