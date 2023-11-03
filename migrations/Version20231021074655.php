<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021074655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF32A7C4C5');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFDDCAB802');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF32A7C4C5 FOREIGN KEY (mere_personne_id) REFERENCES personne (code_personne) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFDDCAB802 FOREIGN KEY (pere_personne_id) REFERENCES personne (code_personne) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFDDCAB802');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF32A7C4C5');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFDDCAB802 FOREIGN KEY (pere_personne_id) REFERENCES personne (code_personne)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF32A7C4C5 FOREIGN KEY (mere_personne_id) REFERENCES personne (code_personne)');
    }
}
