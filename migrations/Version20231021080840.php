<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021080840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA6076C50E4A');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA6076C50E4A FOREIGN KEY (proprietaire_id) REFERENCES personne (code_personne) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB75E5878B');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB9D67D8AF');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB75E5878B FOREIGN KEY (menage_id) REFERENCES menage (code_menage) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB9D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (lot_maison) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE maison DROP FOREIGN KEY FK_F90CB66D76C50E4A');
        $this->addSql('ALTER TABLE maison ADD CONSTRAINT FK_F90CB66D76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES personne (code_personne) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE membre_menage DROP FOREIGN KEY FK_4BFB993375E5878B');
        $this->addSql('ALTER TABLE membre_menage DROP FOREIGN KEY FK_4BFB9933A21BD112');
        $this->addSql('ALTER TABLE membre_menage ADD CONSTRAINT FK_4BFB993375E5878B FOREIGN KEY (menage_id) REFERENCES menage (code_menage) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE membre_menage ADD CONSTRAINT FK_4BFB9933A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (code_personne) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFDDCAB802');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF32A7C4C5');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFDDCAB802 FOREIGN KEY (pere_personne_id) REFERENCES personne (code_personne) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF32A7C4C5 FOREIGN KEY (mere_personne_id) REFERENCES personne (code_personne) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA6076C50E4A');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA6076C50E4A FOREIGN KEY (proprietaire_id) REFERENCES personne (code_personne) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB9D67D8AF');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB75E5878B');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB9D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (lot_maison) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB75E5878B FOREIGN KEY (menage_id) REFERENCES menage (code_menage) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maison DROP FOREIGN KEY FK_F90CB66D76C50E4A');
        $this->addSql('ALTER TABLE maison ADD CONSTRAINT FK_F90CB66D76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES personne (code_personne) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_menage DROP FOREIGN KEY FK_4BFB9933A21BD112');
        $this->addSql('ALTER TABLE membre_menage DROP FOREIGN KEY FK_4BFB993375E5878B');
        $this->addSql('ALTER TABLE membre_menage ADD CONSTRAINT FK_4BFB9933A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (code_personne) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_menage ADD CONSTRAINT FK_4BFB993375E5878B FOREIGN KEY (menage_id) REFERENCES menage (code_menage) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFDDCAB802');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF32A7C4C5');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFDDCAB802 FOREIGN KEY (pere_personne_id) REFERENCES personne (code_personne) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF32A7C4C5 FOREIGN KEY (mere_personne_id) REFERENCES personne (code_personne) ON DELETE CASCADE');
    }
}
