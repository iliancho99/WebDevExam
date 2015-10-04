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
                Cost
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
                <td><?= $v["cost"] ?></td>
                <td><a href="addtocart?id=<?=$v["idproduct"]?>">Add to cart</a></td>

            </tr>
        <?php endforeach ?>

    </table>
</div>
<?php if(\SCart\App::getInstance()->getSession()->role > 0): ?>
<a href="/index.php/products/addproduct" class="left">Add Product</a>
<?php endif ?>
