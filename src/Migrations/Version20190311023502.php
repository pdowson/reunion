<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190311023502 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Initial Buildx`';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE classmate (id INT AUTO_INCREMENT NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, current_name VARCHAR(100) DEFAULT NULL, significant_other VARCHAR(100) DEFAULT NULL, is_missing VARCHAR(255) DEFAULT \'not_missing\' NOT NULL, is_deceased TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classmate_address (id INT AUTO_INCREMENT NOT NULL, classmate_id INT NOT NULL, classmate_year_id INT NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, address_1 VARCHAR(100) DEFAULT NULL, address_2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, zip VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, INDEX IDX_CFD32F251B60D683 (classmate_id), INDEX IDX_CFD32F25825CBE03 (classmate_year_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classmate_attendance (id INT AUTO_INCREMENT NOT NULL, classmate_id INT DEFAULT NULL, classmate_year_id INT NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, num_attendees SMALLINT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, response_date DATETIME DEFAULT NULL, attendees VARCHAR(255) DEFAULT NULL, INDEX IDX_CD5558131B60D683 (classmate_id), INDEX IDX_CD555813825CBE03 (classmate_year_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classmate_info (id INT AUTO_INCREMENT NOT NULL, classmate_id INT DEFAULT NULL, classmate_year_id INT NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, photo_url VARCHAR(255) DEFAULT NULL, info_string LONGTEXT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_DDFA80C81B60D683 (classmate_id), INDEX IDX_DDFA80C8825CBE03 (classmate_year_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classmate_year (id INT AUTO_INCREMENT NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, reunion_year INT NOT NULL, reunion_photo_url VARCHAR(255) DEFAULT NULL, reunion_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, classmate_id INT DEFAULT NULL, classmate_year_id INT NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, current_name VARCHAR(100) DEFAULT NULL, significant_other VARCHAR(100) DEFAULT NULL, address_1 VARCHAR(100) DEFAULT NULL, address_2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, zip VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, info_string LONGTEXT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_4C62E6381B60D683 (classmate_id), INDEX IDX_4C62E638825CBE03 (classmate_year_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classmate_address ADD CONSTRAINT FK_CFD32F251B60D683 FOREIGN KEY (classmate_id) REFERENCES classmate (id)');
        $this->addSql('ALTER TABLE classmate_address ADD CONSTRAINT FK_CFD32F25825CBE03 FOREIGN KEY (classmate_year_id) REFERENCES classmate_year (id)');
        $this->addSql('ALTER TABLE classmate_attendance ADD CONSTRAINT FK_CD5558131B60D683 FOREIGN KEY (classmate_id) REFERENCES classmate (id)');
        $this->addSql('ALTER TABLE classmate_attendance ADD CONSTRAINT FK_CD555813825CBE03 FOREIGN KEY (classmate_year_id) REFERENCES classmate_year (id)');
        $this->addSql('ALTER TABLE classmate_info ADD CONSTRAINT FK_DDFA80C81B60D683 FOREIGN KEY (classmate_id) REFERENCES classmate (id)');
        $this->addSql('ALTER TABLE classmate_info ADD CONSTRAINT FK_DDFA80C8825CBE03 FOREIGN KEY (classmate_year_id) REFERENCES classmate_year (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6381B60D683 FOREIGN KEY (classmate_id) REFERENCES classmate (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638825CBE03 FOREIGN KEY (classmate_year_id) REFERENCES classmate_year (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE classmate_address DROP FOREIGN KEY FK_CFD32F251B60D683');
        $this->addSql('ALTER TABLE classmate_attendance DROP FOREIGN KEY FK_CD5558131B60D683');
        $this->addSql('ALTER TABLE classmate_info DROP FOREIGN KEY FK_DDFA80C81B60D683');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6381B60D683');
        $this->addSql('ALTER TABLE classmate_address DROP FOREIGN KEY FK_CFD32F25825CBE03');
        $this->addSql('ALTER TABLE classmate_attendance DROP FOREIGN KEY FK_CD555813825CBE03');
        $this->addSql('ALTER TABLE classmate_info DROP FOREIGN KEY FK_DDFA80C8825CBE03');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638825CBE03');
        $this->addSql('DROP TABLE classmate');
        $this->addSql('DROP TABLE classmate_address');
        $this->addSql('DROP TABLE classmate_attendance');
        $this->addSql('DROP TABLE classmate_info');
        $this->addSql('DROP TABLE classmate_year');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE user');
    }
}
