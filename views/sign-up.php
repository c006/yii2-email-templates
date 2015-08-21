<?php

if (!isset($array['message'])) {
    $array['message'] = \c006\email\assets\Assets::$MSG_SIGN_UP;
    $array['message'] = str_replace('#NAME#', $array['name'], $array['message']);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width"/>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Passion+One:400,700' rel='stylesheet' type='text/css'>
    <style type="text/css">
        body {
            width                    : 100% !important;
            min-width                : 100%;
            -webkit-text-size-adjust : 100%;
            -ms-text-size-adjust     : 100%;
            margin                   : 0;
            padding                  : 0;
        }

        .email-container {
            display : block;
            margin  : 0;
            padding : 0;
            width   : 100%;
            height  : 100%;
        }

        .email-container .table {
            display : table;
            margin  : 0;
            padding : 0;
            width   : 100%;
            height  : auto;
        }

        .email-container tr {
            display : table-row;
            width   : 100%;
            margin  : 0;
            padding : 0;
        }

        .email-container td {
            display : table-cell;
            margin  : 0;
            padding : 0 5px;
        }

        .email-container img {
            outline                : none;
            text-decoration        : none;
            -ms-interpolation-mode : bicubic;
            min-width              : 100%;
            max-width              : 100%;
            max-height             : 100%;
            float                  : left;
            clear                  : both;
            display                : block;
        }

        .email-container .header {
            background-color : #333333;
        }

        .email-container .company-name {
            font-size    : 2.25em;
            font-weight  : bold;
            font-variant : all-small-caps;
            color        : #D97506;
            font-style   : normal;
            font-family  : 'Passion One', sans-serif;
            text-align   : left;
        }

        .email-container .page-title {
            font-size    : 2.25em;
            font-weight  : bold;
            font-variant : all-small-caps;
            color        : #D9AC00;
            font-family  : 'Passion One', sans-serif;
            text-shadow  : 2px 2px 3px rgba(0, 0, 0, 1);
            text-align   : right;
        }

        .email-container .message {
            padding          : 10px;
            font-size        : 1.2em;
            font-weight      : normal;
            font-variant     : normal;
            color            : #333333;
            font-family      : "Open Sans", "Helvetica Neue", Arial, sans-serif;
            text-align       : left;
            background-color : #fcfcfc;
        }

        .email-container .message p {
            padding-bottom : 15px;
        }

        .email-container .footer {
            background-color : #333333;
        }
    </style>
</head>
<body class="email-container">
<table class="table">
    <tr>
        <td>
            <table class=" table header">
                <tr>
                    <td class="company-name"><?= $array['company_name'] ?></td>
                    <td class="page-title"><?= $array['page_title'] ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <img src="//<?= $_SERVER['HTTP_HOST'] ?>/email/header.jpg" alt=""/>
        </td>
    </tr>
    <tr>
        <td>
            <div class="message"><?= $array['message'] ?></div>
        </td>
    </tr>
    <tr>
        <td>
            <table class="table footer">
                <tr>
                    <td><?= $array['footer'] ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

