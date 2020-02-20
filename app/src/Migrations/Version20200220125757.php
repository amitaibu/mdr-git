<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200220125757 extends AbstractMigration
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
        $this->addSql('ALTER TABLE group_meeting_attendance_list ADD CONSTRAINT FK_DE04F7DEB08E5C2E FOREIGN KEY (group_meeting_id) REFERENCES group_meeting (id)');
        $this->addSql('ALTER TABLE group_meeting_attendance_list ADD CONSTRAINT FK_DE04F7DEB78A354D FOREIGN KEY (mother_id) REFERENCES mother (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE group_meeting_attendance_list');
    }
}
