<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200221155643 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE group_meeting_attendance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mother_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , group_meeting_id CHAR(36) NOT NULL --(DC2Type:uuid)
        )');
        $this->addSql('DROP TABLE group_meeting_attendance_list');
        $this->addSql('CREATE TEMPORARY TABLE __temp__child AS SELECT id, first_name, last_name, mother_id FROM child');
        $this->addSql('DROP TABLE child');
        $this->addSql('CREATE TABLE child (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mother_id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        , first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO child (id, first_name, last_name, mother_id) SELECT id, first_name, last_name, mother_id FROM __temp__child');
        $this->addSql('DROP TABLE __temp__child');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE group_meeting_attendance_list (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mother_id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        , group_meeting_id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        )');
        $this->addSql('DROP TABLE group_meeting_attendance');
        $this->addSql('CREATE TEMPORARY TABLE __temp__child AS SELECT id, first_name, last_name, mother_id FROM child');
        $this->addSql('DROP TABLE child');
        $this->addSql('CREATE TABLE child (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mother_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , first_name CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        , last_name CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        )');
        $this->addSql('INSERT INTO child (id, first_name, last_name, mother_id) SELECT id, first_name, last_name, mother_id FROM __temp__child');
        $this->addSql('DROP TABLE __temp__child');
    }
}
