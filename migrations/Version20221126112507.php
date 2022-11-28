<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221126112507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Film and FilmManufacturer entities';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE film_manufactures (id VARCHAR(26) NOT NULL, created_by_id VARCHAR(26) DEFAULT NULL, updated_by_id VARCHAR(26) DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DACA73F65E237E06 ON film_manufactures (name)');
        $this->addSql('CREATE INDEX IDX_DACA73F6B03A8386 ON film_manufactures (created_by_id)');
        $this->addSql('CREATE INDEX IDX_DACA73F6896DBBDE ON film_manufactures (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_DACA73F65E237E06 ON film_manufactures (name)');
        $this->addSql('COMMENT ON COLUMN film_manufactures.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN film_manufactures.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE films (id VARCHAR(26) NOT NULL, manufacturer_id VARCHAR(26) DEFAULT NULL, created_by_id VARCHAR(26) DEFAULT NULL, updated_by_id VARCHAR(26) DEFAULT NULL, film_type VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, speed INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CEECCA51A23B42D ON films (manufacturer_id)');
        $this->addSql('CREATE INDEX IDX_CEECCA51896DBBDE ON films (updated_by_id)');
        $this->addSql('CREATE INDEX IDX_CEECCA51D79572D9 ON films (model)');
        $this->addSql('CREATE INDEX IDX_CEECCA51B03A8386 ON films (created_by_id)');
        $this->addSql('COMMENT ON COLUMN films.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN films.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE film_manufactures ADD CONSTRAINT FK_DACA73F6B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_manufactures ADD CONSTRAINT FK_DACA73F6896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA51A23B42D FOREIGN KEY (manufacturer_id) REFERENCES film_manufactures (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA51B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA51896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE film_manufactures DROP CONSTRAINT FK_DACA73F6B03A8386');
        $this->addSql('ALTER TABLE film_manufactures DROP CONSTRAINT FK_DACA73F6896DBBDE');
        $this->addSql('ALTER TABLE films DROP CONSTRAINT FK_CEECCA51A23B42D');
        $this->addSql('ALTER TABLE films DROP CONSTRAINT FK_CEECCA51B03A8386');
        $this->addSql('ALTER TABLE films DROP CONSTRAINT FK_CEECCA51896DBBDE');
        $this->addSql('DROP TABLE film_manufactures');
        $this->addSql('DROP TABLE films');
    }
}
