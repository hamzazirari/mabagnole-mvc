<?php
class User extends BaseModel {
    private int $id;
    private string $email;
    private string $password;

    public function __construct(PDO $pdo, int $id = 0, string $email = '', string $password = '') {
        parent::__construct($pdo);
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    // GETTERS
    public function getId(): int {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function login(string $email, string $password): bool {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $this->id = $user['id_user'];
            $this->email = $user['email'];
            $this->password = $user['password'];
            return true;
        }
        return false;
    }


}
?>