<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221126173304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Rename indexes';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER INDEX uniq_daca73f65e237e06 RENAME TO UNIQ_561163105E237E06');
        $this->addSql('ALTER INDEX idx_daca73f6b03a8386 RENAME TO IDX_56116310B03A8386');
        $this->addSql('ALTER INDEX idx_daca73f6896dbbde RENAME TO IDX_56116310896DBBDE');
        $this->addSql('ALTER INDEX idx_daca73f65e237e06 RENAME TO IDX_561163105E237E06');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER INDEX idx_561163105e237e06 RENAME TO idx_daca73f65e237e06');
        $this->addSql('ALTER INDEX idx_56116310896dbbde RENAME TO idx_daca73f6896dbbde');
        $this->addSql('ALTER INDEX idx_56116310b03a8386 RENAME TO idx_daca73f6b03a8386');
        $this->addSql('ALTER INDEX uniq_561163105e237e06 RENAME TO uniq_daca73f65e237e06');
    }
}
