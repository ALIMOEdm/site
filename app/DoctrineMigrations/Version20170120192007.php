<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170120192007 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE int_functional DROP FOREIGN KEY FK_CFA2767436C63CC8');
        $this->addSql('ALTER TABLE int_importance DROP FOREIGN KEY FK_623C99C636C63CC8');
        $this->addSql('ALTER TABLE int_other_sites DROP FOREIGN KEY FK_2F48B48C36C63CC8');
        $this->addSql('ALTER TABLE int_sites DROP FOREIGN KEY FK_4C7582BC36C63CC8');
        $this->addSql('ALTER TABLE zone_to_route DROP FOREIGN KEY FK_21449DD49F2C3FAB');
        $this->addSql('ALTER TABLE int_sites DROP FOREIGN KEY FK_4C7582BCAA334807');
        $this->addSql('ALTER TABLE interview DROP FOREIGN KEY FK_CF1D3C34E40F7381');
        $this->addSql('ALTER TABLE interview DROP FOREIGN KEY FK_CF1D3C3479B7B028');
        $this->addSql('ALTER TABLE int_other_sites DROP FOREIGN KEY FK_2F48B48CAA334807');
        $this->addSql('ALTER TABLE int_functional DROP FOREIGN KEY FK_CFA27674AA334807');
        $this->addSql('ALTER TABLE int_importance DROP FOREIGN KEY FK_623C99C6AA334807');
        $this->addSql('ALTER TABLE zone_to_route DROP FOREIGN KEY FK_21449DD434ECB4E6');
        $this->addSql('DROP TABLE int_functional');
        $this->addSql('DROP TABLE int_importance');
        $this->addSql('DROP TABLE int_other_sites');
        $this->addSql('DROP TABLE int_sites');
        $this->addSql('DROP TABLE interview');
        $this->addSql('DROP TABLE route');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE site_visit_frencity');
        $this->addSql('DROP TABLE site_visit_number');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE what_about_news_other_cities');
        $this->addSql('DROP TABLE what_functional');
        $this->addSql('DROP TABLE what_important');
        $this->addSql('DROP TABLE zone');
        $this->addSql('DROP TABLE zone_to_route');
        $this->addSql('ALTER TABLE news ADD slug VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE int_functional (interview_id_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_CFA2767436C63CC8 (interview_id_id), INDEX IDX_CFA27674AA334807 (answer_id), PRIMARY KEY(interview_id_id, answer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE int_importance (interview_id_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_623C99C636C63CC8 (interview_id_id), INDEX IDX_623C99C6AA334807 (answer_id), PRIMARY KEY(interview_id_id, answer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE int_other_sites (interview_id_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_2F48B48C36C63CC8 (interview_id_id), INDEX IDX_2F48B48CAA334807 (answer_id), PRIMARY KEY(interview_id_id, answer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE int_sites (interview_id_id INT NOT NULL, answer_id INT NOT NULL, INDEX IDX_4C7582BC36C63CC8 (interview_id_id), INDEX IDX_4C7582BCAA334807 (answer_id), PRIMARY KEY(interview_id_id, answer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interview (id INT AUTO_INCREMENT NOT NULL, site_visit_id INT DEFAULT NULL, frencity_id INT DEFAULT NULL, INDEX IDX_CF1D3C34E40F7381 (frencity_id), INDEX IDX_CF1D3C3479B7B028 (site_visit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE route (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, num VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, from_st VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, from_st_id INT NOT NULL, to_st VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, to_st_id INT NOT NULL, dist_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_visit_frencity (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_visit_number (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, station_type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, dist_id INT NOT NULL, c_lat INT NOT NULL, c_long INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE what_about_news_other_cities (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE what_functional (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE what_important (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, category_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, dist_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone_to_route (route_id INT NOT NULL, zone_id INT NOT NULL, INDEX IDX_21449DD434ECB4E6 (route_id), INDEX IDX_21449DD49F2C3FAB (zone_id), PRIMARY KEY(route_id, zone_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE int_functional ADD CONSTRAINT FK_CFA2767436C63CC8 FOREIGN KEY (interview_id_id) REFERENCES interview (id)');
        $this->addSql('ALTER TABLE int_functional ADD CONSTRAINT FK_CFA27674AA334807 FOREIGN KEY (answer_id) REFERENCES what_functional (id)');
        $this->addSql('ALTER TABLE int_importance ADD CONSTRAINT FK_623C99C636C63CC8 FOREIGN KEY (interview_id_id) REFERENCES interview (id)');
        $this->addSql('ALTER TABLE int_importance ADD CONSTRAINT FK_623C99C6AA334807 FOREIGN KEY (answer_id) REFERENCES what_important (id)');
        $this->addSql('ALTER TABLE int_other_sites ADD CONSTRAINT FK_2F48B48C36C63CC8 FOREIGN KEY (interview_id_id) REFERENCES interview (id)');
        $this->addSql('ALTER TABLE int_other_sites ADD CONSTRAINT FK_2F48B48CAA334807 FOREIGN KEY (answer_id) REFERENCES what_about_news_other_cities (id)');
        $this->addSql('ALTER TABLE int_sites ADD CONSTRAINT FK_4C7582BC36C63CC8 FOREIGN KEY (interview_id_id) REFERENCES interview (id)');
        $this->addSql('ALTER TABLE int_sites ADD CONSTRAINT FK_4C7582BCAA334807 FOREIGN KEY (answer_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE interview ADD CONSTRAINT FK_CF1D3C3479B7B028 FOREIGN KEY (site_visit_id) REFERENCES site_visit_number (id)');
        $this->addSql('ALTER TABLE interview ADD CONSTRAINT FK_CF1D3C34E40F7381 FOREIGN KEY (frencity_id) REFERENCES site_visit_frencity (id)');
        $this->addSql('ALTER TABLE zone_to_route ADD CONSTRAINT FK_21449DD434ECB4E6 FOREIGN KEY (route_id) REFERENCES zone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE zone_to_route ADD CONSTRAINT FK_21449DD49F2C3FAB FOREIGN KEY (zone_id) REFERENCES route (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news DROP slug');
    }
}
