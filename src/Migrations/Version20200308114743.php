<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200308114743 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE options_routes_costs_data (route_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', costs_data_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_BF819A9A34ECB4E6 (route_id), INDEX IDX_BF819A9A91587243 (costs_data_id), PRIMARY KEY(route_id, costs_data_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE options_routes_costs_data ADD CONSTRAINT FK_BF819A9A34ECB4E6 FOREIGN KEY (route_id) REFERENCES options_routes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE options_routes_costs_data ADD CONSTRAINT FK_BF819A9A91587243 FOREIGN KEY (costs_data_id) REFERENCES options_costs_data (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE options_routes_costs_data');
    }
}
