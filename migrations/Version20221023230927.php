<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221023230927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add CameraProducer entity; Extend Lens and Camera entity to CameraProducer';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE camera_producers (id VARCHAR(26) NOT NULL, updated_by_id VARCHAR(26) DEFAULT NULL, name VARCHAR(30) NOT NULL, created_by VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4CCDD051896DBBDE ON camera_producers (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_4CCDD0515E237E06 ON camera_producers (name)');
        $this->addSql('COMMENT ON COLUMN camera_producers.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN camera_producers.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE camera_system_camera_producer (camera_system_id VARCHAR(26) NOT NULL, camera_producer_id VARCHAR(26) NOT NULL, PRIMARY KEY(camera_system_id, camera_producer_id))');
        $this->addSql('CREATE INDEX IDX_C84AA38A4CA49 ON camera_system_camera_producer (camera_system_id)');
        $this->addSql('CREATE INDEX IDX_C84AA3AB1D2AD8 ON camera_system_camera_producer (camera_producer_id)');
        $this->addSql('ALTER TABLE camera_producers ADD CONSTRAINT FK_4CCDD051896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE camera_system_camera_producer ADD CONSTRAINT FK_C84AA38A4CA49 FOREIGN KEY (camera_system_id) REFERENCES camera_systems (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE camera_system_camera_producer ADD CONSTRAINT FK_C84AA3AB1D2AD8 FOREIGN KEY (camera_producer_id) REFERENCES camera_producers (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE camera_systems DROP producer_name');
        $this->addSql('ALTER TABLE cameras ADD producer_id VARCHAR(26) DEFAULT NULL');
        $this->addSql('ALTER TABLE cameras DROP producer_name');
        $this->addSql('ALTER TABLE cameras ADD CONSTRAINT FK_6B5F276A89B658FE FOREIGN KEY (producer_id) REFERENCES camera_producers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6B5F276A89B658FE ON cameras (producer_id)');
        $this->addSql('ALTER TABLE lenses ADD producer_name_id VARCHAR(26) DEFAULT NULL');
        $this->addSql('ALTER TABLE lenses DROP producer_name');
        $this->addSql('ALTER TABLE lenses ADD CONSTRAINT FK_C3EE7FE2753D981E FOREIGN KEY (producer_name_id) REFERENCES camera_producers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C3EE7FE2753D981E ON lenses (producer_name_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cameras DROP CONSTRAINT FK_6B5F276A89B658FE');
        $this->addSql('ALTER TABLE lenses DROP CONSTRAINT FK_C3EE7FE2753D981E');
        $this->addSql('ALTER TABLE camera_producers DROP CONSTRAINT FK_4CCDD051896DBBDE');
        $this->addSql('ALTER TABLE camera_system_camera_producer DROP CONSTRAINT FK_C84AA38A4CA49');
        $this->addSql('ALTER TABLE camera_system_camera_producer DROP CONSTRAINT FK_C84AA3AB1D2AD8');
        $this->addSql('DROP TABLE camera_producers');
        $this->addSql('DROP TABLE camera_system_camera_producer');
        $this->addSql('ALTER TABLE camera_systems ADD producer_name VARCHAR(32) NOT NULL');
        $this->addSql('DROP INDEX IDX_6B5F276A89B658FE');
        $this->addSql('ALTER TABLE cameras ADD producer_name VARCHAR(32) NOT NULL');
        $this->addSql('ALTER TABLE cameras DROP producer_id');
        $this->addSql('DROP INDEX IDX_C3EE7FE2753D981E');
        $this->addSql('ALTER TABLE lenses ADD producer_name VARCHAR(32) NOT NULL');
        $this->addSql('ALTER TABLE lenses DROP producer_name_id');
    }
}
