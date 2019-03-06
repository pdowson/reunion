<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190305034740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Removed need for classmates on the contact entity';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_CFD32F251B60D683');
        $this->addSql('DROP INDEX IDX_CFD32F25825CBE03');
        $this->addSql('CREATE TEMPORARY TABLE __temp__classmate_address AS SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, address_1, address_2, city, state, zip, phone FROM classmate_address');
        $this->addSql('DROP TABLE classmate_address');
        $this->addSql('CREATE TABLE classmate_address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classmate_id INTEGER NOT NULL, classmate_year_id INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL COLLATE BINARY, updated_by VARCHAR(255) NOT NULL COLLATE BINARY, delete_date_time DATETIME DEFAULT NULL, address_1 VARCHAR(100) DEFAULT NULL COLLATE BINARY, address_2 VARCHAR(255) DEFAULT NULL COLLATE BINARY, city VARCHAR(255) DEFAULT NULL COLLATE BINARY, state VARCHAR(255) DEFAULT NULL COLLATE BINARY, zip VARCHAR(255) DEFAULT NULL COLLATE BINARY, phone VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_CFD32F251B60D683 FOREIGN KEY (classmate_id) REFERENCES classmate (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_CFD32F25825CBE03 FOREIGN KEY (classmate_year_id) REFERENCES classmate_year (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO classmate_address (id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, address_1, address_2, city, state, zip, phone) SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, address_1, address_2, city, state, zip, phone FROM __temp__classmate_address');
        $this->addSql('DROP TABLE __temp__classmate_address');
        $this->addSql('CREATE INDEX IDX_CFD32F251B60D683 ON classmate_address (classmate_id)');
        $this->addSql('CREATE INDEX IDX_CFD32F25825CBE03 ON classmate_address (classmate_year_id)');
        $this->addSql('DROP INDEX IDX_CD5558131B60D683');
        $this->addSql('DROP INDEX IDX_CD555813825CBE03');
        $this->addSql('CREATE TEMPORARY TABLE __temp__classmate_attendance AS SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, num_attendees, status, response_date, attendees FROM classmate_attendance');
        $this->addSql('DROP TABLE classmate_attendance');
        $this->addSql('CREATE TABLE classmate_attendance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classmate_id INTEGER DEFAULT NULL, classmate_year_id INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL COLLATE BINARY, updated_by VARCHAR(255) NOT NULL COLLATE BINARY, delete_date_time DATETIME DEFAULT NULL, num_attendees SMALLINT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL COLLATE BINARY, response_date DATETIME DEFAULT NULL, attendees VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_CD5558131B60D683 FOREIGN KEY (classmate_id) REFERENCES classmate (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_CD555813825CBE03 FOREIGN KEY (classmate_year_id) REFERENCES classmate_year (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO classmate_attendance (id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, num_attendees, status, response_date, attendees) SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, num_attendees, status, response_date, attendees FROM __temp__classmate_attendance');
        $this->addSql('DROP TABLE __temp__classmate_attendance');
        $this->addSql('CREATE INDEX IDX_CD5558131B60D683 ON classmate_attendance (classmate_id)');
        $this->addSql('CREATE INDEX IDX_CD555813825CBE03 ON classmate_attendance (classmate_year_id)');
        $this->addSql('DROP INDEX IDX_DDFA80C81B60D683');
        $this->addSql('DROP INDEX IDX_DDFA80C8825CBE03');
        $this->addSql('CREATE TEMPORARY TABLE __temp__classmate_info AS SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, photo_url, info_string, email FROM classmate_info');
        $this->addSql('DROP TABLE classmate_info');
        $this->addSql('CREATE TABLE classmate_info (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classmate_id INTEGER DEFAULT NULL, classmate_year_id INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL COLLATE BINARY, updated_by VARCHAR(255) NOT NULL COLLATE BINARY, delete_date_time DATETIME DEFAULT NULL, photo_url VARCHAR(255) DEFAULT NULL COLLATE BINARY, info_string CLOB DEFAULT NULL COLLATE BINARY, email VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_DDFA80C81B60D683 FOREIGN KEY (classmate_id) REFERENCES classmate (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_DDFA80C8825CBE03 FOREIGN KEY (classmate_year_id) REFERENCES classmate_year (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO classmate_info (id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, photo_url, info_string, email) SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, photo_url, info_string, email FROM __temp__classmate_info');
        $this->addSql('DROP TABLE __temp__classmate_info');
        $this->addSql('CREATE INDEX IDX_DDFA80C81B60D683 ON classmate_info (classmate_id)');
        $this->addSql('CREATE INDEX IDX_DDFA80C8825CBE03 ON classmate_info (classmate_year_id)');
        $this->addSql('DROP INDEX IDX_4C62E638825CBE03');
        $this->addSql('DROP INDEX IDX_4C62E6381B60D683');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contact AS SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, current_name, significant_other, address_1, address_2, city, state, zip, phone, info_string, email FROM contact');
        $this->addSql('DROP TABLE contact');
        $this->addSql('CREATE TABLE contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classmate_year_id INTEGER NOT NULL, classmate_id INTEGER DEFAULT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL COLLATE BINARY, updated_by VARCHAR(255) NOT NULL COLLATE BINARY, delete_date_time DATETIME DEFAULT NULL, current_name VARCHAR(100) DEFAULT NULL COLLATE BINARY, significant_other VARCHAR(100) DEFAULT NULL COLLATE BINARY, address_1 VARCHAR(100) DEFAULT NULL COLLATE BINARY, address_2 VARCHAR(255) DEFAULT NULL COLLATE BINARY, city VARCHAR(255) DEFAULT NULL COLLATE BINARY, state VARCHAR(255) DEFAULT NULL COLLATE BINARY, zip VARCHAR(255) DEFAULT NULL COLLATE BINARY, phone VARCHAR(255) DEFAULT NULL COLLATE BINARY, info_string CLOB DEFAULT NULL COLLATE BINARY, email VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_4C62E6381B60D683 FOREIGN KEY (classmate_id) REFERENCES classmate (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_4C62E638825CBE03 FOREIGN KEY (classmate_year_id) REFERENCES classmate_year (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO contact (id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, current_name, significant_other, address_1, address_2, city, state, zip, phone, info_string, email) SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, current_name, significant_other, address_1, address_2, city, state, zip, phone, info_string, email FROM __temp__contact');
        $this->addSql('DROP TABLE __temp__contact');
        $this->addSql('CREATE INDEX IDX_4C62E638825CBE03 ON contact (classmate_year_id)');
        $this->addSql('CREATE INDEX IDX_4C62E6381B60D683 ON contact (classmate_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_CFD32F251B60D683');
        $this->addSql('DROP INDEX IDX_CFD32F25825CBE03');
        $this->addSql('CREATE TEMPORARY TABLE __temp__classmate_address AS SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, address_1, address_2, city, state, zip, phone FROM classmate_address');
        $this->addSql('DROP TABLE classmate_address');
        $this->addSql('CREATE TABLE classmate_address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classmate_id INTEGER NOT NULL, classmate_year_id INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, address_1 VARCHAR(100) DEFAULT NULL, address_2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, zip VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO classmate_address (id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, address_1, address_2, city, state, zip, phone) SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, address_1, address_2, city, state, zip, phone FROM __temp__classmate_address');
        $this->addSql('DROP TABLE __temp__classmate_address');
        $this->addSql('CREATE INDEX IDX_CFD32F251B60D683 ON classmate_address (classmate_id)');
        $this->addSql('CREATE INDEX IDX_CFD32F25825CBE03 ON classmate_address (classmate_year_id)');
        $this->addSql('DROP INDEX IDX_CD5558131B60D683');
        $this->addSql('DROP INDEX IDX_CD555813825CBE03');
        $this->addSql('CREATE TEMPORARY TABLE __temp__classmate_attendance AS SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, num_attendees, status, response_date, attendees FROM classmate_attendance');
        $this->addSql('DROP TABLE classmate_attendance');
        $this->addSql('CREATE TABLE classmate_attendance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classmate_id INTEGER DEFAULT NULL, classmate_year_id INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, num_attendees SMALLINT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, response_date DATETIME DEFAULT NULL, attendees VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO classmate_attendance (id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, num_attendees, status, response_date, attendees) SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, num_attendees, status, response_date, attendees FROM __temp__classmate_attendance');
        $this->addSql('DROP TABLE __temp__classmate_attendance');
        $this->addSql('CREATE INDEX IDX_CD5558131B60D683 ON classmate_attendance (classmate_id)');
        $this->addSql('CREATE INDEX IDX_CD555813825CBE03 ON classmate_attendance (classmate_year_id)');
        $this->addSql('DROP INDEX IDX_DDFA80C81B60D683');
        $this->addSql('DROP INDEX IDX_DDFA80C8825CBE03');
        $this->addSql('CREATE TEMPORARY TABLE __temp__classmate_info AS SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, photo_url, info_string, email FROM classmate_info');
        $this->addSql('DROP TABLE classmate_info');
        $this->addSql('CREATE TABLE classmate_info (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classmate_id INTEGER DEFAULT NULL, classmate_year_id INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, photo_url VARCHAR(255) DEFAULT NULL, info_string CLOB DEFAULT NULL, email VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO classmate_info (id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, photo_url, info_string, email) SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, photo_url, info_string, email FROM __temp__classmate_info');
        $this->addSql('DROP TABLE __temp__classmate_info');
        $this->addSql('CREATE INDEX IDX_DDFA80C81B60D683 ON classmate_info (classmate_id)');
        $this->addSql('CREATE INDEX IDX_DDFA80C8825CBE03 ON classmate_info (classmate_year_id)');
        $this->addSql('DROP INDEX IDX_4C62E6381B60D683');
        $this->addSql('DROP INDEX IDX_4C62E638825CBE03');
        $this->addSql('CREATE TEMPORARY TABLE __temp__contact AS SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, current_name, significant_other, address_1, address_2, city, state, zip, phone, info_string, email FROM contact');
        $this->addSql('DROP TABLE contact');
        $this->addSql('CREATE TABLE contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classmate_year_id INTEGER NOT NULL, created_date DATETIME NOT NULL, updated_date DATETIME NOT NULL, created_by VARCHAR(255) NOT NULL, updated_by VARCHAR(255) NOT NULL, delete_date_time DATETIME DEFAULT NULL, current_name VARCHAR(100) DEFAULT NULL, significant_other VARCHAR(100) DEFAULT NULL, address_1 VARCHAR(100) DEFAULT NULL, address_2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, zip VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, info_string CLOB DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, classmate_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO contact (id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, current_name, significant_other, address_1, address_2, city, state, zip, phone, info_string, email) SELECT id, classmate_id, classmate_year_id, created_date, updated_date, created_by, updated_by, delete_date_time, current_name, significant_other, address_1, address_2, city, state, zip, phone, info_string, email FROM __temp__contact');
        $this->addSql('DROP TABLE __temp__contact');
        $this->addSql('CREATE INDEX IDX_4C62E6381B60D683 ON contact (classmate_id)');
        $this->addSql('CREATE INDEX IDX_4C62E638825CBE03 ON contact (classmate_year_id)');
    }
}
