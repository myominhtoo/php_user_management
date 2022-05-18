<?php
    namespace Helpers;

    include("../../vendor/autoload.php");

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;

    class UpdateSession{
        private $data = null;

        public function __construct(int $id){
            $table = new UsersTable(new MySQL());
            $this->data = $table->findById($id);
        }

        public function update(){
            session_start();
            $_SESSION['user'] = [
                    "id" => $this->data->id,
                    "name" => $this->data->name,
                    "phone" => $this->data->phone,
                    "address" => $this->data->address,
                    "email" => $this->data->email,
                    "role" => $this->data->role,
                    "suspend" => $this->data->suspend,
                    "photo" => $this->data->image,
                    "created_at" => $this->data->created_at,
                ];
        }
    }