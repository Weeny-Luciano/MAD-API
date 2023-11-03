<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231009183930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise (code_entreprise VARCHAR(100) NOT NULL, proprietaire_id VARCHAR(255) DEFAULT NULL, nom_entreprise VARCHAR(100) NOT NULL, secteur_activite VARCHAR(255) DEFAULT NULL, date_creation DATE DEFAULT NULL, tel VARCHAR(20) DEFAULT NULL, INDEX IDX_D19FA6076C50E4A (proprietaire_id), PRIMARY KEY(code_entreprise)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA6076C50E4A FOREIGN KEY (proprietaire_id) REFERENCES personne (code_personne)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA6076C50E4A');
        $this->addSql('DROP TABLE entreprise');
    }
}
