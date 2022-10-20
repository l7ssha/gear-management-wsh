<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221020151429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create user roles association';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user_role (user_id VARCHAR(26) NOT NULL, role_id VARCHAR(26) NOT NULL, PRIMARY KEY(user_id, role_id))');
        $this->addSql('CREATE INDEX IDX_2DE8C6A3A76ED395 ON user_role (user_id)');
        $this->addSql('CREATE INDEX IDX_2DE8C6A3D60322AC ON user_role (role_id)');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users DROP CONSTRAINT fk_1483a5e938c751c4');
        $this->addSql('DROP INDEX idx_1483a5e938c751c4');
        $this->addSql('ALTER TABLE users DROP roles_id');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT FK_2DE8C6A3A76ED395');
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT FK_2DE8C6A3D60322AC');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('ALTER TABLE users ADD roles_id VARCHAR(26) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT fk_1483a5e938c751c4 FOREIGN KEY (roles_id) REFERENCES roles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1483a5e938c751c4 ON users (roles_id)');
    }
}
