<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221020151045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial migration with users, roles and refresh tokens';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE refresh_tokens_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE refresh_tokens (id INT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9BACE7E1C74F2195 ON refresh_tokens (refresh_token)');
        $this->addSql('CREATE TABLE roles (id VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B63E2EC75E237E06 ON roles (name)');
        $this->addSql('CREATE TABLE users (id VARCHAR(26) NOT NULL, roles_id VARCHAR(26) DEFAULT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON users (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E935C246D5 ON users (password)');
        $this->addSql('CREATE INDEX IDX_1483A5E938C751C4 ON users (roles_id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E938C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE refresh_tokens_id_seq CASCADE');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E938C751C4');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE users');
    }
}
