<div>
    <table border="1">
        <tr>
            <th>
                Name
            </th>

            <th>
                Count
            </th>

        </tr>
        <?php
        foreach ($this->products as $k => $v):
            ?>
            <tr>
                <td><?= $v["Name"] ?></td>
                <td><?= $v["count"] ?></td>

            </tr>
        <?php endforeach ?>

    </table>
</div>
