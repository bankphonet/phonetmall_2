<div class="cartholder">

    <h1>Manage stores:</h1>
    <?php if ($stores) { ?>
        <table cellspacing="3" cellpadding="3" width="980px">
            <tr>
                <th>ID</th>
                <th>Store name</th>
                <th>Telephone</th>
                <th>Items</th>
                <th>Trusted</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($stores as $store) { ?>
                <tr>
                    <td><?= $store['id'] ?></td>
                    <td><?= $store['title'] ?></td>
                    <td><?= $store['tel1'] ?></td>
                    <td><?= $store['items_count'] ?></td>
                    <td><?= ($store['trusted'] == 1) ? 'Yes' : 'No' ?></td>
                    <td>

                        <a href="?con=stores&page=store-form&id=<?= $store['id'] ?>&user=<?= $store['account_id'] ?>">EDIT STORE</a> -
                        <a href="?con=items&page=items-form&store_id=<?= $store['id'] ?>&user=<?= $store['account_id'] ?>">ADD ITEM</a> 
                        - <a href="?con=admin&action=delete-store&id=<?= $store['id'] ?>" onclick="var x = confirm ('This store will be deleted permanently'); if(!x)return false;">DELETE</a>
                        <?php if ($store['promoted'] == 0) { ?>
                            - <a href="?con=admin&action=promote-store&id=<?= $store['id'] ?>&pm=1" >PROMOTE</a>
                        <?php } else { ?>
                            - <a href="?con=admin&action=promote-store&id=<?= $store['id'] ?>" >UN-PROMOTE</a>
                        <?php } ?>
                    </td></tr>   


            <?php } ?>



        </table>
        <?= mypaging($pages_count, $page_no, 'href="?' . extractUrl($_GET) . '&page-no={page}" class="{active}"') ?>


    <?php } ?>
    <div class="clear"></div>


</div>