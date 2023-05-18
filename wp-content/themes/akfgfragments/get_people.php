<?php
function getName($input_id, $locale) {
    $output_name = "";
    $locale_parsed = substr($locale, 0, 2);

    $namedb = new wpdb(DATA_DB_USER, DATA_DB_PWD, DATA_DB_NAME, DATA_DB_HOST);
    $results = $namedb->get_results("SELECT id, $locale_parsed as `name` FROM personnel WHERE id = $input_id;");

    foreach ($results as $row) {
        $output_name = $row->name;
    }

    return $output_name;
}
?>
