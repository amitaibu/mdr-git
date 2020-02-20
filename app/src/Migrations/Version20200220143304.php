<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200220143304 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE group_meeting_attendance_list (id INT AUTO_INCREMENT NOT NULL, group_meeting_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', mother_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_DE04F7DEB08E5C2E (group_meeting_id), UNIQUE INDEX UNIQ_DE04F7DEB78A354D (mother_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_meeting (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE child (id INT AUTO_INCREMENT NOT NULL, mother_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, INDEX IDX_22B35429B78A354D (mother_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mother (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', birthday_estimated TINYINT(1) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE child_measurements (id INT AUTO_INCREMENT NOT NULL, child_id INT NOT NULL, weight DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_AD9E8689DD62C21B (child_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE group_meeting_attendance_list ADD CONSTRAINT FK_DE04F7DEB08E5C2E FOREIGN KEY (group_meeting_id) REFERENCES group_meeting (id)');
        $this->addSql('ALTER TABLE group_meeting_attendance_list ADD CONSTRAINT FK_DE04F7DEB78A354D FOREIGN KEY (mother_id) REFERENCES mother (id)');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B35429B78A354D FOREIGN KEY (mother_id) REFERENCES mother (id)');
        $this->addSql('ALTER TABLE child_measurements ADD CONSTRAINT FK_AD9E8689DD62C21B FOREIGN KEY (child_id) REFERENCES child (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE group_meeting_attendance_list DROP FOREIGN KEY FK_DE04F7DEB08E5C2E');
        $this->addSql('ALTER TABLE child_measurements DROP FOREIGN KEY FK_AD9E8689DD62C21B');
        $this->addSql('ALTER TABLE group_meeting_attendance_list DROP FOREIGN KEY FK_DE04F7DEB78A354D');
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B35429B78A354D');
        $this->addSql('DROP TABLE group_meeting_attendance_list');
        $this->addSql('DROP TABLE group_meeting');
        $this->addSql('DROP TABLE child');
        $this->addSql('DROP TABLE mother');
        $this->addSql('DROP TABLE child_measurements');
    }
}