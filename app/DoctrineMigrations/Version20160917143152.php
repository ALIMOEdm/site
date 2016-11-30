<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160917143152 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE view_counter DROP FOREIGN KEY FK_E87F8182B5A459A0');
        $this->addSql('ALTER TABLE view_counter ADD CONSTRAINT FK_E87F8182B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE view_counter DROP FOREIGN KEY FK_E87F8182B5A459A0');
        $this->addSql('ALTER TABLE view_counter ADD CONSTRAINT FK_E87F8182B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id)');
    }
}
