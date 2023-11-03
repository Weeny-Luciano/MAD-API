<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231009061353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maison MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON maison');
        $this->addSql('ALTER TABLE maison DROP id, CHANGE annee_construction annee_construction DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE maison ADD PRIMARY KEY (lot_maison)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maison ADD id INT AUTO_INCREMENT NOT NULL, CHANGE annee_construction annee_construction DATE NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
