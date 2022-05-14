<?php
    include("../vendor/autoload.php");

    use Faker\Factory as Faker;

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;

    $table = new UsersTable((new MySQL("localhost:3306","php_project","lionel","Mmh28803#")));
    $faker = Faker::create();

    if($table){
        echo "Success!\n";

        for($i = 0 ; $i < 10 ; $i++){
            $datas = [
                ":name" => $faker->name,
                ":email" => $faker->email,
                ":phone" => $faker->phoneNumber,
                
                ":password" => md5("password"),
                ":role_id" => $i < 5 ? rand(1,3) : 1,
            ];
            $table->insert($datas);
        }
        echo "Don!";
    }