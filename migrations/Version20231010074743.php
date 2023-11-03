<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010074743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, maison_id VARCHAR(20) DEFAULT NULL, menage_id VARCHAR(10) DEFAULT NULL, date_entre DATE NOT NULL, date_sortie DATE DEFAULT NULL, INDEX IDX_5E9E89CB9D67D8AF (maison_id), INDEX IDX_5E9E89CB75E5878B (menage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB9D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (lot_maison) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB75E5878B FOREIGN KEY (menage_id) REFERENCES menage (code_menage) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB9D67D8AF');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB75E5878B');
        $this->addSql('DROP TABLE location');
    }
}
