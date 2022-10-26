<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221025195431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Camera serialNumberAlternative is should nullable';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cameras ALTER serial_number_alternative DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cameras ALTER serial_number_alternative SET NOT NULL');
    }
}
