<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200531122609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cms_trips CHANGE route_id route_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE transport_id transport_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE driver_id driver_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE with_transport_id with_transport_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE auth_access_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE auth_refresh_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE cms_currency CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE auth_auth_code CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE options_costs CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE options_costs_data CHANGE costs_id costs_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE currency_id currency_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', CHANGE pay_type_id pay_type_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE options_drivers CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE options_routes CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE options_terms CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE options_term_data CHANGE term_id term_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE options_transport CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE cms_pages CHANGE position position INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE cms_paytype CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE auth_access_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE auth_auth_code CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE auth_refresh_token CHANGE user_id user_id INT DEFAULT NULL, CHANGE expires_at expires_at INT DEFAULT NULL, CHANGE scope scope VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE cms_currency CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE cms_pages CHANGE position position INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE cms_paytype CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE cms_trips CHANGE route_id route_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE driver_id driver_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE transport_id transport_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE with_transport_id with_transport_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE options_costs CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE options_costs_data CHANGE costs_id costs_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE currency_id currency_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE pay_type_id pay_type_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE options_drivers CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE options_routes CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE options_term_data CHANGE term_id term_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE options_terms CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE options_transport CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE users CHANGE salt salt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\'');
    }
}
