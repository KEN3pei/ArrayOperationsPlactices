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
    <tr><td>発送元</td>
        <td><?= $form->input('text',['name' => 'send'])?></td>
    </tr>
    <tr><td>宛先住所</td>
        <td><?= $form->input('text',['name' => 'address'])?></td>
    </tr>
    <tr><td>郵便番号</td>
        <td><?= $form->input('text',['name' => 'zipcode'])?></td>
    </tr>
    <tr><td>寸法</td>
        <td><?= $form->select($GLOBALS['size'], ['name' => 'size'])?></td>
    </tr>
    <tr><td>重さ</td>
        <td><?= $form->input('text',['name' => 'weight'])?></td>
    </tr>

    <tr><td colspan="2">
        <?= $form->input('submit', ['value' => 'Order'])?>
    </td></tr>
    </table>
</form>