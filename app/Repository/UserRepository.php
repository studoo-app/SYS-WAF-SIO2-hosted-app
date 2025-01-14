<?php

namespace Repository;

use PDO;
use Entity\User;
use Studoo\EduFramework\Core\Service\DatabaseService;

class UserRepository
{
    private PDO $bdd;

    public function __construct()
    {
        $this->bdd = DatabaseService::getConnect();
    }

    public function authenticate(string $email, string $password): bool|User
    {
        $sql = "SELECT * FROM user WHERE email='$email' AND password='$password';";
        $request = $this->bdd->query($sql);

        $user = $request->fetch();
        if ($user) {
            return new User(intval($user['id']), $user['name'],$user['email'], $user['password']);
        } else {
            return false;
        }

    }

    public function search(string $search): array
    {
        $sql = "SELECT * FROM user WHERE name LIKE '%$search%';";
        var_dump($sql);
        $request = $this->bdd->query($sql);

        //$sql = "SELECT * FROM user WHERE name LIKE :search;";
        //$request = $this->bdd->prepare($sql);
        //$request->execute(['search' => "%$search%"]);


        $users = [];
        foreach ($request->fetchAll() as $value) {
            $user = new User($value["id"], $value["name"], $value["email"], $value["password"]);
            $users[] = $user;
        }

        return $users;

    }

}