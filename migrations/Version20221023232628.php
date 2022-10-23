<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221023232628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update create_by_id refernces';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE camera_producers ADD created_by_id VARCHAR(26) DEFAULT NULL');
        $this->addSql('ALTER TABLE camera_producers DROP created_by');
        $this->addSql('ALTER TABLE camera_producers ADD CONSTRAINT FK_4CCDD051B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4CCDD051B03A8386 ON camera_producers (created_by_id)');
        $this->addSql('ALTER TABLE camera_systems ADD created_by_id VARCHAR(26) DEFAULT NULL');
        $this->addSql('ALTER TABLE camera_systems DROP created_by');
        $this->addSql('ALTER TABLE camera_systems ADD CONSTRAINT FK_AC7FA196B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_AC7FA196B03A8386 ON camera_systems (created_by_id)');
        $this->addSql('DROP INDEX idx_6b5f276ade12ab56');
        $this->addSql('ALTER TABLE cameras ADD created_by_id VARCHAR(26) DEFAULT NULL');
        $this->addSql('ALTER TABLE cameras DROP created_by');
        $this->addSql('ALTER TABLE cameras ADD CONSTRAINT FK_6B5F276AB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6B5F276AB03A8386 ON cameras (created_by_id)');
        $this->addSql('ALTER TABLE lenses ADD created_by_id VARCHAR(26) DEFAULT NULL');
        $this->addSql('ALTER TABLE lenses DROP created_by');
        $this->addSql('ALTER TABLE lenses ADD CONSTRAINT FK_C3EE7FE2B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C3EE7FE2B03A8386 ON lenses (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cameras DROP CONSTRAINT FK_6B5F276AB03A8386');
        $this->addSql('DROP INDEX IDX_6B5F276AB03A8386');
        $this->addSql('ALTER TABLE cameras ADD created_by VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cameras DROP created_by_id');
        $this->addSql('CREATE INDEX idx_6b5f276ade12ab56 ON cameras (created_by)');
        $this->addSql('ALTER TABLE camera_systems DROP CONSTRAINT FK_AC7FA196B03A8386');
        $this->addSql('DROP INDEX IDX_AC7FA196B03A8386');
        $this->addSql('ALTER TABLE camera_systems ADD created_by VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE camera_systems DROP created_by_id');
        $this->addSql('ALTER TABLE camera_producers DROP CONSTRAINT FK_4CCDD051B03A8386');
        $this->addSql('DROP INDEX IDX_4CCDD051B03A8386');
        $this->addSql('ALTER TABLE camera_producers ADD created_by VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE camera_producers DROP created_by_id');
        $this->addSql('ALTER TABLE lenses DROP CONSTRAINT FK_C3EE7FE2B03A8386');
        $this->addSql('DROP INDEX IDX_C3EE7FE2B03A8386');
        $this->addSql('ALTER TABLE lenses ADD created_by VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE lenses DROP created_by_id');
    }
}
