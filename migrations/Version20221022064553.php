<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221022064553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add audit columns to Camera, Lens and CameraSystem entities';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE camera_systems ADD updated_by_id VARCHAR(26) DEFAULT NULL');
        $this->addSql('ALTER TABLE camera_systems ADD created_by VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE camera_systems ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE camera_systems ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN camera_systems.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN camera_systems.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE camera_systems ADD CONSTRAINT FK_AC7FA196896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_AC7FA196896DBBDE ON camera_systems (updated_by_id)');
        $this->addSql('ALTER TABLE cameras ADD created_by VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cameras ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE cameras ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN cameras.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cameras.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE INDEX IDX_6B5F276ADE12AB56 ON cameras (created_by)');
        $this->addSql('ALTER TABLE lenses ADD created_by VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE lenses ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE lenses ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN lenses.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN lenses.updated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE camera_systems DROP CONSTRAINT FK_AC7FA196896DBBDE');
        $this->addSql('DROP INDEX IDX_AC7FA196896DBBDE');
        $this->addSql('ALTER TABLE camera_systems DROP updated_by_id');
        $this->addSql('ALTER TABLE camera_systems DROP created_by');
        $this->addSql('ALTER TABLE camera_systems DROP created_at');
        $this->addSql('ALTER TABLE camera_systems DROP updated_at');
        $this->addSql('ALTER TABLE lenses DROP created_by');
        $this->addSql('ALTER TABLE lenses DROP created_at');
        $this->addSql('ALTER TABLE lenses DROP updated_at');
        $this->addSql('DROP INDEX IDX_6B5F276ADE12AB56');
        $this->addSql('ALTER TABLE cameras DROP created_by');
        $this->addSql('ALTER TABLE cameras DROP created_at');
        $this->addSql('ALTER TABLE cameras DROP updated_at');
    }
}
