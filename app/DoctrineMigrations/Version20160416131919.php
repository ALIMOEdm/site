<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160416131919 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vkgroup ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vkgroup ADD CONSTRAINT FK_DB05762E12469DE2 FOREIGN KEY (category_id) REFERENCES news_category (id)');
        $this->addSql('CREATE INDEX IDX_DB05762E12469DE2 ON vkgroup (category_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vkgroup DROP FOREIGN KEY FK_DB05762E12469DE2');
        $this->addSql('DROP INDEX IDX_DB05762E12469DE2 ON vkgroup');
        $this->addSql('ALTER TABLE vkgroup DROP category_id');
    }
}
