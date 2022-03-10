<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220309092447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE difficulty (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hiscore (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, difficulty_id INT NOT NULL, score INT NOT NULL, moderated TINYINT(1) NOT NULL DEFAULT 0, deleted TINYINT(1) NOT NULL DEFAULT 0, INDEX IDX_FE754322A76ED395 (user_id), INDEX IDX_FE754322FCFA9DAE (difficulty_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name_first VARCHAR(255) NOT NULL, name_last VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hiscore ADD CONSTRAINT FK_FE754322A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hiscore ADD CONSTRAINT FK_FE754322FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hiscore DROP FOREIGN KEY FK_FE754322FCFA9DAE');
        $this->addSql('ALTER TABLE hiscore DROP FOREIGN KEY FK_FE754322A76ED395');
        $this->addSql('DROP TABLE difficulty');
        $this->addSql('DROP TABLE hiscore');
        $this->addSql('DROP TABLE user');
    }
}
