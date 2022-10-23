<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\Uid\Ulid;

final class Version20221023231226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add initial data to CameraProducer, CameraSystem entities';
    }

    public function up(Schema $schema): void
    {
        $nikonProducerId = Ulid::generate();
        $canonProducerId = Ulid::generate();
        $minoltaProducerId = Ulid::generate();

        $this->addSql(
            sprintf(
                "
                INSERT INTO camera_producers(id, name, created_by, created_at) 
                VALUES ('%s', 'Nikon', (SELECT id from users where username = 'admin'), NOW()),
                       ('%s', 'Canon', (SELECT id from users where username = 'admin'), NOW()),
                       ('%s', 'Minolta', (SELECT id from users where username = 'admin'), NOW())
                ",
                $nikonProducerId,
                $canonProducerId,
                $minoltaProducerId
            )
        );
        $nikonSystemId = Ulid::generate();
        $canonSystemId = Ulid::generate();
        $minoltaSystemId = Ulid::generate();

        $this->addSql(
            sprintf(
                "
                INSERT INTO camera_systems(id, name, created_by, created_at)
                VALUES ('%s', 'Nikon', (SELECT id from users where username = 'admin'), NOW()),
                       ('%s', 'Canon', (SELECT id from users where username = 'admin'), NOW()),
                       ('%s', 'Minolta', (SELECT id from users where username = 'admin'), NOW());
                ",
                $nikonSystemId,
                $canonSystemId,
                $minoltaSystemId
            )
        );

        $this->addSql(
            sprintf(
                "INSERT INTO camera_system_camera_producer(camera_system_id, camera_producer_id) 
                        VALUES ('%s', '%s'),
                               ('%s', '%s'),
                               ('%s', '%s');
                ",
                $nikonSystemId, $nikonProducerId,
                $canonSystemId, $canonProducerId,
                $minoltaSystemId, $minoltaProducerId
            )
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE TABLE camera_producers');
        $this->addSql('TRUNCATE TABLE camera_systems');
        $this->addSql('TRUNCATE TABLE camera_system_camera_producer');
    }
}
