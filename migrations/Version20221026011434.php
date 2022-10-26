<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221026011434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add audit fields to entities';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE camera_producers ADD deleted_by_id VARCHAR(26) DEFAULT NULL');
        $this->addSql('ALTER TABLE camera_producers ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN camera_producers.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE camera_producers ADD CONSTRAINT FK_4CCDD051C76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4CCDD051C76F1F52 ON camera_producers (deleted_by_id)');
        $this->addSql('ALTER TABLE camera_systems ADD deleted_by_id VARCHAR(26) DEFAULT NULL');
        $this->addSql('ALTER TABLE camera_systems ADD deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN camera_systems.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE camera_systems ADD CONSTRAINT FK_AC7FA196C76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_AC7FA196C76F1F52 ON camera_systems (deleted_by_id)');
        $this->addSql('ALTER TABLE cameras ADD updated_by_id VARCHAR(26) DEFAULT NULL');
        $this->addSql('ALTER TABLE cameras ADD CONSTRAINT FK_6B5F276A896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6B5F276A896DBBDE ON cameras (updated_by_id)');
        $this->addSql('ALTER TABLE lenses ADD updated_by_id VARCHAR(26) DEFAULT NULL');
        $this->addSql('ALTER TABLE lenses ADD CONSTRAINT FK_C3EE7FE2896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C3EE7FE2896DBBDE ON lenses (updated_by_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE lenses DROP CONSTRAINT FK_C3EE7FE2896DBBDE');
        $this->addSql('DROP INDEX IDX_C3EE7FE2896DBBDE');
        $this->addSql('ALTER TABLE lenses DROP updated_by_id');
        $this->addSql('ALTER TABLE cameras DROP CONSTRAINT FK_6B5F276A896DBBDE');
        $this->addSql('DROP INDEX IDX_6B5F276A896DBBDE');
        $this->addSql('ALTER TABLE cameras DROP updated_by_id');
        $this->addSql('ALTER TABLE camera_systems DROP CONSTRAINT FK_AC7FA196C76F1F52');
        $this->addSql('DROP INDEX IDX_AC7FA196C76F1F52');
        $this->addSql('ALTER TABLE camera_systems DROP deleted_by_id');
        $this->addSql('ALTER TABLE camera_systems DROP deleted_at');
        $this->addSql('ALTER TABLE camera_producers DROP CONSTRAINT FK_4CCDD051C76F1F52');
        $this->addSql('DROP INDEX IDX_4CCDD051C76F1F52');
        $this->addSql('ALTER TABLE camera_producers DROP deleted_by_id');
        $this->addSql('ALTER TABLE camera_producers DROP deleted_at');
    }
}
