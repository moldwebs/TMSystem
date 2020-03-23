<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200307121428 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE options_costs (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', position INT NOT NULL, type VARCHAR(50) NOT NULL, wid INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, archived TINYINT(1) NOT NULL, title VARCHAR(250) NOT NULL, slug VARCHAR(128) NOT NULL, UNIQUE INDEX UNIQ_6E68EA0B989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE options_costs_data (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', costs_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', cost DOUBLE PRECISION NOT NULL, INDEX IDX_837ECF8427D66E0D (costs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE options_costs_data ADD CONSTRAINT FK_837ECF8427D66E0D FOREIGN KEY (costs_id) REFERENCES options_costs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE options_costs_data DROP FOREIGN KEY FK_837ECF8427D66E0D');
        $this->addSql('DROP TABLE options_costs');
        $this->addSql('DROP TABLE options_costs_data');
    }
}
