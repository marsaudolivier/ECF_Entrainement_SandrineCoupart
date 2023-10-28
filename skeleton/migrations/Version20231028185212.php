<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231028185212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recipes_recipes (recipes_source INT NOT NULL, recipes_target INT NOT NULL, INDEX IDX_C574D7E14484E1A9 (recipes_source), INDEX IDX_C574D7E15D61B126 (recipes_target), PRIMARY KEY(recipes_source, recipes_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipes_recipes ADD CONSTRAINT FK_C574D7E14484E1A9 FOREIGN KEY (recipes_source) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_recipes ADD CONSTRAINT FK_C574D7E15D61B126 FOREIGN KEY (recipes_target) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients_recipes DROP FOREIGN KEY FK_C1E222F13EC4DCE');
        $this->addSql('ALTER TABLE ingredients_recipes DROP FOREIGN KEY FK_C1E222F1FDF2B1FA');
        $this->addSql('DROP TABLE ingredients_recipes');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredients_recipes (ingredients_id INT NOT NULL, recipes_id INT NOT NULL, INDEX IDX_C1E222F13EC4DCE (ingredients_id), INDEX IDX_C1E222F1FDF2B1FA (recipes_id), PRIMARY KEY(ingredients_id, recipes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ingredients_recipes ADD CONSTRAINT FK_C1E222F13EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients_recipes ADD CONSTRAINT FK_C1E222F1FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_recipes DROP FOREIGN KEY FK_C574D7E14484E1A9');
        $this->addSql('ALTER TABLE recipes_recipes DROP FOREIGN KEY FK_C574D7E15D61B126');
        $this->addSql('DROP TABLE recipes_recipes');
    }
}
