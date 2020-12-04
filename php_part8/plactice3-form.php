<!-- 演習問題8.12-3 -->
<form method='POST' action="<?= $form->encode($_SERVER['PHP_SELF'])?>">
<table>
    <?php if($errors) {?>
        <tr>
            <td>You Need to correct the following errors:</td>
            <td><ul>
                <?php foreach($errors as $error){ ?>
                    <li><?= $form->encode($error)?></li>
                <?php }?>
            </ul></td>
    <?php }?>
    <tr><td>dishe_names:</td>
        <td><?= $form->select($GLOBALS['dish_names'], ['name' => 'dish_id'])?></td>
    </tr>
    <tr><td colspan="2">
        <?= $form->input('submit', ['value' => 'submit name'])?>
    </td></tr>
    </table>
</form>