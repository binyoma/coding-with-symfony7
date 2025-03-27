<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250327081005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make slug and timestamps not nullable';
    }

    public function up(Schema $schema): void
    {

        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            UPDATE starship SET slug = id , updated_at = arrived_at, created_at = arrived_at
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE starship ALTER slug SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE starship ALTER updated_at SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE starship ALTER created_at SET NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_C414E64A989D9B62 ON starship (slug)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_C414E64A989D9B62
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE starship ALTER slug DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE starship ALTER updated_at DROP NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE starship ALTER created_at DROP NOT NULL
        SQL);
    }
}
