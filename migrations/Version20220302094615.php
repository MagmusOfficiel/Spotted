<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220302094615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Points (id INT AUTO_INCREMENT NOT NULL, NbrPoints INT DEFAULT NULL, UserPoints_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_20168B1F20AB3F19 (UserPoints_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Points ADD CONSTRAINT FK_20168B1F20AB3F19 FOREIGN KEY (UserPoints_id) REFERENCES Utilisateur (id)');
        $this->addSql('ALTER TABLE Carrousel CHANGE carrouselPosition carrouselPosition INT NOT NULL');
        $this->addSql('ALTER TABLE Menu CHANGE menuPosition menuPosition INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Points');
        $this->addSql('ALTER TABLE Carrousel CHANGE carrouselPosition carrouselPosition INT DEFAULT NULL');
        $this->addSql('ALTER TABLE Menu CHANGE menuPosition menuPosition INT DEFAULT NULL');
    }
}
