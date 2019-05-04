<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190504182852 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE classmate (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, current_name VARCHAR(100) DEFAULT NULL, significant_other VARCHAR(100) DEFAULT NULL, is_missing VARCHAR(255) DEFAULT \'not_missing\' NOT NULL, is_deceased BOOLEAN DEFAULT \'0\' NOT NULL)');
        $this->addSql('CREATE TABLE classmate_address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classmate_id INTEGER NOT NULL, classmate_year_id INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, address_1 VARCHAR(100) DEFAULT NULL, address_2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, zip VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_CFD32F251B60D683 ON classmate_address (classmate_id)');
        $this->addSql('CREATE INDEX IDX_CFD32F25825CBE03 ON classmate_address (classmate_year_id)');
        $this->addSql('CREATE TABLE classmate_attendance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classmate_id INTEGER DEFAULT NULL, classmate_year_id INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, num_attendees SMALLINT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, response_date DATETIME DEFAULT NULL, attendees VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_CD5558131B60D683 ON classmate_attendance (classmate_id)');
        $this->addSql('CREATE INDEX IDX_CD555813825CBE03 ON classmate_attendance (classmate_year_id)');
        $this->addSql('CREATE TABLE classmate_info (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classmate_id INTEGER DEFAULT NULL, classmate_year_id INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, photo_url VARCHAR(255) DEFAULT NULL, info_string CLOB DEFAULT NULL, email VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_DDFA80C81B60D683 ON classmate_info (classmate_id)');
        $this->addSql('CREATE INDEX IDX_DDFA80C8825CBE03 ON classmate_info (classmate_year_id)');
        $this->addSql('CREATE TABLE classmate_year (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, reunion_year INTEGER NOT NULL, reunion_photo_url VARCHAR(255) DEFAULT NULL, reunion_date DATETIME DEFAULT NULL)');
        $this->addSql('CREATE TABLE contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classmate_id INTEGER DEFAULT NULL, classmate_year_id INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, current_name VARCHAR(100) DEFAULT NULL, significant_other VARCHAR(100) DEFAULT NULL, address_1 VARCHAR(100) DEFAULT NULL, address_2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, zip VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, info_string CLOB DEFAULT NULL, email VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_4C62E6381B60D683 ON contact (classmate_id)');
        $this->addSql('CREATE INDEX IDX_4C62E638825CBE03 ON contact (classmate_year_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE classmate');
        $this->addSql('DROP TABLE classmate_address');
        $this->addSql('DROP TABLE classmate_attendance');
        $this->addSql('DROP TABLE classmate_info');
        $this->addSql('DROP TABLE classmate_year');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE user');
    }
}
