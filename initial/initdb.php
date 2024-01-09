<body>
    <?php
        $sqls = file_get_contents("initial/sql.sql");
        $split_sqls = preg_split("/\n\r/", $sqls);
        //var_dump($sqls);
    ?>
</body>