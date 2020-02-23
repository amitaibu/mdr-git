<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200223121211 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE measurements (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , group_meeting_attendance_id INTEGER NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_71920F21DF5F65D7 ON measurements (group_meeting_attendance_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__child AS SELECT id, mother_id FROM child');
        $this->addSql('DROP TABLE child');
        $this->addSql('CREATE TABLE child (id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        , mother_id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        , PRIMARY KEY(id), CONSTRAINT FK_22B35429BF396750 FOREIGN KEY (id) REFERENCES person (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO child (id, mother_id) SELECT id, mother_id FROM __temp__child');
        $this->addSql('DROP TABLE __temp__child');
        $this->addSql('CREATE TEMPORARY TABLE __temp__mother AS SELECT id, birthday_estimated FROM mother');
        $this->addSql('DROP TABLE mother');
        $this->addSql('CREATE TABLE mother (id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        , birthday_estimated BOOLEAN NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_1AD27F1ABF396750 FOREIGN KEY (id) REFERENCES person (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO mother (id, birthday_estimated) SELECT id, birthday_estimated FROM __temp__mother');
        $this->addSql('DROP TABLE __temp__mother');
        $this->addSql('DROP INDEX UNIQ_AD9E8689DD62C21B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__child_measurements AS SELECT id, weight, height FROM child_measurements');
        $this->addSql('DROP TABLE child_measurements');
        $this->addSql('CREATE TABLE child_measurements (id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        , weight DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_AD9E8689BF396750 FOREIGN KEY (id) REFERENCES measurements (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO child_measurements (id, weight, height) SELECT id, weight, height FROM __temp__child_measurements');
        $this->addSql('DROP TABLE __temp__child_measurements');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE measurements');
        $this->addSql('CREATE TEMPORARY TABLE __temp__child AS SELECT id, mother_id FROM child');
        $this->addSql('DROP TABLE child');
        $this->addSql('CREATE TABLE child (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , mother_id CHAR(36) NOT NULL --(DC2Type:uuid)
        , PRIMARY KEY(id))');
        $this->addSql('INSERT INTO child (id, mother_id) SELECT id, mother_id FROM __temp__child');
        $this->addSql('DROP TABLE __temp__child');
        $this->addSql('CREATE TEMPORARY TABLE __temp__child_measurements AS SELECT id, weight, height FROM child_measurements');
        $this->addSql('DROP TABLE child_measurements');
        $this->addSql('CREATE TABLE child_measurements (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , weight DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, child_id CHAR(36) NOT NULL COLLATE BINARY --(DC2Type:uuid)
        , PRIMARY KEY(id), CONSTRAINT FK_AD9E8689BF396750 FOREIGN KEY (id) REFERENCES measurements (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO child_measurements (id, weight, height) SELECT id, weight, height FROM __temp__child_measurements');
        $this->addSql('DROP TABLE __temp__child_measurements');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AD9E8689DD62C21B ON child_measurements (child_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__mother AS SELECT id, birthday_estimated FROM mother');
        $this->addSql('DROP TABLE mother');
        $this->addSql('CREATE TABLE mother (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , birthday_estimated BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO mother (id, birthday_estimated) SELECT id, birthday_estimated FROM __temp__mother');
        $this->addSql('DROP TABLE __temp__mother');
    }
}
