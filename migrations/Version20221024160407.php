<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221024160407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make camera system, camera producer name and lens model unique';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4CCDD0515E237E06 ON camera_producers (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AC7FA1965E237E06 ON camera_systems (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C3EE7FE2D79572D9 ON lenses (model)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_C3EE7FE2D79572D9');
        $this->addSql('DROP INDEX UNIQ_AC7FA1965E237E06');
        $this->addSql('DROP INDEX UNIQ_4CCDD0515E237E06');
    }
}
