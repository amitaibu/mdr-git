<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200220200923 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE group_meeting_attendance_list (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mother_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , group_meeting_id CHAR(36) NOT NULL --(DC2Type:uuid)
        )');
        $this->addSql('CREATE TABLE group_meeting (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE child (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, mother_id CHAR(36) NOT NULL --(DC2Type:uuid)
        )');
        $this->addSql('CREATE TABLE mother (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , birthday_estimated BOOLEAN NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE child_measurements (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, weight DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, child_id INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AD9E8689DD62C21B ON child_measurements (child_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE group_meeting_attendance_list');
        $this->addSql('DROP TABLE group_meeting');
        $this->addSql('DROP TABLE child');
        $this->addSql('DROP TABLE mother');
        $this->addSql('DROP TABLE child_measurements');
    }
}
