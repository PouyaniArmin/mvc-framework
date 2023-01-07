<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    public PDO $pdo;
    public function __construct(array $config)
    {
        $dns = $config['dns'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        try {
            $this->pdo = new PDO($dns, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "ERROR : " . $e->getMessage();
            die;
        }
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getApplyMigrations();
        

        $newMigration=[];
        $files = scandir(Application::$ROOT_DIR . '/migrations');

        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            require_once Application::$ROOT_DIR . "/migrations/$migration";
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className;
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigration[]=$migration;   
        }
        if (!empty($newMigration)) {
            $this->saveMagiration($newMigration);
        }else{
            $this->log("All migrations are applied");
        }
    }
    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration varchar(255),
            create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)
            ENGINE=INNODB;");
    }

    public function getApplyMigrations()
    {
        $statment = $this->pdo->prepare("SELECT migration FROM migrations");
        $statment->execute();
        return $statment->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMagiration(array $migrations){
        $str=implode(",",array_map(fn($m)=>"('$m')",$migrations));
        $statment=$this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str");
        $statment->execute();
    }

    public function prepare($sql){
        return $this->pdo->prepare($sql);
    }

    protected function log($message){
        echo "[".date('Y-m-d H:i:s')."]-".$message.PHP_EOL;
    }
}
