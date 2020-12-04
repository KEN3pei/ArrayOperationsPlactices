<!-- 演習問題8.12-4 -->
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
    <tr><td>Client Name:</td>
        <td><?= $form->input('text',['name' => 'name'])?></td>
    </tr>
    <tr><td>Tell Number:</td>
        <td><?= $form->input('text',['name' => 'tell'])?></td>
    </tr>
    <tr><td>dishe_names:</td>
        <td><?= $form->select($GLOBALS['dishe_names'], ['name' => 'dishe_name'])?></td>
    </tr>
    <tr><td colspan="2">
        <?= $form->input('submit', ['value' => 'Client set'])?>
    </td></tr>
    </table>
</form>