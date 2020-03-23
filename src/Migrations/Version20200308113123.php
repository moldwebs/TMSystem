<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200308113123 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE options_routes (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', wid INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, archived TINYINT(1) NOT NULL, title VARCHAR(250) NOT NULL, slug VARCHAR(128) NOT NULL, extras LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', UNIQUE INDEX UNIQ_7DCB455C989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE options_routes_term_data (route_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', term_data_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_FAE6EA5234ECB4E6 (route_id), INDEX IDX_FAE6EA52415EAE0 (term_data_id), PRIMARY KEY(route_id, term_data_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE options_routes_term_data ADD CONSTRAINT FK_FAE6EA5234ECB4E6 FOREIGN KEY (route_id) REFERENCES options_routes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE options_routes_term_data ADD CONSTRAINT FK_FAE6EA52415EAE0 FOREIGN KEY (term_data_id) REFERENCES options_term_data (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE options_routes_term_data DROP FOREIGN KEY FK_FAE6EA5234ECB4E6');
        $this->addSql('DROP TABLE options_routes');
        $this->addSql('DROP TABLE options_routes_term_data');
    }
}
