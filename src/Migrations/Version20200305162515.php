<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305162515 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE options_drivers (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', wid INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, archived TINYINT(1) NOT NULL, title VARCHAR(250) NOT NULL, slug VARCHAR(128) NOT NULL, extras LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', UNIQUE INDEX UNIQ_D4EA2269989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE options_drivers_term_data (driver_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', term_data_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_ABD1BB36C3423909 (driver_id), INDEX IDX_ABD1BB36415EAE0 (term_data_id), PRIMARY KEY(driver_id, term_data_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE options_transport (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', wid INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, archived TINYINT(1) NOT NULL, title VARCHAR(250) NOT NULL, slug VARCHAR(128) NOT NULL, extras LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', UNIQUE INDEX UNIQ_4AD88513989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE options_terms (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', type VARCHAR(50) NOT NULL, wid INT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, archived TINYINT(1) NOT NULL, title VARCHAR(250) NOT NULL, slug VARCHAR(128) NOT NULL, UNIQUE INDEX UNIQ_49D782D2989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE options_term_data (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', term_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', date DATE NOT NULL, INDEX IDX_6572576E2C35FC (term_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE options_drivers_term_data ADD CONSTRAINT FK_ABD1BB36C3423909 FOREIGN KEY (driver_id) REFERENCES options_drivers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE options_drivers_term_data ADD CONSTRAINT FK_ABD1BB36415EAE0 FOREIGN KEY (term_data_id) REFERENCES options_term_data (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE options_term_data ADD CONSTRAINT FK_6572576E2C35FC FOREIGN KEY (term_id) REFERENCES options_terms (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE options_drivers_term_data DROP FOREIGN KEY FK_ABD1BB36C3423909');
        $this->addSql('ALTER TABLE options_term_data DROP FOREIGN KEY FK_6572576E2C35FC');
        $this->addSql('ALTER TABLE options_drivers_term_data DROP FOREIGN KEY FK_ABD1BB36415EAE0');
        $this->addSql('DROP TABLE options_drivers');
        $this->addSql('DROP TABLE options_drivers_term_data');
        $this->addSql('DROP TABLE options_transport');
        $this->addSql('DROP TABLE options_terms');
        $this->addSql('DROP TABLE options_term_data');
    }
}
