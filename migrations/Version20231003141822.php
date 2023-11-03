<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231003141822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personne (code_personne VARCHAR(255) NOT NULL, pere_personne_id VARCHAR(255) DEFAULT NULL, mere_personne_id VARCHAR(255) DEFAULT NULL, nom_personne VARCHAR(100) NOT NULL, prenom_personne VARCHAR(100) DEFAULT NULL, date_naissance DATE NOT NULL, sexe VARCHAR(20) NOT NULL, INDEX IDX_FCEC9EFDDCAB802 (pere_personne_id), INDEX IDX_FCEC9EF32A7C4C5 (mere_personne_id), PRIMARY KEY(code_personne)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFDDCAB802 FOREIGN KEY (pere_personne_id) REFERENCES personne (code_personne)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF32A7C4C5 FOREIGN KEY (mere_personne_id) REFERENCES personne (code_personne)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFDDCAB802');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF32A7C4C5');
        $this->addSql('DROP TABLE personne');
    }
}
