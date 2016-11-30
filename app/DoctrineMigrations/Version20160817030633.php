<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160817030633 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX key_index ON additional_info');
        $this->addSql('ALTER TABLE additional_info ADD param_name VARCHAR(255) NOT NULL, ADD param_value VARCHAR(255) NOT NULL, DROP `key`, DROP value');
        $this->addSql('CREATE INDEX key_index ON additional_info (param_name)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX key_index ON additional_info');
        $this->addSql('ALTER TABLE additional_info ADD `key` VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD value VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP param_name, DROP param_value');
        $this->addSql('CREATE INDEX key_index ON additional_info (`key`)');
    }
}
