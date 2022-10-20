<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Auth\User;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221020151654 extends AbstractMigration
{
    private const ADMIN_PASSWORD = '$argon2i$v=19$m=65536,t=4,p=1$T2FJdHZBblhBaUZ1ZEs3cA$JF1f62cRnO0mIplCwEjS4pXQWPXHOmN1/NEL6NTy5Qg';

    public function getDescription(): string
    {
        return 'Add default admin user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(sprintf(
            "INSERT INTO users (id, email, username, password) VALUES ('%s', '%s', '%s', '%s')",
            User::ADMIN_ID,
            User::ADMIN_EMAIL,
            User::ADMIN_USERNAME,
            self::ADMIN_PASSWORD
        ));
    }

    public function down(Schema $schema): void
    {
        $this->addSql(sprintf("DELETE FROM users WHERE id = '%s'", User::ADMIN_ID));
    }
}
