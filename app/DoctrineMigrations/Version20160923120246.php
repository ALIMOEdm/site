<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160923120246 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, lat INT NOT NULL, `long` INT NOT NULL, type VARCHAR(255) NOT NULL, dist_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE route (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, num VARCHAR(255) NOT NULL, from_st VARCHAR(255) NOT NULL, from_st_id INT NOT NULL, to_st VARCHAR(255) NOT NULL, to_st_id INT NOT NULL, dist_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, category_id VARCHAR(255) NOT NULL, dist_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone_to_route (route_id INT NOT NULL, zone_id INT NOT NULL, INDEX IDX_21449DD434ECB4E6 (route_id), INDEX IDX_21449DD49F2C3FAB (zone_id), PRIMARY KEY(route_id, zone_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE zone_to_route ADD CONSTRAINT FK_21449DD434ECB4E6 FOREIGN KEY (route_id) REFERENCES zone (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE zone_to_route ADD CONSTRAINT FK_21449DD49F2C3FAB FOREIGN KEY (zone_id) REFERENCES route (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE zone_to_route DROP FOREIGN KEY FK_21449DD49F2C3FAB');
        $this->addSql('ALTER TABLE zone_to_route DROP FOREIGN KEY FK_21449DD434ECB4E6');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE route');
        $this->addSql('DROP TABLE zone');
        $this->addSql('DROP TABLE zone_to_route');
    }
}
