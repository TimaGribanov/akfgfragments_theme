<?php
function normaliseTitle($input_title)
{
    $result_title = str_replace(
        '?',
        '%3F',
        str_replace(
            '#',
            '%23',
            str_replace(
                '&',
                '%26',
                str_replace(
                    '\'',
                    '%27',
                    str_replace(' ', '_', $input_title)
                )
            )
        )
    );

    return $result_title;
};
?>