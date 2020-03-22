<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322161838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE segment (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) DEFAULT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, slug VARCHAR(128) NOT NULL, status VARCHAR(64) NOT NULL, position INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, UNIQUE INDEX UNIQ_1881F565989D9B62 (slug), INDEX IDX_1881F5658CDE5729 (type), INDEX IDX_1881F565A977936C (tree_root), INDEX IDX_1881F565727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demographic (type VARCHAR(100) NOT NULL, name VARCHAR(255) DEFAULT NULL, plural VARCHAR(255) DEFAULT NULL, icon VARCHAR(50) NOT NULL, hierarchical TINYINT(1) NOT NULL, ui TINYINT(1) NOT NULL, PRIMARY KEY(type)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, status VARCHAR(64) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_8D93D6498CDE5729 (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_type (type VARCHAR(100) NOT NULL, name VARCHAR(255) DEFAULT NULL, plural VARCHAR(255) DEFAULT NULL, icon VARCHAR(50) NOT NULL, ui TINYINT(1) NOT NULL, PRIMARY KEY(type)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_type_demographic_type (user_type VARCHAR(100) NOT NULL, demographic_type VARCHAR(100) NOT NULL, INDEX IDX_45D69026F65F1BE0 (user_type), INDEX IDX_45D69026D24D5CE9 (demographic_type), PRIMARY KEY(user_type, demographic_type)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taxonomy (type VARCHAR(100) NOT NULL, name VARCHAR(255) DEFAULT NULL, plural VARCHAR(255) DEFAULT NULL, icon VARCHAR(50) NOT NULL, hierarchical TINYINT(1) NOT NULL, ui TINYINT(1) NOT NULL, PRIMARY KEY(type)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_type (type VARCHAR(100) NOT NULL, name VARCHAR(255) DEFAULT NULL, plural VARCHAR(255) DEFAULT NULL, icon VARCHAR(50) NOT NULL, hierarchical TINYINT(1) NOT NULL, ui TINYINT(1) NOT NULL, PRIMARY KEY(type)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_type_taxonomy_type (post_type VARCHAR(100) NOT NULL, taxonomy_type VARCHAR(100) NOT NULL, INDEX IDX_DC55BAA9458B3022 (post_type), INDEX IDX_DC55BAA9EE3CD59E (taxonomy_type), PRIMARY KEY(post_type, taxonomy_type)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) DEFAULT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, excerpt LONGTEXT DEFAULT NULL, slug VARCHAR(128) NOT NULL, status VARCHAR(64) NOT NULL, position INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, UNIQUE INDEX UNIQ_5A8A6C8D989D9B62 (slug), INDEX IDX_5A8A6C8D8CDE5729 (type), INDEX IDX_5A8A6C8DA977936C (tree_root), INDEX IDX_5A8A6C8D727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_term (post INT NOT NULL, term INT NOT NULL, INDEX IDX_6C5A80865A8A6C8D (post), INDEX IDX_6C5A8086A50FE78D (term), PRIMARY KEY(post, term)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE term (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) DEFAULT NULL, tree_root INT DEFAULT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, slug VARCHAR(128) NOT NULL, status VARCHAR(64) NOT NULL, position INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, lft INT NOT NULL, lvl INT NOT NULL, rgt INT NOT NULL, UNIQUE INDEX UNIQ_A50FE78D989D9B62 (slug), INDEX IDX_A50FE78D8CDE5729 (type), INDEX IDX_A50FE78DA977936C (tree_root), INDEX IDX_A50FE78D727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE segment ADD CONSTRAINT FK_1881F5658CDE5729 FOREIGN KEY (type) REFERENCES demographic (type)');
        $this->addSql('ALTER TABLE segment ADD CONSTRAINT FK_1881F565A977936C FOREIGN KEY (tree_root) REFERENCES segment (id)');
        $this->addSql('ALTER TABLE segment ADD CONSTRAINT FK_1881F565727ACA70 FOREIGN KEY (parent_id) REFERENCES segment (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498CDE5729 FOREIGN KEY (type) REFERENCES user_type (type)');
        $this->addSql('ALTER TABLE user_type_demographic_type ADD CONSTRAINT FK_45D69026F65F1BE0 FOREIGN KEY (user_type) REFERENCES user_type (type)');
        $this->addSql('ALTER TABLE user_type_demographic_type ADD CONSTRAINT FK_45D69026D24D5CE9 FOREIGN KEY (demographic_type) REFERENCES demographic (type)');
        $this->addSql('ALTER TABLE post_type_taxonomy_type ADD CONSTRAINT FK_DC55BAA9458B3022 FOREIGN KEY (post_type) REFERENCES post_type (type)');
        $this->addSql('ALTER TABLE post_type_taxonomy_type ADD CONSTRAINT FK_DC55BAA9EE3CD59E FOREIGN KEY (taxonomy_type) REFERENCES taxonomy (type)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D8CDE5729 FOREIGN KEY (type) REFERENCES post_type (type)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA977936C FOREIGN KEY (tree_root) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D727ACA70 FOREIGN KEY (parent_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post_term ADD CONSTRAINT FK_6C5A80865A8A6C8D FOREIGN KEY (post) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post_term ADD CONSTRAINT FK_6C5A8086A50FE78D FOREIGN KEY (term) REFERENCES term (id)');
        $this->addSql('ALTER TABLE term ADD CONSTRAINT FK_A50FE78D8CDE5729 FOREIGN KEY (type) REFERENCES taxonomy (type)');
        $this->addSql('ALTER TABLE term ADD CONSTRAINT FK_A50FE78DA977936C FOREIGN KEY (tree_root) REFERENCES term (id)');
        $this->addSql('ALTER TABLE term ADD CONSTRAINT FK_A50FE78D727ACA70 FOREIGN KEY (parent_id) REFERENCES term (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE segment DROP FOREIGN KEY FK_1881F565A977936C');
        $this->addSql('ALTER TABLE segment DROP FOREIGN KEY FK_1881F565727ACA70');
        $this->addSql('ALTER TABLE segment DROP FOREIGN KEY FK_1881F5658CDE5729');
        $this->addSql('ALTER TABLE user_type_demographic_type DROP FOREIGN KEY FK_45D69026D24D5CE9');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498CDE5729');
        $this->addSql('ALTER TABLE user_type_demographic_type DROP FOREIGN KEY FK_45D69026F65F1BE0');
        $this->addSql('ALTER TABLE post_type_taxonomy_type DROP FOREIGN KEY FK_DC55BAA9EE3CD59E');
        $this->addSql('ALTER TABLE term DROP FOREIGN KEY FK_A50FE78D8CDE5729');
        $this->addSql('ALTER TABLE post_type_taxonomy_type DROP FOREIGN KEY FK_DC55BAA9458B3022');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D8CDE5729');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA977936C');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D727ACA70');
        $this->addSql('ALTER TABLE post_term DROP FOREIGN KEY FK_6C5A80865A8A6C8D');
        $this->addSql('ALTER TABLE post_term DROP FOREIGN KEY FK_6C5A8086A50FE78D');
        $this->addSql('ALTER TABLE term DROP FOREIGN KEY FK_A50FE78DA977936C');
        $this->addSql('ALTER TABLE term DROP FOREIGN KEY FK_A50FE78D727ACA70');
        $this->addSql('DROP TABLE segment');
        $this->addSql('DROP TABLE demographic');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_type');
        $this->addSql('DROP TABLE user_type_demographic_type');
        $this->addSql('DROP TABLE taxonomy');
        $this->addSql('DROP TABLE post_type');
        $this->addSql('DROP TABLE post_type_taxonomy_type');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_term');
        $this->addSql('DROP TABLE term');
    }
}
