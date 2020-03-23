<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200307105915 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE options_transport_term_data (transport_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', term_data_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_B26018239909C13F (transport_id), INDEX IDX_B2601823415EAE0 (term_data_id), PRIMARY KEY(transport_id, term_data_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE options_transport_term_data ADD CONSTRAINT FK_B26018239909C13F FOREIGN KEY (transport_id) REFERENCES options_transport (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE options_transport_term_data ADD CONSTRAINT FK_B2601823415EAE0 FOREIGN KEY (term_data_id) REFERENCES options_term_data (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE options_transport_term_data');
    }
}
