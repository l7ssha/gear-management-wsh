<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221020204341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add basic camera and lens info';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE camera_systems (id VARCHAR(26) NOT NULL, name VARCHAR(32) NOT NULL, producer_name VARCHAR(32) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE cameras (id VARCHAR(26) NOT NULL, system_id VARCHAR(26) DEFAULT NULL, producer_name VARCHAR(32) NOT NULL, model VARCHAR(32) NOT NULL, type VARCHAR(255) NOT NULL, format VARCHAR(255) NOT NULL, serial_number VARCHAR(255) NOT NULL, serial_number_alternative VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6B5F276AD0952FA5 ON cameras (system_id)');
        $this->addSql('CREATE INDEX IDX_6B5F276AD79572D9 ON cameras (model)');
        $this->addSql('CREATE TABLE lenses (id VARCHAR(26) NOT NULL, system_id VARCHAR(26) DEFAULT NULL, producer_name VARCHAR(32) NOT NULL, model VARCHAR(32) NOT NULL, type VARCHAR(255) NOT NULL, serial_number VARCHAR(255) NOT NULL, serial_number_alternative VARCHAR(255) NOT NULL, focal_length_focal_length INT NOT NULL, focal_length_focal_length_max INT DEFAULT NULL, fstop_min_focal_min_fstop DOUBLE PRECISION NOT NULL, fstop_min_focal_max_fstop DOUBLE PRECISION NOT NULL, fstop_max_focal_min_fstop DOUBLE PRECISION NOT NULL, fstop_max_focal_max_fstop DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C3EE7FE2D0952FA5 ON lenses (system_id)');
        $this->addSql('CREATE INDEX IDX_C3EE7FE2D79572D9 ON lenses (model)');
        $this->addSql('ALTER TABLE cameras ADD CONSTRAINT FK_6B5F276AD0952FA5 FOREIGN KEY (system_id) REFERENCES camera_systems (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lenses ADD CONSTRAINT FK_C3EE7FE2D0952FA5 FOREIGN KEY (system_id) REFERENCES camera_systems (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cameras DROP CONSTRAINT FK_6B5F276AD0952FA5');
        $this->addSql('ALTER TABLE lenses DROP CONSTRAINT FK_C3EE7FE2D0952FA5');
        $this->addSql('DROP TABLE camera_systems');
        $this->addSql('DROP TABLE cameras');
        $this->addSql('DROP TABLE lenses');
    }
}
