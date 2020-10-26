<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201026174842 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE debt_personne (debt_id INT NOT NULL, personne_id INT NOT NULL, INDEX IDX_41D27F68240326A5 (debt_id), INDEX IDX_41D27F68A21BD112 (personne_id), PRIMARY KEY(debt_id, personne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE debt_personne ADD CONSTRAINT FK_41D27F68240326A5 FOREIGN KEY (debt_id) REFERENCES debt (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE debt_personne ADD CONSTRAINT FK_41D27F68A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE debt_personne');
    }
}
