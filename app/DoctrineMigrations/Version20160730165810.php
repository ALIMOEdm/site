<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160730165810 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE interview (id INT AUTO_INCREMENT NOT NULL, frencity_id INT DEFAULT NULL, site_visit_id INT DEFAULT NULL, INDEX IDX_CF1D3C34E40F7381 (frencity_id), INDEX IDX_CF1D3C3479B7B028 (site_visit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE int_sites (interview_id_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_4C7582BC36C63CC8 (interview_id_id), INDEX IDX_4C7582BCAA334807 (answer_id), PRIMARY KEY(interview_id_id, answer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE int_importance (interview_id_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_623C99C636C63CC8 (interview_id_id), INDEX IDX_623C99C6AA334807 (answer_id), PRIMARY KEY(interview_id_id, answer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE int_functional (interview_id_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_CFA2767436C63CC8 (interview_id_id), INDEX IDX_CFA27674AA334807 (answer_id), PRIMARY KEY(interview_id_id, answer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE int_other_sites (interview_id_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_2F48B48C36C63CC8 (interview_id_id), INDEX IDX_2F48B48CAA334807 (answer_id), PRIMARY KEY(interview_id_id, answer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE what_important (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_visit_number (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE what_functional (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE what_about_news_other_cities (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_visit_frencity (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE interview ADD CONSTRAINT FK_CF1D3C34E40F7381 FOREIGN KEY (frencity_id) REFERENCES site_visit_frencity (id)');
        $this->addSql('ALTER TABLE interview ADD CONSTRAINT FK_CF1D3C3479B7B028 FOREIGN KEY (site_visit_id) REFERENCES site_visit_number (id)');
        $this->addSql('ALTER TABLE int_sites ADD CONSTRAINT FK_4C7582BC36C63CC8 FOREIGN KEY (interview_id_id) REFERENCES interview (id)');
        $this->addSql('ALTER TABLE int_sites ADD CONSTRAINT FK_4C7582BCAA334807 FOREIGN KEY (answer_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE int_importance ADD CONSTRAINT FK_623C99C636C63CC8 FOREIGN KEY (interview_id_id) REFERENCES interview (id)');
        $this->addSql('ALTER TABLE int_importance ADD CONSTRAINT FK_623C99C6AA334807 FOREIGN KEY (answer_id) REFERENCES what_important (id)');
        $this->addSql('ALTER TABLE int_functional ADD CONSTRAINT FK_CFA2767436C63CC8 FOREIGN KEY (interview_id_id) REFERENCES interview (id)');
        $this->addSql('ALTER TABLE int_functional ADD CONSTRAINT FK_CFA27674AA334807 FOREIGN KEY (answer_id) REFERENCES what_functional (id)');
        $this->addSql('ALTER TABLE int_other_sites ADD CONSTRAINT FK_2F48B48C36C63CC8 FOREIGN KEY (interview_id_id) REFERENCES interview (id)');
        $this->addSql('ALTER TABLE int_other_sites ADD CONSTRAINT FK_2F48B48CAA334807 FOREIGN KEY (answer_id) REFERENCES what_about_news_other_cities (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE int_sites DROP FOREIGN KEY FK_4C7582BC36C63CC8');
        $this->addSql('ALTER TABLE int_importance DROP FOREIGN KEY FK_623C99C636C63CC8');
        $this->addSql('ALTER TABLE int_functional DROP FOREIGN KEY FK_CFA2767436C63CC8');
        $this->addSql('ALTER TABLE int_other_sites DROP FOREIGN KEY FK_2F48B48C36C63CC8');
        $this->addSql('ALTER TABLE int_importance DROP FOREIGN KEY FK_623C99C6AA334807');
        $this->addSql('ALTER TABLE interview DROP FOREIGN KEY FK_CF1D3C3479B7B028');
        $this->addSql('ALTER TABLE int_functional DROP FOREIGN KEY FK_CFA27674AA334807');
        $this->addSql('ALTER TABLE int_sites DROP FOREIGN KEY FK_4C7582BCAA334807');
        $this->addSql('ALTER TABLE int_other_sites DROP FOREIGN KEY FK_2F48B48CAA334807');
        $this->addSql('ALTER TABLE interview DROP FOREIGN KEY FK_CF1D3C34E40F7381');
        $this->addSql('DROP TABLE interview');
        $this->addSql('DROP TABLE int_sites');
        $this->addSql('DROP TABLE int_importance');
        $this->addSql('DROP TABLE int_functional');
        $this->addSql('DROP TABLE int_other_sites');
        $this->addSql('DROP TABLE what_important');
        $this->addSql('DROP TABLE site_visit_number');
        $this->addSql('DROP TABLE what_functional');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE what_about_news_other_cities');
        $this->addSql('DROP TABLE site_visit_frencity');
    }
}
