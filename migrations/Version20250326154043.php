<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250326154043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add starship table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE starship (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, class VARCHAR(255) NOT NULL, captain VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, arrived_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN starship.arrived_at IS '(DC2Type:datetime_immutable)'
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE starship
        SQL);
    }
}
