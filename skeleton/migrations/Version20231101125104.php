<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231101125104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipes_notices DROP FOREIGN KEY FK_8315486A6721205');
        $this->addSql('ALTER TABLE recipes_notices DROP FOREIGN KEY FK_8315486FDF2B1FA');
        $this->addSql('DROP TABLE recipes_notices');
        $this->addSql('ALTER TABLE notices ADD recipes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notices ADD CONSTRAINT FK_6E2C61D2FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id)');
        $this->addSql('CREATE INDEX IDX_6E2C61D2FDF2B1FA ON notices (recipes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipes_notices (recipes_id INT NOT NULL, notices_id INT NOT NULL, INDEX IDX_8315486A6721205 (notices_id), INDEX IDX_8315486FDF2B1FA (recipes_id), PRIMARY KEY(recipes_id, notices_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE recipes_notices ADD CONSTRAINT FK_8315486A6721205 FOREIGN KEY (notices_id) REFERENCES notices (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_notices ADD CONSTRAINT FK_8315486FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notices DROP FOREIGN KEY FK_6E2C61D2FDF2B1FA');
        $this->addSql('DROP INDEX IDX_6E2C61D2FDF2B1FA ON notices');
        $this->addSql('ALTER TABLE notices DROP recipes_id');
    }
}
