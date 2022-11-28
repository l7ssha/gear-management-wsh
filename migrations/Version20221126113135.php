<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\Uid\Ulid;

final class Version20221126113135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add initial data to film_manufacturers';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE film_manufactures RENAME TO film_manufacturers');

        $manufacturers = [
            'kodak' => Ulid::generate(),
            'ilford' => Ulid::generate(),
            'foma' => Ulid::generate(),
            'adox' => Ulid::generate(),
            'agfa' => Ulid::generate(),
            'fuji' => Ulid::generate(),
        ];

        foreach ($manufacturers as $name => $id) {
            $this->addSql(
                sprintf(
                    "
                    INSERT INTO film_manufacturers(id, name, created_by_id, created_at) 
                    VALUES ('%s', '%s', (SELECT id from users where username = 'admin'), NOW());
                    ",
                    $id,
                    $name
                )
            );
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE TABLE film_manufacturers');
    }
}
