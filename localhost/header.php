<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link href="localhost/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="/localhost/jquery-ui-1.8.23.custom/css/ui-lightness/jquery-ui-1.8.23.custom.css" type="text/css" rel="stylesheet" />
        <script src="/localhost/jquery-ui-1.8.23.custom/js/jquery-1.8.0.min.js" type="text/javascript"></script>
        <script src="/localhost/jquery-ui-1.8.23.custom/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        <script src="/localhost/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <style>
        body {
            background-color: #eeebe9;
        }
        h1 {
            font-size: 30px;
            color: black;
            font-weight: bold;
        }
        h2 {
            color: black;
        }
        .custab{
            border: 1px solid #ccc;
            padding: 5px;
            margin: 5% 0;
            box-shadow: 3px 3px 2px #ccc;
            transition: 0.5s;
        }
        .custab:hover{
            box-shadow: 3px 3px 0px transparent;
            transition: 0.5s;
        }
        input[type="search"] {
            border: 1px solid #bbb;
            border-radius: 2px;
            height: 35px;
        }
        a{
            color: #565452 !important;
        }
        body{
            overflow-x: hidden;
        }
    </style>
    <body>        