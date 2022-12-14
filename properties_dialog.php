<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<tr>
    <td align="right" width="40%" valign="top"><span class="adm-required-field"><?= GetMessage("JC_WL2F_CONTENT_FIELD_TITLE") ?>:</span></td>
    <td width="60%">
        <?= CBPDocument::ShowParameterField("text", 'Content', $arCurrentValues['Content'], array('rows' => 1, 'cols' => 50)) ?>
    </td>
</tr>
<tr>
    <td align="right" width="40%" valign="top"><span class="adm-required-field"><?= GetMessage("JC_WL2F_FILE_PATH_FIELD_TITLE") ?>:</span></td>
    <td width="60%">
        <?= CBPDocument::ShowParameterField("text", 'FilePath', $arCurrentValues['FilePath'], array('rows' => 1, 'cols' => 50)) ?>
    </td>
</tr>