<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250321100013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aquarium ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE aquarium ADD CONSTRAINT FK_2BBA6EB2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2BBA6EB2A76ED395 ON aquarium (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aquarium DROP FOREIGN KEY FK_2BBA6EB2A76ED395');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_2BBA6EB2A76ED395 ON aquarium');
        $this->addSql('ALTER TABLE aquarium DROP user_id');
    }
}
