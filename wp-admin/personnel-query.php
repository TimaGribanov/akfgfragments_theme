<?php
/**
 * Personnel Edit Administration Screen – Add new – Query.
 *
 * @package WordPress
 * @subpackage Administration
 */



require_once __DIR__ . '/admin.php';

$name = $_POST['param'];

$namesdb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
$name_id_arr = $namesdb->get_results("SELECT id, en, ja FROM personnel WHERE en LIKE \"$name%\";");
$name_id_arr_length = count($name_id_arr);

$i = 0;

foreach ($name_id_arr as $name_id) {
    ?>
    <table>
        <tbody>
            <tr class="name-button" style="cursor: pointer;">
                <td><span class="name-id"><?php echo $name_id->id; ?></span></td>
                <td><span class="name-en"><?php echo $name_id->en; ?></span></td>
                <td><?php echo $name_id->ja; ?></td>
            </tr>
        </tbody>
    </table>
    <?php
    $i++;
}
?>